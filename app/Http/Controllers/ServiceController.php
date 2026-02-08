<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Customer;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // 🧩 Create Service by Admin

    public function store(Request $request)
    {
        try {

            $customerId = $request->customer_id;

            if (!$customerId) {
                $request->validate([
                    'name'    => 'required|string',
                    'phone'   => 'required|string',
                    'email'   => 'nullable|email',
                    'address' => 'required|string',
                ]);

                $customer = Customer::create([
                    'memberID' => $this->generateUniqueMemberID(),
                    'name'     => $request->name,
                    'phone'    => $request->phone,
                    'email'    => $request->email,
                    'address'  => $request->address,
                ]);

                $customerId = $customer->id;
            }

            $request->validate([
                'Model'   => 'required|string',
                'IMEI'    => 'nullable|string',
                'Keluhan' => 'required|string',
                'Kondisi' => 'required|string',
            ]);

            $service = Service::create([
                'customer_id'  => $customerId,
                'Model'        => $request->Model,
                'IMEI'         => $request->IMEI,
                'Keluhan'      => $request->Keluhan,
                'Kondisi'      => $request->Kondisi,
                'serviceStatus' => 'OPEN',
            ]);

            $this->handleMediaUploads($request, $service->id);

            // Generate PDF CREATE
            app(\App\Http\Controllers\PdfLogController::class)
                ->generatePdf($service->id, 'CREATE');

            if ($request->wantsJson()) {
                return response()->json(
                    $service->load('customer'),
                    201
                );
            }

            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Service berhasil dibuat!');
        } catch (\Exception $e) {

            if ($request->wantsJson()) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal membuat service: ' . $e->getMessage());
        }
    }

    // 🧩 Get Service by admin
    public function showAdmin($id)
    {
        $service = Service::with(['customer', 'media', 'items'])->findOrFail($id);

        return view('admin.show', compact('service'));
    }

    // 🧩 Get Service by teknisi
    function teknisiShow($id)
    {
        $service = Service::with(['customer', 'media', 'items'])->findOrFail($id);

        return view('teknisi.show', compact('service'));
    }

    // 🧩 Update Service (Admin)
    public function updateAdmin(Request $request, $id)
    {
        try {
            $service = Service::with(['customer', 'items'])->find($id);

            if (!$service) {
                return response()->json(['error' => 'Service tidak ditemukan'], 404);
            }

            if (in_array($service->serviceStatus, ['DONE', 'CANCELLED'])) {
                return response()->json(['error' => 'Service sudah selesai / dibatalkan, tidak bisa diupdate.'], 400);
            }

            // parse garansi
            $parsedGaransi = $request->garansi ? $this->parseDateFlexible($request->garansi) : $service->garansi;

            // update data dasar
            $service->update([
                'penyebab' => $request->penyebab ?? $service->penyebab,
                'kerusakan' => $request->kerusakan ?? $service->kerusakan,
                'penyelesaian' => $request->penyelesaian ?? $service->penyelesaian,
                'partUsed' => $request->partUsed ?? $service->partUsed,
                'garansi' => $parsedGaransi,
                'judulJasa' => $request->judulJasa ?? $service->judulJasa,
                'hargaJasa' => $request->hargaJasa ? floatval($request->hargaJasa) : $service->hargaJasa,
            ]);

            // barangList
            $totalBarang = 0;
            if ($request->has('barangList') && is_array($request->barangList)) {
                ServiceItem::where('service_id', $id)->delete();

                foreach ($request->barangList as $item) {
                    if (!isset($item['judulBarang'])) continue;

                    ServiceItem::create([
                        'service_id' => $id,
                        'judulBarang' => $item['judulBarang'],
                        'hargaBarang' => floatval($item['hargaBarang'] ?? 0),
                    ]);
                }

                $totalBarang = collect($request->barangList)->sum(fn($b) => floatval($b['hargaBarang'] ?? 0));
            } else {
                $totalBarang = $service->items->sum('hargaBarang');
            }

            $total = $totalBarang + ($service->hargaJasa ?? 0);
            $service->update(['total' => $total]);
            if ($request->hasFile('hasil')) {
                $hasilPaths = [];
                $files = $request->file('hasil');

                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('services/hasil', $filename, 'public');
                        $hasilPaths[] = $path;
                    }
                }

                // Update atau create media record dengan hasil
                if (!empty($hasilPaths)) {
                    $media = $service->media()->first();

                    if ($media) {
                        // Merge dengan hasil lama jika ada
                        $existingHasil = $media->hasil ?? [];
                        $allHasil = array_merge($existingHasil, $hasilPaths);
                        $media->update(['hasil' => $allHasil]);
                    } else {
                        // Buat media baru jika belum ada
                        Media::create([
                            'service_id' => $id,
                            'hasil' => $hasilPaths,
                        ]);
                    }
                }
            }

            // validasi status
            if ($request->serviceStatus) {
                $valid = ['OPEN', 'PROGRESS', 'SOLVED', 'WARRANTY', 'DONE', 'CANCELLED'];
                if (!in_array($request->serviceStatus, $valid)) {
                    return response()->json(['error' => 'Invalid serviceStatus'], 400);
                }
                $service->update(['serviceStatus' => $request->serviceStatus]);

                // 🔹 Integrasi PDF sesuai flow FE React
                if ($request->serviceStatus === 'SOLVED') {
                    // Generate PDF UPDATE
                    app(\App\Http\Controllers\PdfLogController::class)
                        ->generatePdf($service->id, 'UPDATE');
                }

                if ($request->serviceStatus === 'WARRANTY') {
                    // Generate PDF INVOICE
                    app(\App\Http\Controllers\PdfLogController::class)
                        ->generatePdf($service->id, 'INVOICE');
                }
            }

            // reload relasi
            $service->load(['customer', 'media', 'items']);

            // format rupiah
            $formatted = [
                'id' => $service->id,
                'customer' => $service->customer,
                'media' => $service->media,
                'items' => $service->items->map(fn($b) => [
                    'id' => $b->id,
                    'judulBarang' => $b->judulBarang,
                    'hargaBarang' => $b->hargaBarang,
                    'hargaBarangFormatted' => $this->formatRupiah($b->hargaBarang),
                ]),
                'hargaJasa' => $service->hargaJasa,
                'hargaJasaFormatted' => $this->formatRupiah($service->hargaJasa),
                'total' => $service->total,
                'totalFormatted' => $this->formatRupiah($service->total),
                'serviceStatus' => $service->serviceStatus,
            ];

            if (request()->wantsJson()) {
                return response()->json($formatted, 201);
            } else {
                return redirect()->route('admin.dashboard')->with('success', 'Service berhasil dibuat!');
            }
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['error' => 'Error createServiceByAdmin: ' . $e->getMessage()], 500);
            } else {
                return redirect()->back()->with('error', 'Gagal membuat service: ' . $e->getMessage())->withInput();
            }
        }
    }

    // 🧩 Edit Service View (teknisi)
    public function updateTeknisi(Request $request, $id)
    {
        try {
            $service = Service::with(['customer', 'items'])->find($id);

            if (!$service) {
                return response()->json(['error' => 'Service tidak ditemukan'], 404);
            }

            if (in_array($service->serviceStatus, ['DONE', 'CANCELLED'])) {
                return response()->json(['error' => 'Service sudah selesai / dibatalkan, tidak bisa diupdate.'], 400);
            }

            // parse garansi
            $parsedGaransi = $request->garansi ? $this->parseDateFlexible($request->garansi) : $service->garansi;

            // update data dasar
            $service->update([
                'penyebab' => $request->penyebab ?? $service->penyebab,
                'kerusakan' => $request->kerusakan ?? $service->kerusakan,
                'penyelesaian' => $request->penyelesaian ?? $service->penyelesaian,
                'partUsed' => $request->partUsed ?? $service->partUsed,
                'garansi' => $parsedGaransi,
                'judulJasa' => $request->judulJasa ?? $service->judulJasa,
                'hargaJasa' => $request->hargaJasa ? floatval($request->hargaJasa) : $service->hargaJasa,
            ]);

            // barangList
            $totalBarang = 0;
            if ($request->has('barangList') && is_array($request->barangList)) {
                ServiceItem::where('service_id', $id)->delete();

                foreach ($request->barangList as $item) {
                    if (!isset($item['judulBarang'])) continue;

                    ServiceItem::create([
                        'service_id' => $id,
                        'judulBarang' => $item['judulBarang'],
                        'hargaBarang' => floatval($item['hargaBarang'] ?? 0),
                    ]);
                }

                $totalBarang = collect($request->barangList)->sum(fn($b) => floatval($b['hargaBarang'] ?? 0));
            } else {
                $totalBarang = $service->items->sum('hargaBarang');
            }

            $total = $totalBarang + ($service->hargaJasa ?? 0);
            $service->update(['total' => $total]);
            if ($request->hasFile('hasil')) {
                $hasilPaths = [];
                $files = $request->file('hasil');

                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('services/hasil', $filename, 'public');
                        $hasilPaths[] = $path;
                    }
                }

                // Update atau create media record dengan hasil
                if (!empty($hasilPaths)) {
                    $media = $service->media()->first();

                    if ($media) {
                        // Merge dengan hasil lama jika ada
                        $existingHasil = $media->hasil ?? [];
                        $allHasil = array_merge($existingHasil, $hasilPaths);
                        $media->update(['hasil' => $allHasil]);
                    } else {
                        // Buat media baru jika belum ada
                        Media::create([
                            'service_id' => $id,
                            'hasil' => $hasilPaths,
                        ]);
                    }
                }
            }

            // validasi status
            if ($request->serviceStatus) {
                $valid = ['OPEN', 'PROGRESS', 'SOLVED', 'WARRANTY', 'DONE', 'CANCELLED'];
                if (!in_array($request->serviceStatus, $valid)) {
                    return response()->json(['error' => 'Invalid serviceStatus'], 400);
                }
                $service->update(['serviceStatus' => $request->serviceStatus]);

                // 🔹 Integrasi PDF sesuai flow FE React
                if ($request->serviceStatus === 'SOLVED') {
                    // Generate PDF UPDATE
                    app(\App\Http\Controllers\PdfLogController::class)
                        ->generatePdf($service->id, 'UPDATE');
                }

                if ($request->serviceStatus === 'WARRANTY') {
                    // Generate PDF INVOICE
                    app(\App\Http\Controllers\PdfLogController::class)
                        ->generatePdf($service->id, 'INVOICE');
                }
            }

            // reload relasi
            $service->load(['customer', 'media', 'items']);

            // format rupiah
            $formatted = [
                'id' => $service->id,
                'customer' => $service->customer,
                'media' => $service->media,
                'items' => $service->items->map(fn($b) => [
                    'id' => $b->id,
                    'judulBarang' => $b->judulBarang,
                    'hargaBarang' => $b->hargaBarang,
                    'hargaBarangFormatted' => $this->formatRupiah($b->hargaBarang),
                ]),
                'hargaJasa' => $service->hargaJasa,
                'hargaJasaFormatted' => $this->formatRupiah($service->hargaJasa),
                'total' => $service->total,
                'totalFormatted' => $this->formatRupiah($service->total),
                'serviceStatus' => $service->serviceStatus,
            ];

            if (request()->wantsJson()) {
                return response()->json($formatted, 201);
            } else {
                return redirect()->route('teknisi.dashboard')->with('success', 'Service berhasil dibuat!');
            }
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['error' => 'Error createServiceByAdmin: ' . $e->getMessage()], 500);
            } else {
                return redirect()->back()->with('error', 'Gagal membuat service: ' . $e->getMessage())->withInput();
            }
        }
    }

    public function editAdmin($id)
    {
        $service = Service::with(['customer', 'media', 'items'])->findOrFail($id);

        return view('admin.update-service', compact('service'));
    }

    public function teknisiEdit($id)
    {
        $service = Service::with(['customer', 'media', 'items'])->findOrFail($id);

        return view('teknisi.update-service', compact('service'));
    }

    // 🧩 Get Services (optional filter by status)
    public function index(Request $request)
    {
        try {
            $status = $request->query('status');
            $query = Service::with(['customer', 'media', 'items'])->orderBy('created_at', 'desc');

            if ($status) {
                $valid = ['OPEN', 'PROGRESS', 'SOLVED', 'WARRANTY', 'DONE', 'CANCELLED'];
                if (!in_array($status, $valid)) {
                    return response()->json(['error' => 'Invalid status'], 400);
                }
                $query->where('serviceStatus', $status);
            }

            $services = $query->get();
            return response()->json($services);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function finishWarranty($id)
    {
        $service = Service::findOrFail($id);

        // Pastikan hanya dari WARRANTY
        if ($service->serviceStatus !== 'WARRANTY') {
            return back()->with('error', 'Status tidak valid');
        }

        $service->update([
            'serviceStatus' => 'DONE',
            'warranty_finished_at' => now(), // opsional
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Garansi selesai, status berubah ke DONE');
    }


    // Utils
    private function formatRupiah($value)
    {
        if ($value === null || $value === '') return '-';
        return 'Rp ' . number_format($value, 0, ',', '.');
    }

    // Generate unique 8 digit memberID
    private function generateUniqueMemberID()
    {
        do {
            $memberID = strval(mt_rand(10000000, 99999999));
        } while (Customer::where('memberID', $memberID)->exists());

        return $memberID;
    }

    // Handle media uploads (photos and signature)
    private function handleMediaUploads(Request $request, $serviceId)
    {
        $dokumentasiPaths = [];
        $signaturePath = null;

        // Handle dokumentasi photos
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('services/dokumentasi', $filename, 'public');
                    $dokumentasiPaths[] = $path;
                }
            }
        }

        // Handle signature
        if ($request->signature) {
            // Decode base64 signature
            $signatureData = $request->signature;
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = str_replace(' ', '+', $signatureData);
            $signatureDecoded = base64_decode($signatureData);

            // Save signature as PNG
            $signatureFilename = 'signature_' . $serviceId . '_' . time() . '.png';
            $signaturePath = 'services/signatures/' . $signatureFilename;
            Storage::disk('public')->put($signaturePath, $signatureDecoded);
        }

        // Create media record
        if (!empty($dokumentasiPaths) || $signaturePath) {
            Media::create([
                'service_id' => $serviceId,
                'dokumentasi' => $dokumentasiPaths,
                'signature' => $signaturePath,
            ]);
        }
    }

    private function parseDateFlexible($input)
    {
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $input)) {
            [$dd, $mm, $yyyy] = explode('/', $input);
            return \Carbon\Carbon::createFromDate($yyyy, $mm, $dd);
        }
        try {
            return \Carbon\Carbon::parse($input);
        } catch (\Exception $e) {
            throw new \Exception("Invalid date format for garansi");
        }
    }
}

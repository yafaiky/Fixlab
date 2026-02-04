<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // 🧩 Create Service by Admin
    public function store(Request $request)
    {
        try {
            $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'Model' => 'required|string',
                'IMEI' => 'required|string',
                'Keluhan' => 'required|string',
                'Kondisi' => 'required|string',
            ]);

            $service = Service::create([
                'customer_id' => $request->customer_id,
                'Model' => $request->Model,
                'IMEI' => $request->IMEI,
                'Keluhan' => $request->Keluhan,
                'Kondisi' => $request->Kondisi,
                'serviceStatus' => 'OPEN',
            ]);

            return response()->json($service->load('customer'), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error createServiceByAdmin: '.$e->getMessage()], 500);
        }
    }

    // 🧩 Get Service by ID
    public function show($id)
    {
        try {
            $service = Service::with(['customer','media','items'])->find($id);

            if (!$service) {
                return response()->json(['error' => 'Service not found'], 404);
            }

            return response()->json($service);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // 🧩 Update Service (Admin / Technician)
    public function update(Request $request, $id)
    {
        try {
            $service = Service::with(['customer','items'])->find($id);

            if (!$service) {
                return response()->json(['error' => 'Service tidak ditemukan'], 404);
            }

            if (in_array($service->serviceStatus, ['DONE','CANCELLED'])) {
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

            // validasi status
            if ($request->serviceStatus) {
                $valid = ['OPEN','PROGRESS','SOLVED','WARRANTY','DONE','CANCELLED'];
                if (!in_array($request->serviceStatus, $valid)) {
                    return response()->json(['error' => 'Invalid serviceStatus'], 400);
                }
                $service->update(['serviceStatus' => $request->serviceStatus]);
            }

            // reload relasi
            $service->load(['customer','media','items']);

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

            return response()->json($formatted, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updateService: '.$e->getMessage()], 500);
        }
    }

    // 🧩 Get Services (optional filter by status)
    public function index(Request $request)
    {
        try {
            $status = $request->query('status');
            $query = Service::with(['customer','media','items'])->orderBy('created_at','desc');

            if ($status) {
                $valid = ['OPEN','PROGRESS','SOLVED','WARRANTY','DONE','CANCELLED'];
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

    // Utils
    private function formatRupiah($value)
    {
        if ($value === null || $value === '') return '-';
        return 'Rp '.number_format($value, 0, ',', '.');
    }

    private function parseDateFlexible($input)
    {
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $input)) {
            [$dd,$mm,$yyyy] = explode('/', $input);
            return \Carbon\Carbon::createFromDate($yyyy, $mm, $dd);
        }
        try {
            return \Carbon\Carbon::parse($input);
        } catch (\Exception $e) {
            throw new \Exception("Invalid date format for garansi");
        }
    }
}
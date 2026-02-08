<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\PdfLog;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PdfLogController extends Controller
{
    public function sendServicePdf(Request $request)
    {
        try {
            $request->validate([
                'service_id' => 'required|exists:services,id',
                'type'       => 'required|in:CREATE,UPDATE,INVOICE',
            ]);

            $service = Service::with(['customer','media','items'])->find($request->service_id);

            if (!$service) {
                return response()->json(['error' => 'Service not found'], 404);
            }

            // 🔹 Nama file & path
            $pdfFileName = "service-{$service->id}-{$request->type}.pdf";
            $pdfPath     = "uploads/{$pdfFileName}";

            // 🔹 Hitung total harga
            $totalBarang = $service->items->sum('hargaBarang');
            $hargaJasa   = $service->hargaJasa ?? 0;
            $totalHarga  = $totalBarang + $hargaJasa;

            // 🔹 Barang list untuk template
            $barangList = $service->items->map(function($item, $index) {
                return [
                    'no'    => $index + 1,
                    'nama'  => $item->judulBarang ?? '-',
                    'harga' => $this->formatRupiah($item->hargaBarang ?? 0),
                ];
            });

            // 🔹 Generate PDF pakai DomPDF
            $pdf = Pdf::loadView('pdf.'.$this->getTemplateName($request->type), [
                'service'            => $service,
                'customer'           => $service->customer,
                'barangList'         => $barangList,
                'hargaJasaFormatted' => $this->formatRupiah($hargaJasa),
                'totalFormatted'     => $this->formatRupiah($totalHarga),
                'storagePath'        => storage_path('app/public'),
            ]);

            // 🔹 Simpan PDF ke storage public
            Storage::disk('public')->put($pdfPath, $pdf->output());

            // 🔹 Simpan log ke tabel PdfLog
            $log = PdfLog::create([
                'service_id'  => $service->id,
                'customer_id' => $service->customer_id,
                'type'        => $request->type,
                'sent'        => false,
                'sentAt'      => null,
                'errorMsg'    => null,
                'filePath'    => $pdfFileName,
            ]);

            return response()->json([
                'ok'      => true,
                'message' => "PDF {$request->type} berhasil dibuat",
                'total'   => $totalHarga,
                'fileUrl' => asset('storage/' . $pdfPath),
                'log'     => $log,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => '❌ sendServicePdf error: '.$e->getMessage()], 500);
        }
    }

    private function formatRupiah($value)
    {
        if (!$value) return "Rp 0";
        return 'Rp '.number_format($value, 0, ',', '.');
    }

    public function generatePdf($serviceId, $type)
    {
        try {
            Log::info("🔵 generatePdf START - serviceId: {$serviceId}, type: {$type}");

            // Validasi type
            if (!in_array($type, ['CREATE', 'UPDATE', 'INVOICE'])) {
                Log::error("❌ Invalid PDF type: {$type}");
                return;
            }

            $service = Service::with(['customer','media','items'])->findOrFail($serviceId);
            Log::info("✅ Service found: {$service->id}");

            // 🔹 Nama file & path
            $pdfFileName = "service-{$service->id}-{$type}.pdf";
            $pdfPath     = "uploads/{$pdfFileName}";

            // 🔹 Hitung total harga
            $totalBarang = $service->items->sum('hargaBarang');
            $hargaJasa   = $service->hargaJasa ?? 0;
            $totalHarga  = $totalBarang + $hargaJasa;

            // 🔹 Barang list untuk template
            $barangList = $service->items->map(function($item, $index) {
                return [
                    'no'    => $index + 1,
                    'nama'  => $item->judulBarang ?? '-',
                    'harga' => $this->formatRupiah($item->hargaBarang ?? 0),
                ];
            });

            Log::info("✅ Data prepared - items: {$barangList->count()}, media: " . ($service->media ? 'yes' : 'no'));

            // 🔹 Generate PDF pakai DomPDF
            $pdf = Pdf::loadView('pdf.'.$this->getTemplateName($type), [
                'service'            => $service,
                'customer'           => $service->customer,
                'barangList'         => $barangList,
                'hargaJasaFormatted' => $this->formatRupiah($hargaJasa),
                'totalFormatted'     => $this->formatRupiah($totalHarga),
                'storagePath'        => storage_path('app/public'),
            ]);

            Log::info("✅ PDF generated from view");

            // 🔹 Simpan PDF ke storage public
            Storage::disk('public')->put($pdfPath, $pdf->output());
            Log::info("✅ PDF saved to {$pdfPath}");

            // 🔹 Simpan/update log ke tabel PdfLog
            $log = PdfLog::updateOrCreate(
                [
                    'service_id' => $service->id,
                    'type'       => $type,
                ],
                [
                    'customer_id' => $service->customer_id,
                    'sent'        => false,
                    'sentAt'      => null,
                    'errorMsg'    => null,
                    'filePath'    => $pdfFileName,
                ]
            );

            Log::info("✅ PDF {$type} generated successfully for service {$service->id}");
            return $pdfFileName;

        } catch (\Throwable $e) {
            Log::error("❌ generatePdf FATAL ERROR - serviceId: {$serviceId}, type: {$type}, error: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return null;
        }
    }

    private function getTemplateName($type)
    {
        switch ($type) {
            case 'CREATE': return 'create';
            case 'UPDATE': return 'update';
            case 'INVOICE': return 'invoice';
            default: throw new \Exception("Invalid PDF type");
        }
    }

    public function generateAndDownloadPdf($id, $type)
    {
        try {
            // Validasi type
            if (!in_array($type, ['CREATE', 'UPDATE', 'INVOICE'])) {
                return back()->with('error', 'Invalid PDF type');
            }

            $service = Service::with(['customer', 'media', 'items'])->findOrFail($id);

            // Hitung total
            $totalBarang = $service->items->sum('hargaBarang');
            $hargaJasa = $service->hargaJasa ?? 0;
            $totalHarga = $totalBarang + $hargaJasa;

            // Format barang list
            $barangList = $service->items->map(function($item, $index) {
                return [
                    'no'    => $index + 1,
                    'nama'  => $item->judulBarang ?? '-',
                    'harga' => $this->formatRupiah($item->hargaBarang ?? 0),
                ];
            });

            // Generate PDF
            $pdf = Pdf::loadView('pdf.' . $this->getTemplateName($type), [
                'service'            => $service,
                'customer'           => $service->customer,
                'barangList'         => $barangList,
                'hargaJasaFormatted' => $this->formatRupiah($hargaJasa),
                'totalFormatted'     => $this->formatRupiah($totalHarga),
                'storagePath'        => storage_path('app/public'),
            ]);

            // 🔹 Simpan PDF ke storage public
            $pdfFileName = "service-{$service->id}-{$type}.pdf";
            $pdfPath = "uploads/{$pdfFileName}";
            Storage::disk('public')->put($pdfPath, $pdf->output());

            // 🔹 Simpan/update log ke tabel PdfLog
            PdfLog::updateOrCreate(
                [
                    'service_id' => $service->id,
                    'type'       => $type,
                ],
                [
                    'customer_id' => $service->customer_id,
                    'sent'        => false,
                    'sentAt'      => null,
                    'errorMsg'    => null,
                    'filePath'    => $pdfFileName,
                ]
            );

            // Download PDF
            return $pdf->download($pdfFileName);
        } catch (\Exception $e) {
            return back()->with('error', 'Error generating PDF: ' . $e->getMessage());
        }
    }
}

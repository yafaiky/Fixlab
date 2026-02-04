<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\PdfLog;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfLogController extends Controller
{
    public function sendServicePdf(Request $request)
    {
        try {
            $request->validate([
                'service_id' => 'required|exists:services,id',
                'type' => 'required|in:CREATE,UPDATE,INVOICE',
            ]);

            $service = Service::with(['customer','media','items'])->find($request->service_id);

            if (!$service) {
                return response()->json(['error' => 'Service not found'], 404);
            }

            // Tentukan nama file
            $pdfFileName = "service-{$service->id}-{$request->type}.pdf";
            $pdfPath = "uploads/{$pdfFileName}";

            // Hitung total harga
            $totalBarang = $service->items->sum('hargaBarang');
            $hargaJasa = $service->hargaJasa ?? 0;
            $totalHarga = $totalBarang + $hargaJasa;

            // Barang list untuk template
            $barangList = $service->items->map(function($item, $index) {
                return [
                    'no' => $index + 1,
                    'nama' => $item->judulBarang ?? '-',
                    'harga' => $this->formatRupiah($item->hargaBarang ?? 0),
                ];
            });

            // Generate PDF pakai DomPDF
            $pdf = Pdf::loadView('pdf.'.$this->getTemplateName($request->type), [
                'service' => $service,
                'customer' => $service->customer,
                'barangList' => $barangList,
                'hargaJasaFormatted' => $this->formatRupiah($hargaJasa),
                'totalFormatted' => $this->formatRupiah($totalHarga),
            ]);

            Storage::put($pdfPath, $pdf->output());

            // Simpan log ke tabel PdfLog
            $log = PdfLog::create([
                'service_id' => $service->id,
                'customer_id' => $service->customer_id,
                'type' => $request->type,
                'sent' => false,
                'sentAt' => null,
                'errorMsg' => null,
                'filePath' => $pdfFileName,
            ]);

            return response()->json([
                'ok' => true,
                'message' => 'PDF berhasil dibuat',
                'total' => $totalHarga,
                'fileUrl' => url($pdfPath),
                'log' => $log,
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

    private function getTemplateName($type)
    {
        if ($type === 'CREATE') return 'create';
        if ($type === 'UPDATE') return 'update';
        return 'invoice';
    }
}
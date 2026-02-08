<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // 🧩 Get media list by service
    public function index($serviceId)
    {
        $service = Service::findOrFail($serviceId);

        $media = $service->getMedia()->map(function ($media) {
            return [
                'id'          => $media->id,
                'name'        => $media->name,
                'file_name'   => $media->file_name,
                'mime_type'   => $media->mime_type,
                'size'        => $media->size,
                'url'         => $media->getUrl(),
                'collection'  => $media->collection_name,
            ];
        });

        return response()->json($media);
    }

    // 🧩 Upload media (signature, dokumentasi, hasil)
    public function store(Request $request)
    {
        $request->validate([
            'service_id'    => 'required|exists:services,id',
            'signature'     => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'dokumentasi.*' => 'nullable|file|mimes:jpg,png,pdf|max:4096',
            'hasil.*'       => 'nullable|file|mimes:jpg,png,pdf|max:4096',
        ]);

        $service = Service::findOrFail($request->service_id);

        // Signature (opsional)
        if ($request->hasFile('signature')) {
            $service->addMedia($request->file('signature'))
                    ->toMediaCollection('signature');
        }

        // Dokumentasi (opsional)
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $service->addMedia($file)->toMediaCollection('dokumentasi');
            }
        }

        // Hasil (opsional, dipakai saat SOLVED)
        if ($request->hasFile('hasil')) {
            foreach ($request->file('hasil') as $file) {
                $service->addMedia($file)->toMediaCollection('hasil');
            }
        }

        return response()->json([
            'message' => '✅ Media uploaded successfully',
            'media'   => $service->getMedia()->map(function ($media) {
                return [
                    'id'          => $media->id,
                    'name'        => $media->name,
                    'file_name'   => $media->file_name,
                    'mime_type'   => $media->mime_type,
                    'size'        => $media->size,
                    'url'         => $media->getUrl(),
                    'collection'  => $media->collection_name,
                ];
            }),
        ], 201);
    }

    // 🧩 Update media (replace dokumentasi/hasil)
    public function update(Request $request, $serviceId, $mediaId)
    {
        $service = Service::findOrFail($serviceId);
        $media   = $service->media()->findOrFail($mediaId);

        if ($request->hasFile('file')) {
            $media->delete(); // hapus file lama
            $service->addMedia($request->file('file'))
                    ->toMediaCollection($media->collection_name);
        }

        return response()->json([
            'message' => '✅ Media updated successfully',
            'media'   => $service->getMedia($media->collection_name)->map(function ($m) {
                return [
                    'id'         => $m->id,
                    'url'        => $m->getUrl(),
                    'collection' => $m->collection_name,
                ];
            }),
        ]);
    }

    // 🧩 Delete media
    public function destroy($serviceId, $mediaId)
    {
        $service = Service::findOrFail($serviceId);
        $media   = $service->media()->findOrFail($mediaId);

        $media->delete();

        return response()->json(['message' => '🗑️ Media deleted successfully']);
    }
}
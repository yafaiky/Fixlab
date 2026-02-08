<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'Model',
        'IMEI',
        'Keluhan',
        'Kondisi',
        'penyebab',
        'kerusakan',
        'penyelesaian',
        'garansi',
        'partUsed',
        'serviceStatus',
        'judulJasa',
        'hargaJasa',
        'total',
    ];

    protected $casts = [
        'garansi' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function pdfLogs()
    {
        return $this->hasMany(PdfLog::class);
    }

    public function items()
    {
        return $this->hasMany(ServiceItem::class);
    }
}
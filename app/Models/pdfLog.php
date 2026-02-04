<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'customer_id',
        'type',
        'sent',
        'sentAt',
        'errorMsg',
        'filePath',
    ];

    protected $casts = [
        'sent' => 'boolean',
        'sentAt' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
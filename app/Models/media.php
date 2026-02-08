<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'signature',
        'dokumentasi',
        'hasil',
    ];

    protected $casts = [
        'dokumentasi' => 'array',
        'hasil' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
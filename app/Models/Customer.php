<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'memberID',
        'name',
        'phone',
        'email',
        'address',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function pdfLogs()
    {
        return $this->hasMany(PdfLog::class);
    }
}
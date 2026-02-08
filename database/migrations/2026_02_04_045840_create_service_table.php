<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('Model');
            $table->string('IMEI');
            $table->string('Keluhan');
            $table->string('Kondisi');
            $table->string('penyebab')->nullable();
            $table->string('kerusakan')->nullable();
            $table->string('penyelesaian')->nullable();
            $table->dateTime('garansi')->nullable();
            $table->string('partUsed')->nullable();
            $table->enum('serviceStatus', ['OPEN', 'PROGRESS', 'SOLVED', 'WARRANTY', 'DONE', 'CANCELLED'])->default('OPEN');
            $table->timestamps();
            $table->string('judulJasa')->nullable();
            $table->float('hargaJasa')->nullable();
            $table->float('total')->nullable();
            $table->date('warranty_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};

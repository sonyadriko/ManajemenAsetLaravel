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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->unique();
            $table->string('no_kontrak');
            $table->string('nama_mitra');
            $table->text('alamat_mitra');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('nama_aset');
            $table->decimal('nilai_kontrak', 15, 2);
            $table->decimal('ppn', 15, 2)->nullable();
            $table->decimal('pph', 15, 2)->nullable();
            $table->decimal('total', 15, 2);
            $table->decimal('jumlah_dibayarkan', 15, 2);
            $table->string('ttd');
            $table->string('jabatan');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

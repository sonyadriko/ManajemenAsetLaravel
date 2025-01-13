<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data_aset', function (Blueprint $table) {
            $table->id('no');
            $table->string('no_kontrak');
            $table->string('objek_kerjasama');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('alamat');
            $table->string('skema_kerjasama');
            $table->string('mitra');
            $table->string('bidang_usaha');
            $table->string('luas_objek');
            $table->string('nilai_kontrak');
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_berakhir');
            $table->string('no_nik')->nullable();
            $table->string('no_kk');
            $table->string('no_npwp');
            $table->string('tgl_bayar');
            $table->string('berkas_shp')->nullable();
            $table->string('berkas_pks')->nullable();
            $table->string('file_kmz')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('foto_npwp');
            $table->string('foto_ktp');
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};

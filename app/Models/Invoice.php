<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'no_invoice',
        'no_kontrak',
        'nama_mitra',
        'alamat_mitra',
        'kelurahan',
        'kecamatan',
        'nama_aset',
        'nilai_kontrak',
        'ppn',
        'pph',
        'total',
        'jumlah_dibayarkan',
        'ttd',
        'jabatan',
        'created_by',
    ];
}

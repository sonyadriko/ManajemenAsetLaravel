<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAset extends Model
{
    use HasFactory;
    protected $table = 'data_aset';

    protected $fillable = [
        'no_kontrak',
        'objek_kerjasama',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'alamat',
        'skema_kerjasama',
        'mitra',
        'bidang_usaha',
        'luas_objek',
        'nilai_kontrak',
        'tgl_mulai',
        'tgl_berakhir',
        'no_nik',
        'no_kk',
        'no_npwp',
        'tgl_bayar',
        'file_kmz',
        'latitude',
        'longitude',
        'berkas_shp',
        'berkas_pks',
        'foto_npwp',
        'foto_ktp',
        'created_by',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi', 'id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kota_kabupaten', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan', 'id');
    }
}

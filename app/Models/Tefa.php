<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tefa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'waktu_panen',
        'jenis_kunjungan',
    ];

    public function fasilitasTefa()
    {
        return $this->hasMany(DetailTefa::class)->where('type', 'fasilitas');
    }

    public function produkTefa()
    {
        return $this->hasMany(DetailTefa::class)->where('type', 'produk');
    }

    public function kegiatanTefa()
    {
        return $this->hasMany(DetailTefa::class)->where('type', 'kegiatan');
    }

    public function jenisKunjungans()
    {
        return $this->belongsToMany(JenisKunjungan::class, 'tefa_kunjungans', 'tefa_id', 'jenis_kunjungan_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'rules';

    protected $fillable = [
        'jenis_kunjungan_id',
        'aktivitas_id',
        'capaian_pembelajaran_id',
        'tefa_id',
        'prioritas',
        'jenjang',
    ];

    public function jenisKunjungan()
    {
        return $this->belongsTo(JenisKunjungan::class);
    }

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class);
    }

    public function capaianPembelajaran()
    {
        return $this->belongsTo(CapaianPembelajaran::class);
    }

    public function tefa()
    {
        return $this->belongsTo(Tefa::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'rules';

    protected $fillable = [
        'jenis_kunjungan_id',
        'tefa_id',
        'prioritas',
        'jenjang',
    ];

    public function jenisKunjungan()
    {
        return $this->belongsTo(JenisKunjungan::class);
    }

    public function tefa()
    {
        return $this->belongsTo(Tefa::class);
    }
}

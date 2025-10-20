<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKunjungan extends Model
{
    use HasFactory;

    protected $table = 'jenis_kunjungans';

    protected $fillable = [
        'nama',
    ];

    public function tefas()
    {
        return $this->belongsToMany(Tefa::class, 'tefa_kunjungans', 'jenis_kunjungan_id', 'tefa_id');
    }
}

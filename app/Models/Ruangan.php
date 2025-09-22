<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans';
    protected $fillable = [
        'nama_ruangan',
        'kapasitas'
    ];

    public function gambarRuangan () {
        return $this->hasMany(DetailRuangan::class)->where('type', 'gambar');
    }

    public function fasilitasRuangan () {
        return $this->hasMany(DetailRuangan::class)->where('type', 'fasilitas');
    }
}

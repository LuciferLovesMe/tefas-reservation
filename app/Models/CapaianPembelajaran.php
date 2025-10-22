<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapaianPembelajaran extends Model
{
    protected $table = 'capaian_pembelajarans';

    protected $fillable = [
        'nama',
        'aktivitas_id',
    ];

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class, 'aktivitas_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRuangan extends Model
{
    use HasFactory;

    protected $table = 'detail_ruangans';
    protected $fillable = [
        'ruangan_id',
        'type',
        'detail',
    ];

    public function ruangan () {
        $this->belongsTo(Ruangan::class);
    }
}

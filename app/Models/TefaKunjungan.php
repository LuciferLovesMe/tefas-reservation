<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TefaKunjungan extends Model
{
    use HasFactory;

    protected $table = 'tefa_kunjungans';
    protected $fillable = [
        'tefa_id',
        'jenis_kunjungan_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'tanggal_reservasi',
        'jadwal_mulai',
        'jadwal_berakhir',
        'jumlah_peserta',
        'status',
        'tefa_id',
        'customer_id',
    ];

    public function tefa ()
    {
        return $this->belongsTo(Tefa::class);
    }

    public function customer ()
    {
        return $this->belongsTo(User::class);
    }
}

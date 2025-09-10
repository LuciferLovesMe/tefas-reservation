<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTefa extends Model
{
    use HasFactory;

    protected $fillable = [
        'tefa_id',
        'type',
        'detail',
    ];

    public function tefa()
    {
        return $this->belongsTo(Tefa::class);
    }
}

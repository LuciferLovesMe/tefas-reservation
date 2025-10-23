<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    protected $table = 'aktivitas';

    public function rules()
    {
        return $this->hasMany(Rule::class, 'aktivitas_id');
    }
}

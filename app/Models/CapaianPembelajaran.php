<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapaianPembelajaran extends Model
{
    protected $table = 'capaian_pembelajarans';

    protected $fillable = [
        'nama',
    ];

    public function rules()
    {
        return $this->hasMany(Rule::class, 'capaian_pembelajaran_id');
    }
}

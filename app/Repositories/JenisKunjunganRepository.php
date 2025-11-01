<?php

namespace App\Repositories;

use App\Interfaces\JenisKunjunganInterface;
use App\Models\JenisKunjungan;

class JenisKunjunganRepository implements JenisKunjunganInterface
{
    public function getAll()
    {
        return JenisKunjungan::with('capaianPembelajarans')->orderBy('id', 'DESC')->get();
    }

    public function getByID($id)
    {
        return JenisKunjungan::findOrFail($id);
    }

    public function store($data)
    {
        return JenisKunjungan::create([
            'nama' => $data->nama,
            'capaian_pembelajaran_id' => $data->capaian_pembelajaran_id
        ]);
    }

    public function update($id, $data)
    {
        $jenisKunjungan = JenisKunjungan::findOrFail($id);
        $jenisKunjungan->update([
            'nama' => $data->nama,
            'capaian_pembelajaran_id' => $data->capaian_pembelajaran_id
        ]);
        return $jenisKunjungan;
    }

    public function destroy($id)
    {
        $jenisKunjungan = JenisKunjungan::findOrFail($id);
        return $jenisKunjungan->delete();
    }
}
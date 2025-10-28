<?php

namespace App\Repositories;

use App\Interfaces\CapaianPembelajaranInterface;
use App\Models\CapaianPembelajaran;

class CapaianPembelajaranRepository implements CapaianPembelajaranInterface
{
    public function getAll()
    {
        return CapaianPembelajaran::orderBy('created_at', 'desc')->get();
    }

    public function getById($id)
    {
        return CapaianPembelajaran::findOrFail($id);
    }

    public function store($data)
    {
        return CapaianPembelajaran::create([
            'nama' => $data->nama,
            'jenjang' => $data->jenjang,
            'aktivitas_id' => $data->aktivitas_id,
        ]);
    }

    public function update($id, $data)
    {
        $capaian = CapaianPembelajaran::findOrFail($id);
        $capaian->update([
            'nama' => $data->nama,
            'jenjang' => $data->jenjang,
            'aktivitas_id' => $data->aktivitas_id,
        ]);
        return $capaian;
    }

    public function destroy($id)
    {
        $capaian = CapaianPembelajaran::findOrFail($id);
        return $capaian->delete();
    }
}
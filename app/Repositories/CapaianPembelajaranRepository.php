<?php

namespace App\Repositories;

use App\Interfaces\CapaianPembelajaranInterface;
use App\Models\CapaianPembelajaran;

class CapaianPembelajaranRepository implements CapaianPembelajaranInterface
{
    public function getAll()
    {
        return CapaianPembelajaran::with('aktivitas')->orderBy('created_at', 'desc')->get();
    }

    public function getById($id)
    {
        return CapaianPembelajaran::with('aktivitas')->findOrFail($id);
    }

    public function store($data)
    {
        return CapaianPembelajaran::create([
            'nama' => $data->nama,
            'aktivitas_id' => $data->aktivitas_id,
        ]);
    }

    public function update($id, $data)
    {
        $capaian = CapaianPembelajaran::with('aktivitas')->findOrFail($id);
        $capaian->update([
            'nama' => $data->nama,
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
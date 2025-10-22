<?php

namespace App\Repositories;

use App\Interfaces\AktivitasInterface;
use App\Models\Aktivitas;

class AktivitasRepository implements AktivitasInterface
{
    public function getAll()
    {
        return Aktivitas::orderBy('created_at', 'desc')->get();
    }

    public function getByID($id)
    {
        return Aktivitas::findOrFail($id);
    }

    public function store($data)
    {
        return Aktivitas::create([
            'nama' => $data->nama
        ]);
    }
    
    public function update($id, $data)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        $aktivitas->update([
            'nama' => $data->nama
        ]);
        return $aktivitas;
    }
    
    public function destroy($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        return $aktivitas->delete();
    }
}
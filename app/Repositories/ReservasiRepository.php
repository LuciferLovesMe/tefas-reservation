<?php

namespace App\Repositories;

use App\Interfaces\ReservasiInterface;
use App\Models\Reservasi;

class ReservasiRepository implements ReservasiInterface
{
    public function getAll()
    {
        return Reservasi::with('ruangan')
            ->with('tefa')
            ->with('customer')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getById($id)
    {
        return Reservasi::with('ruangan')
            ->with('tefa')
            ->with('customer')
            ->where('id', $id)
            ->first();
    }

    public function create($data)
    {
        return Reservasi::create($data);
    }

    public function store($request)
    {
        return Reservasi::create($request->all());
    }
    public function update($request, $id)
    {
        $reservasi = Reservasi::find($id);
        if ($reservasi) {
            $reservasi->update($request->all());
            return $reservasi;
        }
        return null;
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::find($id);
        if ($reservasi) {
            return $reservasi->delete();
        }
        return null;
    }
}
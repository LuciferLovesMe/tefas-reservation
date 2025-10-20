<?php

namespace App\Repositories;

use App\Interfaces\TefaKunjunganInterface;
use App\Models\TefaKunjungan;

class TefaKunjunganRepository implements TefaKunjunganInterface
{
    public function getAll()
    {
        return TefaKunjungan::orderBy('id', 'desc')->get();
    }

    public function getByID($id)
    {
        return TefaKunjungan::findOrFail($id);
    }

    public function store($data)
    {
        return TefaKunjungan::create($data);
    }

    public function update($id, $data)
    {
        $tefaKunjungan = TefaKunjungan::findOrFail($id);
        $tefaKunjungan->update($data);
        return $tefaKunjungan;
    }

    public function destroy($id)
    {
        $tefaKunjungan = TefaKunjungan::findOrFail($id);
        return $tefaKunjungan->delete();
    }
}
<?php
namespace App\Repositories;

use App\Interfaces\RuanganInterface;
use App\Models\DetailRuangan;
use App\Models\Ruangan;

class RuanganRepository implements RuanganInterface
{
    public function getAll()
    {
        $data = Ruangan::orderBy('id', 'desc')
            ->get();

        return $data;
    }

    public function getById($id)
    {
        $data = Ruangan::where('id', $id)
            ->with('gambarRuangan', 'fasilitasRuangan')
            ->first();

        return $data;
    }

    public function store($request)
    {
        $ruangan = new Ruangan();
        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->kapasitas = $request->kapasitas;
        $ruangan->save();
        
        if ($request->fasilitas != null || $request->fasilitas != []) {
            foreach ($request->fasilitas as $key => $item) {
                if ($item == null) {
                    continue;
                }
                DetailRuangan::create([
                    'ruangan_id' => $ruangan->id,
                    'type' => 'fasilitas',
                    'detail' => storeImage($item, '/uploads/ruangan/fasilitas/' . $ruangan->id, $key + 1),
                ]);
            }
        }

        if ($request->gambar != null || $request->gambar != []) {
            foreach ($request->gambar as $key => $item) {
                if ($item == null) {
                    continue;
                }
                DetailRuangan::create([
                    'ruangan_id' => $ruangan->id,
                    'type' => 'gambar',
                    'detail' => storeImage($item, '/uploads/ruangan/gambar/' . $ruangan->id, $key + 1),
                ]);
            }
        }
    }

    public function update($request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->kapasitas = $request->kapasitas;
        $ruangan->save();
        if ($request->fasilitas != null || $request->fasilitas != []) {
            foreach ($request->fasilitas as $key => $item) {
                if ($item == null) {
                    continue;
                }

                if (!isset($request->fasilitas_id[$key])) {
                    DetailRuangan::create([
                        'ruangan_id' => $id,
                        'type' => 'fasilitas',
                        'detail' => storeImage($item, '/uploads/ruangan/fasilitas/' . $id, $key + 1),
                    ]);
                } else {
                    DetailRuangan::where('id', $request->fasilitas_id[$key])->update([
                        'detail' => storeImage($item, '/uploads/ruangan/fasilitas/' . $id, $key + 1),
                    ]);
                }
            }
        }

        if ($request->gambar != null || $request->gambar != []) {
            foreach ($request->gambar as $key => $item) {
                if ($item == null) {
                    continue;
                }

                if (!isset($request->gambar_id[$key])) {
                    DetailRuangan::create([
                        'ruangan_id' => $id,
                        'type' => 'gambar',
                        'detail' => storeImage($item, '/uploads/ruangan/gambar/' . $id, $key + 1),
                    ]);
                } else {
                    DetailRuangan::where('id', $request->gambar_id[$key])->update([
                        'detail' => storeImage($item, '/uploads/ruangan/gambar/' . $id, $key + 1),
                    ]);
                }
            }
        }   
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();
    }
}
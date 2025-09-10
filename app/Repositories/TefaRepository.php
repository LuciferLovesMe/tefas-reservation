<?php
namespace App\Repositories;

use App\Interfaces\TefaInterface;
use App\Models\DetailTefa;
use App\Models\Tefa;

class TefaRepository implements TefaInterface
{
    private $tefa;
    private $detailTefa;

    public function __construct(Tefa $tefa, DetailTefa $detail_tefa)
    {
        $this->tefa = $tefa;
        $this->detailTefa = $detail_tefa;
    }

    public function getAll()
    {
        return $this->tefa
            // ->with(['fasilitiasTefa', 'produkTefa', 'kegiatanTefa'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getById($id)
    {
        return $this->tefa
            ->where($id)
            ->with(['fasilitiasTefa', 'produkTefa', 'kegiatanTefa'])
            ->first();
    }

    public function store($request)
    {
        $this->tefa->create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);
        
        if ($request->fasilitas != null || $request->fasilitas != []) {
            foreach ($request->fasilitas as $key => $item) {
                if ($item == null) {
                    continue;
                }
                $this->detailTefa->create([
                    'tefa_id' => $this->tefa->id,
                    'type' => 'fasilitas',
                    'detail' => storeImage($item, 'uploads/tefa/fasilitas/' . $this->tefa->id, $key + 1),
                ]);
            }
        }

        if ($request->produk != null || $request->produk != []) {
            foreach ($request->produk as $key => $item) {
                if ($item == null) {
                    continue;
                }
                $this->detailTefa->create([
                    'tefa_id' => $this->tefa->id,
                    'type' => 'produk',
                    'detail' => storeImage($item, 'uploads/tefa/produk/' . $this->tefa->id, $key + 1),
                ]);
            }
        }

        if ($request->kegiatan != null || $request->kegiatan != []) {
            foreach ($request->kegiatan as $key => $item) {
                if ($item == null) {
                    continue;
                }
                $this->detailTefa->create([
                    'tefa_id' => $this->tefa->id,
                    'type' => 'kegiatan',
                    'detail' => storeImage($item, 'uploads/tefa/kegiatan/' . $this->tefa->id, $key + 1),
                ]);
            }
        }
    }

    public function update($request, $id)
    {
        $tefa = $this->tefa->findOrFail($id);
        $tefa->nama = $request->nama;
        $tefa->deskripsi = $request->deskripsi;
        $tefa->save();
        if ($request->fasilitas != null || $request->fasilitas != []) {
            foreach ($request->fasilitas as $key => $item) {
                if ($item == null) {
                    continue;
                }

                if (isset($request->tefa_id[$key])) {
                    $this->detailTefa->create([
                        'tefa_id' => $this->tefa->id,
                        'type' => 'fasilitas',
                        'detail' => storeImage($item, 'uploads/tefa/fasilitas/' . $this->tefa->id, $key + 1),
                    ]);
                } else {
                    $this->detailTefa->where('id', $request->tefa_id[$key])->update([
                        'detail' => storeImage($item, 'uploads/tefa/fasilitas/' . $this->tefa->id, $key + 1),
                    ]);
                }
            }
        }

        if ($request->produk != null || $request->produk != []) {
            foreach ($request->produk as $key => $item) {
                if ($item == null) {
                    continue;
                }

                if (isset($request->tefa_id[$key])) {
                    $this->detailTefa->create([
                        'tefa_id' => $this->tefa->id,
                        'type' => 'produk',
                        'detail' => storeImage($item, 'uploads/tefa/produk/' . $this->tefa->id, $key + 1),
                    ]);
                } else {
                    $this->detailTefa->where('id', $request->tefa_id[$key])->update([
                        'detail' => storeImage($item, 'uploads/tefa/produk/' . $this->tefa->id, $key + 1),
                    ]);
                }
            }
        }

        if ($request->kegiatan != null || $request->kegiatan != []) {
            foreach ($request->kegiatan as $key => $item) {
                if ($item == null) {
                    continue;
                }

                if (isset($request->tefa_id[$key])) {
                    $this->detailTefa->create([
                        'tefa_id' => $this->tefa->id,
                        'type' => 'kegiatan',
                        'detail' => storeImage($item, 'uploads/tefa/kegiatan/' . $this->tefa->id, $key + 1),
                    ]);
                } else {
                    $this->detailTefa->where('id', $request->tefa_id[$key])->update([
                        'detail' => storeImage($item, 'uploads/tefa/kegiatan/' . $this->tefa->id, $key + 1),
                    ]);
                }
            }
        }

        if (isset ($request->delete_tefa_id)) {
            $this->detailTefa->whereIn('id', $request->delete_tefa_id)->delete();
        }
    }

    public function destroy($id)
    {
        $tefa = $this->tefa->findOrFail($id);
        $tefa->delete();
    }
}

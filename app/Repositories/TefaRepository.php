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
            ->with('jenisKunjungans')
            // ->with(['fasilitiasTefa', 'produkTefa', 'kegiatanTefa'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getById($id)
    {
        return $this->tefa
            ->where('id', $id)
            ->with(['fasilitasTefa', 'produkTefa', 'kegiatanTefa', 'jenisKunjungans'])
            ->first();
    }

    public function store($request)
    {
        $tefa = new Tefa();
        $tefa->nama = $request->nama;
        $tefa->deskripsi = $request->deskripsi;
        $tefa->save();

        $tefa->jenisKunjungans()->attach($request->jenis_kunjungan_id);
        
        if ($request->fasilitas != null || $request->fasilitas != []) {
            foreach ($request->fasilitas as $key => $item) {
                if ($item == null) {
                    continue;
                }
                $this->detailTefa->create([
                    'tefa_id' => $tefa->id,
                    'type' => 'fasilitas',
                    'detail' => storeImage($item, '/uploads/tefa/fasilitas/' . $tefa->id, $key + 1),
                ]);
            }
        }

        if ($request->produk != null || $request->produk != []) {
            foreach ($request->produk as $key => $item) {
                if ($item == null) {
                    continue;
                }
                $this->detailTefa->create([
                    'tefa_id' => $tefa->id,
                    'type' => 'produk',
                    'detail' => storeImage($item, '/uploads/tefa/produk/' . $tefa->id, $key + 1),
                ]);
            }
        }

        if ($request->kegiatan != null || $request->kegiatan != []) {
            foreach ($request->kegiatan as $key => $item) {
                if ($item == null) {
                    continue;
                }
                $this->detailTefa->create([
                    'tefa_id' => $tefa->id,
                    'type' => 'kegiatan',
                    'detail' => storeImage($item, '/uploads/tefa/kegiatan/' . $tefa->id, $key + 1),
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

        $tefa->jenisKunjungans()->sync($request->jenis_kunjungan_id);

        if ($request->fasilitas != null || $request->fasilitas != []) {
            foreach ($request->fasilitas as $key => $item) {
                if ($item == null) {
                    continue;
                }

                if (!isset($request->fasilitas_id[$key])) {
                    $this->detailTefa->create([
                        'tefa_id' => $id,
                        'type' => 'fasilitas',
                        'detail' => storeImage($item, '/uploads/tefa/fasilitas/' . $id, $key + 1),
                    ]);
                } else {
                    $this->detailTefa->where('id', $request->fasilitas_id[$key])->update([
                        'detail' => storeImage($item, '/uploads/tefa/fasilitas/' . $id, $key + 1),
                    ]);
                }
            }
        }

        if ($request->produk != null || $request->produk != []) {
            foreach ($request->produk as $key => $item) {
                if ($item == null) {
                    continue;
                }

                if (!isset($request->produk_id[$key])) {
                    $this->detailTefa->create([
                        'tefa_id' => $id,
                        'type' => 'produk',
                        'detail' => storeImage($item, '/uploads/tefa/produk/' . $id, $key + 1),
                    ]);
                } else {
                    $this->detailTefa->where('id', $request->produk_id[$key])->update([
                        'detail' => storeImage($item, '/uploads/tefa/produk/' . $id, $key + 1),
                    ]);
                }
            }
        }

        if ($request->kegiatan != null || $request->kegiatan != []) {
            foreach ($request->kegiatan as $key => $item) {
                if ($item == null) {
                    continue;
                }

                if (!isset($request->kegiatan_id[$key])) {
                    $this->detailTefa->create([
                        'tefa_id' => $id,
                        'type' => 'kegiatan',
                        'detail' => storeImage($item, '/uploads/tefa/kegiatan/' . $id, $key + 1),
                    ]);
                } else {
                    $this->detailTefa->where('id', $request->kegiatan_id[$key])->update([
                        'detail' => storeImage($item, '/uploads/tefa/kegiatan/' . $id, $key + 1),
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

<?php

namespace App\Repositories;

use App\Interfaces\ReservasiInterface;
use App\Models\CapaianPembelajaran;
use App\Models\JenisKunjungan;
use App\Models\Reservasi;
use App\Models\Tefa;

class ReservasiRepository implements ReservasiInterface
{
    public function getAll()
    {
        return Reservasi::with('tefa')
            ->with('customer')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getById($id)
    {
        return Reservasi::with('customer')
            ->with('tefa.jenisKunjungans.capaianPembelajarans.aktivitas') 
            ->findOrFail($id);
    }

    public function create($data)
    {
        return Reservasi::create($data);
    }

    public function store($request)
    {
        return Reservasi::create([
            'tanggal_reservasi' => now(),
            'jadwal_mulai' => $request->jadwal_mulai,
            'jadwal_berakhir' => $request->jadwal_berakhir,
            'tefa_id' => $request->tefa_id,
            'jumlah_peserta' => $request->jumlah_peserta,
            'keterangan' => $request->keterangan,
            'customer_id' => auth()->user()->id,
        ]);
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

    public function getCapaianByAktivitas($aktivitasId, $jenjang)
    {
        return CapaianPembelajaran::where('aktivitas_id', $aktivitasId)
            ->where('jenjang', $jenjang)
            ->get()
            ->pluck('nama', 'id')
            ->toArray();
    }

    public function getJenisKunjunganByCapaian($capaianId)
    {
        return JenisKunjungan::where('capaian_pembelajaran_id', $capaianId)
            ->get()
            ->pluck('nama', 'id')
            ->toArray();
    }

    public function getTefaByJenisKunjungan($jenisKunjunganId, $bulan)
    {
        $jenisKunjungan = JenisKunjungan::with('capaianPembelajarans.aktivitas')
            ->find($jenisKunjunganId);

        // return $jenisKunjungan;
        $namaAktivitas = $jenisKunjungan?->capaianPembelajaran?->aktivitas?->nama;

        $tefasQuery = Tefa::query();

        $tefasQuery->whereHas('jenisKunjungans', function ($query) use ($jenisKunjunganId) {
            $query->where('jenis_kunjungans.id', $jenisKunjunganId);
        });

        if ($namaAktivitas === 'Pertanian') {
            $tefasQuery->whereMonth('waktu_panen', $bulan);
        }

        $tefas = $tefasQuery->get()->pluck('nama', 'id')->toArray();

        return $tefas;
    }
}
<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservasiRequest;
use App\Interfaces\AktivitasInterface;
use App\Interfaces\ReservasiInterface;
use App\Interfaces\RuanganInterface;
use App\Interfaces\TefaInterface;
use App\View\Components\ActionButton;
use App\View\Components\ActionButtonReservation;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    private $reservasiRepository, $ruanganRepository, $tefaRepository, $aktivitasRepository;

    public function __construct(ReservasiInterface $reservasiRepository, RuanganInterface $ruanganRepository, TefaInterface $tefaRepository, AktivitasInterface $aktivitasRepository)
    {
        $this->reservasiRepository = $reservasiRepository;
        $this->ruanganRepository = $ruanganRepository;
        $this->tefaRepository = $tefaRepository;
        $this->aktivitasRepository = $aktivitasRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->reservasiRepository->getAll())
                ->addIndexColumn()
                ->addColumn('start', function ($data) {
                    return $data->jadwal_mulai ? dateTimeFormat($data->jadwal_mulai) : '-';
                })
                ->addColumn('end', function ($data) {
                    return $data->jadwal_berakhir ? dateTimeFormat($data->jadwal_berakhir) : '-';
                })
                ->addColumn('tanggal_reservasi', function ($data) {
                    return $data->tanggal_reservasi ? dateFormat($data->tanggal_reservasi) : '-';
                })
                ->addColumn('nama_pemesan', function ($data) {
                    return $data->customer ? $data->customer->name : '-';
                })
                ->addColumn('status', function ($data) {
                    $pillStatus = new \App\View\Components\PillStatus($data->status);
                    return $pillStatus->render();
                })
                ->addColumn('nama_tefa', function ($data) {
                    return $data->tefa ? $data->tefa->nama : '-';
                })
                ->addColumn('action', function ($data) {
                    $actionButton = new ActionButtonReservation(
                        route('reservasi.edit', $data->id),
                        route('reservasi.destroy', $data->id),
                        $data->id
                    );
                    return $actionButton->render();
                })
                ->make(true);
        }

        return view('backend.reservasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aktivitas = $this->aktivitasRepository->getAll()->pluck('nama', 'id')->toArray();
        return view('backend.reservasi.create', compact('aktivitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservasiRequest $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $this->reservasiRepository->store($request);
            DB::commit();
            alertSuccess('Data reservasi berhasil ditambahkan.');
            return redirect()->route('reservasi.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back()->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->reservasiRepository->getById($id);
        if (!$data) {
            alertError('Data tidak ditemukan.');
            return redirect()->route('admin.reservasi.index');
        }
        return view('backend.reservasi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->reservasiRepository->getById($id);
        $aktivitas = $this->aktivitasRepository->getAll()->pluck('nama', 'id')->toArray();
        if (!$data) {
            alertError('Data tidak ditemukan.');
            return redirect()->route('admin.reservasi.index');
        }
        $data->load('tefa.jenisKunjungans.capaianPembelajarans.aktivitas');
        $saved_jenis_kunjungan_id = $data->jenis_kunjungan_id ?? null;
        $data_jenis_kunjungan = null;
        if (isset($data->tefa->jenisKunjungans)) {
            foreach ($data->tefa->jenisKunjungans as $jenisKunjungan) {
                if ($data->customer->tipe_sekolah == $jenisKunjungan->capaianPembelajarans->jenjang) {
                    $saved_jenis_kunjungan_id = $jenisKunjungan->id;
                    $data_jenis_kunjungan = $jenisKunjungan;
                    break;
                }
            }
        }
        $saved_capaian_id = $jenisKunjungan->capaian_pembelajaran_id ?? null;
        $saved_aktivitas_id = $jenisKunjungan->capaianPembelajarans->aktivitas_id ?? null;
        $saved_tefa_id = $data->tefa_id ?? null;
        
        // 4. (BARU) Ambil Jenjang Customer
        $customer_jenjang = $data->customer->tipe_sekolah ?? null; // e.g., "SD"

        // return [
        //     'data' => $data,
        //     'aktivitas' => $aktivitas,
        //     'saved_jenis_kunjungan_id' => $saved_jenis_kunjungan_id,
        //     'saved_capaian_id' => $saved_capaian_id,
        //     'saved_aktivitas_id' => $saved_aktivitas_id,
        //     'saved_tefa_id' => $saved_tefa_id,
        //     'customer_jenjang' => $customer_jenjang
        // ];
        return view('backend.reservasi.edit', compact('data', 'aktivitas', 'saved_jenis_kunjungan_id', 'saved_capaian_id', 'saved_aktivitas_id', 'saved_tefa_id', 'customer_jenjang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $this->reservasiRepository->update($request, $id);
            DB::commit();
            alertSuccess('Data reservasi berhasil diupdate.');
            return redirect()->route('admin.reservasi.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back()->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $this->reservasiRepository->destroy($id);
            DB::commit();
            alertSuccess('Data reservasi berhasil dihapus.');
            return redirect()->route('admin.reservasi.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function getCapaianByAktivitas(Request $request)
    {
        $aktivitasId = $request->query('aktivitas_id');
        $jenjang = $request->query('jenjang');
        $capaianPembelajaran = $this->reservasiRepository->getCapaianByAktivitas($aktivitasId, $jenjang);
        return response()->json($capaianPembelajaran);
    }

    public function getJenisKunjunganByCapaian($id)
    {
        $data = $this->reservasiRepository->getJenisKunjunganByCapaian($id);
        return response()->json($data);
    }

    public function getTefaByJenisKunjungan(Request $request)
    {
        $bulan = ($request->get('tanggal')) ? date('m', strtotime($request->get('tanggal'))) : null;
        $id = $request->get('jenis_kunjungan_id');
        $data = $this->reservasiRepository->getTefaByJenisKunjungan($id, $bulan);
        return response()->json($data);
    }
}

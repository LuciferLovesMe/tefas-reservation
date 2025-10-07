<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservasiRequest;
use App\Interfaces\ReservasiInterface;
use App\Interfaces\RuanganInterface;
use App\Interfaces\TefaInterface;
use App\View\Components\ActionButton;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    private $reservasiRepository, $ruanganRepository, $tefaRepository;

    public function __construct(ReservasiInterface $reservasiRepository, RuanganInterface $ruanganRepository, TefaInterface $tefaRepository)
    {
        $this->reservasiRepository = $reservasiRepository;
        $this->ruanganRepository = $ruanganRepository;
        $this->tefaRepository = $tefaRepository;
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
                    return $data->jadwal_mulai ? dateTimeFormat($data->jadwal_mulai) : '';
                })
                ->addColumn('end', function ($data) {
                    return $data->jadwal_berakhir ? dateTimeFormat($data->jadwal_berakhir) : '';
                })
                ->addColumn('tanggal_reservasi', function ($data) {
                    return $data->tanggal_reservasi ? dateFormat($data->tanggal_reservasi) : '';
                })
                ->addColumn('nama_pemesan', function ($data) {
                    return $data->customer ? $data->customer->name : '';
                })
                ->addColumn('status', function ($data) {
                    $pillStatus = new \App\View\Components\PillStatus($data->status);
                    return $pillStatus->render();
                })
                ->addColumn('action', function ($data) {
                    $actionButton = new ActionButton(
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
        $ruanganOptions = $this->ruanganRepository->getAll()->pluck('nama_ruangan', 'id')->toArray();
        $tefaOptions = $this->tefaRepository->getAll()->pluck('nama', 'id')->toArray();
        view()->share('ruanganOptions', $ruanganOptions);
        view()->share('tefaOptions', $tefaOptions);
        return view('backend.reservasi.create');
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
            return redirect()->route('reservasi.index')->with([
                'message' => 'Berhasil menambahkan data.',
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
            return redirect()->back()->withInput()->with([
                'message' => 'Terjadi kesalahan. ' . $e->getMessage(),
                'status' => 'error'
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            return $e;
            return redirect()->back()->withInput()->with([
                'message' => 'Terjadi kesalahan. ' . $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->reservasiRepository->getById($id);
        if (!$data) {
            return redirect()->route('admin.reservasi.index')->with([
                'message' => 'Data tidak ditemukan.',
                'status' => 'error'
            ]);
        }
        return view('backend.reservasi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->reservasiRepository->getById($id);
        if (!$data) {
            return redirect()->route('admin.reservasi.index')->with([
                'message' => 'Data tidak ditemukan.',
                'status' => 'error'
            ]);
        }
        return view('backend.reservasi.edit', compact('data'));
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
            return redirect()->route('admin.reservasi.index')->with([
                'message' => 'Data reservasi berhasil diupdate.',
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with([
                'message' => 'Terjadi kesalahan. ' . $e->getMessage(),
                'status' => 'error'
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with([
                'message' => 'Terjadi kesalahan. ' . $e->getMessage(),
                'status' => 'error'
            ]);
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
            return redirect()->route('admin.reservasi.index')->with([
                'message' => 'Data reservasi berhasil dihapus.',
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'message' => 'Terjadi kesalahan. ' . $e->getMessage(),
                'status' => 'error'
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'message' => 'Terjadi kesalahan. ' . $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }
}

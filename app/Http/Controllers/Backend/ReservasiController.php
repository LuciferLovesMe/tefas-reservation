<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservasiRequest;
use App\Interfaces\ReservasiInterface;
use App\View\Components\ActionButton;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    private $reservasiRepository;

    public function __construct(ReservasiInterface $reservasiRepository)
    {
        $this->reservasiRepository = $reservasiRepository;
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
                    return $data->jadwal_mulai ? dateFormat($data->jadwal_mulai) : '';
                })
                ->addColumn('end', function ($data) {
                    return $data->jadwal_berakhir ? dateFormat($data->jadwal_berakhir) : '';
                })
                ->addColumn('tanggal_reservasi', function ($data) {
                    return $data->tanggal_reservasi ? dateFormat($data->tanggal_reservasi) : '';
                })
                ->addColumn('nama_pemesan', function ($data) {
                    return $data->customer ? $data->customer->name : '';
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
        return view('backend.reservasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservasiRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->reservasiRepository->store($request);
            DB::commit();
            return redirect()->route('admin.reservasi.index')->withToastSuccess('Data reservasi berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withToastError($e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withToastError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->reservasiRepository->getById($id);
        if (!$data) {
            return redirect()->route('admin.reservasi.index')->withToastError('Data reservasi tidak ditemukan');
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
            return redirect()->route('admin.reservasi.index')->withToastError('Data reservasi tidak ditemukan');
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
            return redirect()->route('admin.reservasi.index')->withToastSuccess('Data reservasi berhasil diupdate');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withToastError($e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withToastError($e->getMessage());
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
            return redirect()->route('admin.reservasi.index')->withToastSuccess('Data reservasi berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withToastError($e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withToastError($e->getMessage());
        }
    }
}

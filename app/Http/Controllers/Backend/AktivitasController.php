<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AktivitasRequest;
use App\View\Components\ActionButton;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AktivitasController extends Controller
{
    private $aktivitasRepository;

    public function __construct(\App\Interfaces\AktivitasInterface $aktivitasRepository)
    {
        $this->aktivitasRepository = $aktivitasRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->aktivitasRepository->getAll();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionButton = new ActionButton(
                        route('aktivitas.edit', $data->id),
                        route('aktivitas.destroy', $data->id),
                        $data->id
                    );
                    return $actionButton->render();
                })
                ->make(true);
        }

        return view('backend.aktivitas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.aktivitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AktivitasRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->aktivitasRepository->store($request);
            DB::commit();
            alertSuccess('Aktivitas berhasil ditambahkan.');
            return redirect()->route('aktivitas.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan pada database: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->aktivitasRepository->getByID($id);
        if (!$data) {
            alertError('Data tidak ditemukan.');
            return redirect()->route('aktivitas.index');
        }
        return view('backend.aktivitas.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AktivitasRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $this->aktivitasRepository->update($id, $request);
            DB::commit();
            alertSuccess('Aktivitas berhasil diupdate.');
            return redirect()->route('aktivitas.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan pada database: ' . $e->getMessage());
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
            $this->aktivitasRepository->destroy($id);
            DB::commit();
            alertSuccess('Aktivitas berhasil dihapus.');
            return redirect()->route('aktivitas.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan pada database: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}

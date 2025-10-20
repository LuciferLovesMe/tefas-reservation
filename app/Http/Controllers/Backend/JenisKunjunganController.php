<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisKunjunganRequest;
use App\Repositories\JenisKunjunganRepository;
use App\View\Components\ActionButton;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisKunjunganController extends Controller
{
    private $jenisKunjunganRepository;

    public function __construct(JenisKunjunganRepository $jenisKunjunganRepository)
    {
        $this->jenisKunjunganRepository = $jenisKunjunganRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->jenisKunjunganRepository->getAll();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionButton = new ActionButton(
                        route('jenis-kunjungan.edit', $data->id),
                        route('jenis-kunjungan.destroy', $data->id),
                        $data->id
                    );
                    return $actionButton->render();
                })
                ->make(true);
        }

        return view('backend.jenis_kunjungan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.jenis_kunjungan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenisKunjunganRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->jenisKunjunganRepository->store($request);
            DB::commit();
            alertSuccess('Jenis Kunjungan berhasil ditambahkan.');
            return redirect()->route('jenis-kunjungan.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan.' . $e->getMessage());
            return redirect()->route('jenis-kunjungan.index');
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan pada database.' . $e->getMessage());
            return redirect()->route('jenis-kunjungan.index');
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
        $data = $this->jenisKunjunganRepository->getByID($id);
        if (!$data) {
            alertError('Data tidak ditemukan.');
            return redirect()->route('jenis-kunjungan.index');
        }
        return view('backend.jenis_kunjungan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisKunjunganRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $this->jenisKunjunganRepository->update($id, $request);
            DB::commit();
            alertSuccess('Jenis Kunjungan berhasil diperbarui.');
            return redirect()->route('jenis-kunjungan.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan.' . $e->getMessage());
            return redirect()->route('jenis-kunjungan.index');
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan pada database.' . $e->getMessage());
            return redirect()->route('jenis-kunjungan.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $this->jenisKunjunganRepository->destroy($id);
            DB::commit();
            alertSuccess('Jenis Kunjungan berhasil dihapus.');
            return redirect()->route('jenis-kunjungan.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan.' . $e->getMessage());
            return redirect()->route('jenis-kunjungan.index');
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan pada database.' . $e->getMessage());
            return redirect()->route('jenis-kunjungan.index');
        }
    }
}

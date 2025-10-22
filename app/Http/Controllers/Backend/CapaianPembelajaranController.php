<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapaianPembelajaranRequest;
use App\Interfaces\CapaianPembelajaranInterface;
use App\View\Components\ActionButton;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CapaianPembelajaranController extends Controller
{
    private $capaianPembelajaranRepository;

    public function __construct(CapaianPembelajaranInterface $capaianPembelajaranRepository)
    {
        $this->capaianPembelajaranRepository = $capaianPembelajaranRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->capaianPembelajaranRepository->getAll();
            return datatables()
                ->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = new ActionButton(
                        route('capaian-pembelajaran.edit', $data->id),
                        route('capaian-pembelajaran.destroy', $data->id),
                        $data->id,
                    );
                    return $button->render();
                })
                ->make(true);
        }

        return view('backend.capaian-pembelajaran.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.capaian-pembelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CapaianPembelajaranRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->capaianPembelajaranRepository->store($request);
            DB::commit();
            alertSuccess('Capaian Pembelajaran berhasil ditambahkan.');
            return redirect()->route('capaian-pembelajaran.index');
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
        $data = $this->capaianPembelajaranRepository->getById($id);
        if (!$data) {
            alertError('Capaian Pembelajaran tidak ditemukan.');
            return redirect()->back();
        }

        return view('backend.capaian-pembelajaran.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CapaianPembelajaranRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $this->capaianPembelajaranRepository->update($id, $request);
            DB::commit();
            alertSuccess('Capaian Pembelajaran berhasil diperbarui.');
            return redirect()->route('capaian-pembelajaran.index');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $this->capaianPembelajaranRepository->destroy($id);
            DB::commit();
            alertSuccess('Capaian Pembelajaran berhasil dihapus.');
            return redirect()->route('capaian-pembelajaran.index');
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

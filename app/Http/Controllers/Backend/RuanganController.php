<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RuanganRequest;
use App\Interfaces\RuanganInterface;
use App\View\Components\ActionButton;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\True_;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    private $ruanganRepository;

    public function __construct(RuanganInterface $ruanganRepository)
    {
        $this->ruanganRepository = $ruanganRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->ruanganRepository->getAll())
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionButton = new ActionButton(
                        route('ruangan.edit', $data->id),
                        route('ruangan.destroy', $data->id),
                        $data->id
                    );
                    return $actionButton->render();
                })
                ->make(true);
        }

        return view('backend.ruangan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RuanganRequest $request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $this->ruanganRepository->store($request);
            DB::commit();
            Alert::success('Berhasil', 'Data ruangan berhasil ditambahkan.');
            return redirect()->route('ruangan.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
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
        try {
            $data = $this->ruanganRepository->getById($id);
            if (!$data) {
                Alert::error('Gagal', 'Data tidak ditemukan.');
                return redirect()->back();
            }

            return view('backend.ruangan.edit', compact('data'));
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RuanganRequest $request, string $id)
    {   
        DB::beginTransaction();
        try {
            $this->ruanganRepository->update($request, $id);
            DB::commit();
            Alert::success('Berhasil', 'Data ruangan berhasil diupdate.');
            return redirect()->route('ruangan.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
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
            $data = $this->ruanganRepository->getById($id);
            if (!$data) {
                Alert::error('Gagal', 'Data tidak ditemukan.');
                return redirect()->back();
            }
            $this->ruanganRepository->destroy($id);
            DB::commit();
            Alert::success('Berhasil', 'Data ruangan berhasil dihapus.');
            return redirect()->route('ruangan.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan. ' . $e->getMessage());
            return redirect()->back();
        }
    }
}

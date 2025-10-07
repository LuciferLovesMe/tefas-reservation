<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TefaRequest;
use App\Interfaces\TefaInterface;
use App\View\Components\ActionButton;
use App\View\Components\FormComponents\Td;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use function Termwind\render;

class TefaController extends Controller
{
    private $tefaRepository;

    public function __construct(TefaInterface $tefaRepository)
    {
        $this->tefaRepository = $tefaRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->tefaRepository->getAll())
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionButton = new ActionButton(
                        route('tefa.edit', $data->id),
                        route('tefa.destroy', $data->id),
                        $data->id
                    );
                    return $actionButton->render();
                })
                ->rawColumns(['nama_td', 'deskripsi_td'])
                ->make(true);
        }

        return view('backend.tefa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.tefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TefaRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->tefaRepository->store($request);
            DB::commit();
            Alert::success('Berhasil', 'Data tefa berhasil ditambahkan.');
            return redirect()->route('tefa.index');
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = $this->tefaRepository->getById($id);
            if (!$data) {
                Alert::error('Gagal', 'Data tidak ditemukan.');
                return redirect()->back();
            }
            return view('backend.tefa.show', compact('data'));
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan.' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Terjadi kesalahan.' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data = $this->tefaRepository->getById($id);
            if (!$data) {
                Alert::error('Gagal', 'Data tidak ditemukan.');
                return redirect()->back();
            }
            return view('backend.tefa.edit', compact('data'));
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan.' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Terjadi kesalahan.' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TefaRequest $request, string $id)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $this->tefaRepository->update($request, $id);
            DB::commit();
            Alert::success('Berhasil', 'Data tefa berhasil diupdate.');
            return redirect()->route('tefa.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan.' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan.' . $e->getMessage());
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
            $this->tefaRepository->destroy($id);
            DB::commit();
            Alert::success('Berhasil', 'Data tefa berhasil dihapus.');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan.' . $e->getMessage());
            return redirect()->back();
        } catch (QueryException $e) {
            DB::rollBack();
            Alert::error('Gagal', 'Terjadi kesalahan.' . $e->getMessage());
            return redirect()->back();
        }
    }
}

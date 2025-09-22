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
            return redirect()->route('tefa.index')->with([
                'message' => 'Berhasil menambahkan data',
                'type' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
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
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
            return view('backend.tefa.show', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
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
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
            return view('backend.tefa.edit', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
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
            return redirect()->route('tefa.index')->with([
                'message' => 'Berhasil mengubah data',
                'type' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return $e;
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
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
            return redirect()->back()->with([
                'message' => 'Berhasil menghapus data',
                'type' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan.' . $e->getMessage());
        }
    }
}

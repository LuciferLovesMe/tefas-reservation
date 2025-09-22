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
            return redirect()->route('ruangan.index')->with([
                'message' => 'Berhasil menambahkan data.',
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
            return redirect()->back()->with([
                'message' => 'Terjadi kesalahan. ' . $e->getMessage(),
                'status' => 'error'
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            return $e;
            return redirect()->back()->with([
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
                return redirect()->back()->with([
                    'message' => 'Data tidak ditemukan.',
                    'status' => 'error',
                ]);
            }

            return view('backend.ruangan.edit', compact('data'));
        } catch (Exception $e) {
            return redirect()->back()->with([
                'message' => 'Terjadi kesalahan. ' . $e->getMessage(),
                'status' => 'error'
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->with([
                'message' => 'Terjadi kesalahan. ' . $e->getMessage(),
                'status' => 'error'
            ]);
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
            return redirect()->route('ruangan.index')->with([
                'message' => 'Berhasil mengubah data.',
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $data = $this->ruanganRepository->getById($id);
            if (!$data) {
                return redirect()->back()->with([
                    'message' => 'Data tidak ditemukan.',
                    'status' => 'error',
                ]);
            }
            $this->ruanganRepository->destroy($id);
            DB::commit();
            return redirect()->route('ruangan.index')->with([
                'message' => 'Berhasil menghapus data.',
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

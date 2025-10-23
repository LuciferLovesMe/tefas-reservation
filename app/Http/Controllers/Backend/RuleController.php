<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RuleRequest;
use App\Interfaces\AktivitasInterface;
use App\Interfaces\CapaianPembelajaranInterface;
use App\Interfaces\JenisKunjunganInterface;
use App\Interfaces\RuleInterface;
use App\Interfaces\TefaInterface;
use App\View\Components\ActionButton;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller
{
    private $ruleRepository, $tefaRepository, $aktivitasRepository, $capaianPembelajaranRepository, $jenisKunjunganRepository;
    private $jenjang = ['TK', 'SD', 'SMP', 'SMA'];

    public function __construct(RuleInterface $ruleRepository, TefaInterface $tefaRepository, AktivitasInterface $aktivitasRepository, CapaianPembelajaranInterface $capaianPembelajaranRepository, JenisKunjunganInterface $jenisKunjunganRepository)
    {
        $this->ruleRepository = $ruleRepository;
        $this->tefaRepository = $tefaRepository;
        $this->aktivitasRepository = $aktivitasRepository;
        $this->capaianPembelajaranRepository = $capaianPembelajaranRepository;
        $this->jenisKunjunganRepository = $jenisKunjunganRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->ruleRepository->getAll();
            return datatables()->of($data)
                ->addColumn('jenis_kunjungan', function($row){
                    return $row->jenisKunjungan ? $row->jenisKunjungan->nama : 'Semua Jenis Kunjungan';
                })
                ->addColumn('aktivitas', function($row){
                    return $row->aktivitas ? $row->aktivitas->nama : 'Semua Aktivitas';
                })
                ->addColumn('capaian_pembelajaran', function($row){
                    return $row->capaianPembelajaran ? $row->capaianPembelajaran->nama : 'Semua Capaian Pembelajaran';
                })
                ->addColumn('tefa', function($row){
                    return $row->tefa ? $row->tefa->nama : 'Semua Tefa';
                })
                ->addColumn('action', function ($data) {
                    $button = new ActionButton(
                        route('rule.edit', $data->id),
                        route('rule.destroy', $data->id),
                        $data->id
                    );
                    return $button->render();
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('backend.rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tefa = $this->tefaRepository->getAll()->pluck('nama', 'id')->toArray();
        $aktivitas = $this->aktivitasRepository->getAll()->pluck('nama', 'id')->toArray();
        $capaianPembelajaran = $this->capaianPembelajaranRepository->getAll()->pluck('nama', 'id')->toArray();
        $jenisKunjungan = $this->jenisKunjunganRepository->getAll()->pluck('nama', 'id')->toArray();
        $jenjang = $this->jenjang;
        return view('backend.rule.create', compact('tefa', 'aktivitas', 'capaianPembelajaran', 'jenisKunjungan', 'jenjang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RuleRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->ruleRepository->store($request);
            DB::commit();
            alertSuccess('Aturan berhasil ditambahkan');
            return redirect()->route('rule.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan sistem: '.$e->getMessage());
            return redirect()->back()->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan pada database: '.$e->getMessage());
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
        $data = $this->ruleRepository->getById($id);
        $tefa = $this->tefaRepository->getAll()->pluck('nama', 'id')->toArray();
        $aktivitas = $this->aktivitasRepository->getAll()->pluck('nama', 'id')->toArray();
        $capaianPembelajaran = $this->capaianPembelajaranRepository->getAll()->pluck('nama', 'id')->toArray();
        $jenisKunjungan = $this->jenisKunjunganRepository->getAll()->pluck('nama', 'id')->toArray();
        $jenjang = $this->jenjang;
        return view('backend.rule.edit', compact('data', 'tefa', 'aktivitas', 'capaianPembelajaran', 'jenisKunjungan', 'jenjang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $this->ruleRepository->update($id, $request);
            DB::commit();
            alertSuccess('Aturan berhasil diubah');
            return redirect()->route('rule.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan sistem: '.$e->getMessage());
            return redirect()->back()->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan pada database: '.$e->getMessage());
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
            $this->ruleRepository->destroy($id);
            DB::commit();
            alertSuccess('Aturan berhasil dihapus');
            return redirect()->route('rule.index');
        } catch (Exception $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan sistem: '.$e->getMessage());
            return redirect()->back()->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            alertError('Terjadi kesalahan pada database: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function getCapaianByAktivitas($id)
    {
        $data = $this->ruleRepository->getCapaianByAktivitas($id);
        return response()->json($data);
    }

    public function getJenisKunjunganByCapaian($id)
    {
        $data = $this->ruleRepository->getJenisKunjunganByCapaian($id);
        return response()->json($data);
    }
}

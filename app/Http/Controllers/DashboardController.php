<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userRole = auth()->user()->role;
        if ($request->ajax()) {
            return datatables()
                ->of(Reservasi::with('tefa')
                    ->with('customer')
                    ->when($userRole === 'customer', function ($query) {
                        $query->where('customer_id', auth()->user()->id);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->get())
                ->addIndexColumn()
                ->addColumn('start', function ($data) {
                    return $data->jadwal_mulai ? dateTimeFormat($data->jadwal_mulai) : '-';
                })
                ->addColumn('end', function ($data) {
                    return $data->jadwal_berakhir ? dateTimeFormat($data->jadwal_berakhir) : '-';
                })
                ->addColumn('tanggal_reservasi', function ($data) {
                    return $data->tanggal_reservasi ? dateFormat($data->tanggal_reservasi) : '-';
                })
                ->addColumn('nama_pemesan', function ($data) {
                    return $data->customer ? $data->customer->name : '-';
                })
                ->addColumn('status', function ($data) {
                    $pillStatus = new \App\View\Components\PillStatus($data->status);
                    return $pillStatus->render();
                })
                ->addColumn('nama_tefa', function ($data) {
                    return $data->tefa ? $data->tefa->nama : '-';
                })
                ->make(true);
        }

        $baseQuery = Reservasi::when($userRole === 'customer', function ($query) {
            $query->where('customer_id', auth()->user()->id);
        });

        // Hitung satu per satu. Ini akan menghasilkan 3 query COUNT yang cepat.
        $pendingCount = (clone $baseQuery)->where('status', 'pending')->count();
        $doneCount = (clone $baseQuery)->where('status', 'done')->count();
        $cancelCount = (clone $baseQuery)->where('status', 'cancel')->count();

        // Anda bisa langsung teruskan variabel ini ke view:
        // return view('dashboard', compact('pendingCount', 'doneCount', 'cancelCount'));

        // Atau jika Anda tetap butuh format array/collection:
        $dataReservasiCard = [
            'pending' => $pendingCount,
            'done' => $doneCount,
            'cancel' => $cancelCount,
        ];
        // return $dataReservasiCard;
        return view('backend.dashboard.index', compact('dataReservasiCard'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

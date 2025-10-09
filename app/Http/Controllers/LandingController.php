<?php

namespace App\Http\Controllers;

use App\Interfaces\TefaInterface;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    private $tefaRepository;

    public function __construct(TefaInterface $tefaRepository)
    {
        $this->tefaRepository = $tefaRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tefaData = $this->tefaRepository->getAll();
        return view('landing.index', compact('tefaData'));
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
        $tefa = $this->tefaRepository->getById($id);
        // return $tefa;
        return view('landing.show', compact('tefa'));
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

    public function galeri($id)
    {
        $tefa = $this->tefaRepository->getById($id);
        return view('landing.galeri', compact('tefa'));
    }
}

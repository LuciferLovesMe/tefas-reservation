<?php

use App\Http\Controllers\Backend\AktivitasController;
use App\Http\Controllers\Backend\CapaianPembelajaranController;
use App\Http\Controllers\Backend\JenisKunjunganController;
use App\Http\Controllers\Backend\ReservasiController;
use App\Http\Controllers\Backend\TefaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\RuanganController;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/detail/{id}', [LandingController::class, 'show'])->name('landing.show');
Route::get('detail/{id}/galeri', [LandingController::class, 'galeri'])->name('landing.galeri');

Route::get('/dashboard', function () {
    return view('layouts.layout');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/tefa', TefaController::class)->middleware(AdminMiddleware::class);
    // Route::resource('/ruangan', RuanganController::class)->middleware(AdminMiddleware::class);
    Route::resource('/jenis-kunjungan', JenisKunjunganController::class)->middleware(AdminMiddleware::class);
    Route::resource('/aktivitas', AktivitasController::class)->middleware(AdminMiddleware::class);
    Route::resource('/capaian-pembelajaran', CapaianPembelajaranController::class)->middleware(AdminMiddleware::class);
    Route::resource('/reservasi', ReservasiController::class);
});


require __DIR__.'/auth.php';

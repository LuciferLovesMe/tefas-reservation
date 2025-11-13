<?php

use App\Http\Controllers\Backend\AktivitasController;
use App\Http\Controllers\Backend\CapaianPembelajaranController;
use App\Http\Controllers\Backend\JenisKunjunganController;
use App\Http\Controllers\Backend\ReservasiController;
use App\Http\Controllers\Backend\TefaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\RuleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/detail/{id}', [LandingController::class, 'show'])->name('landing.show');
Route::get('detail/{id}/galeri', [LandingController::class, 'galeri'])->name('landing.galeri');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/tefa', TefaController::class)->middleware(AdminMiddleware::class);
    Route::resource('/jenis-kunjungan', JenisKunjunganController::class)->middleware(AdminMiddleware::class);
    Route::resource('/aktivitas', AktivitasController::class)->middleware(AdminMiddleware::class);
    Route::resource('/capaian-pembelajaran', CapaianPembelajaranController::class)->middleware(AdminMiddleware::class);
    Route::get('getCapaianByAktivitas/', [ReservasiController::class, 'getCapaianByAktivitas'])->name('getCapaianByAktivitas');
    Route::get('getJenisKunjunganByCapaian/{id}', [ReservasiController::class, 'getJenisKunjunganByCapaian'])->name('getJenisKunjunganByCapaian');
    Route::get('getTefaByJenisKunjungan', [ReservasiController::class, 'getTefaByJenisKunjungan'])->name('getTefaByJenisKunjungan');
    Route::resource('/reservasi', ReservasiController::class);
    Route::put('reservasi/update-status/{id}', [ReservasiController::class, 'updateStatus'])->name('reservasi.updateStatus');
});


require __DIR__.'/auth.php';

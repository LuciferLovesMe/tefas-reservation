<?php

use App\Http\Controllers\Backend\ReservasiController;
use App\Http\Controllers\Backend\TefaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\RuanganController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/dashboard', function () {
    return view('layouts.layout');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/tefa', TefaController::class)->middleware(AdminMiddleware::class);
    Route::resource('/ruangan', RuanganController::class)->middleware(AdminMiddleware::class);
    Route::resource('/reservasi', ReservasiController::class);
});


require __DIR__.'/auth.php';

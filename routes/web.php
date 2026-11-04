<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\AbsensiController;

Route::get('/', function () {
    return redirect()->route('matakuliah.index');
});

Route::resource('matakuliah', MataKuliahController::class);

Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
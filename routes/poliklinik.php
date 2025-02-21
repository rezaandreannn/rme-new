<?php

use App\Http\Controllers\Kunjungan\Poliklinik\PoliklinikPerawatController;
use Illuminate\Support\Facades\Route;

Route::prefix('poliklinik')->name('poliklinik.')->middleware('auth')->group(function () {
    // Penandaan Lokasi Operasi
    Route::get('poliklinik', [PoliklinikPerawatController::class, 'index'])->name('index');
    Route::get('/poliklinik/{noReg}', [PoliklinikPerawatController::class, 'entry'])->name('entry');
    Route::post('poliklinik', [PoliklinikPerawatController::class, 'store'])->name('store');
    Route::get('/poliklinik/{id}/edit', [PoliklinikPerawatController::class, 'edit'])->name('edit');
    Route::put('/poliklinik/{id}/update', [PoliklinikPerawatController::class, 'update'])->name('update');
    Route::delete('/poliklinik/delete/{id}', [PoliklinikPerawatController::class, 'destroy'])->name('destroy');
    Route::get('/poliklinik/cetak/{kode_register}', [PoliklinikPerawatController::class, 'cetak'])->name('cetak');
});

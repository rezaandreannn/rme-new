<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelayanan\Poliklinik\ListDataPasienController;
use App\Http\Controllers\Kunjungan\Poliklinik\PoliklinikPerawatController;

Route::prefix('pelayanan')->name('pelayanan.')->middleware('auth')->group(function () {
    // routing  untuk rawat jalan
    Route::prefix('poliklinik')->name('poliklinik.')->group(function () {
        Route::get('list-px', [ListDataPasienController::class, 'index'])->name('list-px');
    });
});

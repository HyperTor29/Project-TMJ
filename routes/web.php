<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormLolosController;
use App\Http\Controllers\RekapanController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/form-lolos/print/{id}', [FormLolosController::class, 'print'])->name('form-lolos.print');
Route::get('/rekapan/{id}', [RekapanController::class, 'show'])->name('rekapan.show');
Route::post('/rekapan/{formId}/accept', [RekapanController::class, 'accept'])->name('rekapan.accept');
Route::post('/rekapan/{formId}/reject', [RekapanController::class, 'reject'])->name('rekapan.reject');
Route::get('/rekaps', \App\Filament\Resources\RekapResource\Pages\ListRekaps::class)
    ->name('rekaps.index');


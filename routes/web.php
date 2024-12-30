<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapanController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Artisan;

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link successfully';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rekapan/{id}', [RekapanController::class, 'show'])->name('rekapan.show');
Route::post('/rekapan/{id}/accept', [RekapanController::class, 'accept'])->name('rekapan.accept');
Route::post('/rekapan/{id}/reject', [RekapanController::class, 'reject'])->name('rekapan.reject');
Route::post('/rekapan/{id}/accept-single/{detailId}', [RekapanController::class, 'acceptSingle'])->name('rekapan.accept-single');
Route::post('/rekapan/{id}/reject-single/{detailId}', [RekapanController::class, 'rejectSingle'])->name('rekapan.reject-single');
Route::get('rekapan/{id}/print', [RekapanController::class, 'print'])->name('rekapan.print');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('filament.auth.login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

<?php

use App\Http\Controllers\Api\AsmenController;
use App\Http\Controllers\Api\DataCsController;
use App\Http\Controllers\Api\DataCssController;
use App\Http\Controllers\Api\DetailLolosController;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\GarduController;
use App\Http\Controllers\Api\GerbangController;
use App\Http\Controllers\Api\GolKdrController;
use App\Http\Controllers\Api\InstansiController;
use App\Http\Controllers\Api\ShiftController;
use App\Http\Controllers\Api\TarifController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {
    $routes = [
        'data_cs' => DataCsController::class,
        'data_css' => DataCssController::class,
        'asmen' => AsmenController::class,
        'form' => FormController::class,
        'detail_lolos' => DetailLolosController::class,
        'gardu' => GarduController::class,
        'gerbang' => GerbangController::class,
        'gol_kdr' => GolKdrController::class,
        'instansi' => InstansiController::class,
        'shift' => ShiftController::class,
        'tarif' => TarifController::class,
        'user' => UserController::class,
    ];

    Route::get('/all', function () use ($routes) {
        $data = [];
        foreach ($routes as $prefix => $controller) {
            if (method_exists(app($controller), 'index')) {
                try {
                    $data[$prefix] = app($controller)->index();
                } catch (\Exception $e) {
                    $data[$prefix] = ['error' => $e->getMessage()];
                }
            } else {
                $data[$prefix] = ['error' => 'Index method not found'];
            }
        }
        return response()->json($data);
    });

    foreach ($routes as $prefix => $controller) {
        Route::prefix($prefix)->group(function () use ($controller, $prefix) {
            if ($prefix === 'user') {
                Route::post('/login', [$controller, 'login']);
                Route::post('/logout', [UserController::class, 'logout']);
            }

            Route::apiResource('/', $controller)->only([
                'index', 'store', 'show', 'update', 'destroy'
            ])->names([
                'index' => "{$prefix}.index",
                'store' => "{$prefix}.store",
                'show' => "{$prefix}.show",
                'update' => "{$prefix}.update",
                'destroy' => "{$prefix}.destroy"
            ])->missing(function () {
                return response()->json(['message' => 'Resource not found'], 404);
            });
        });
    }
});

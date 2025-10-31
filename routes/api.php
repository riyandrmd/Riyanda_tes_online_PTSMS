<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('barangs', BarangController::class);
    Route::apiResource('pembelians', PembelianController::class);
    Route::apiResource('users', UserController::class);
    Route::get('/laporan/pembelian', [LaporanController::class, 'laporanPembelian']);
});

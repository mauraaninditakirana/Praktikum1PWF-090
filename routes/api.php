<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route untuk Login (Mendapatkan Access Token) sesuai modul
Route::post('/login', [AuthController::class, 'getToken']);

// Route GET Publik (Melihat data tidak perlu token)
Route::get('/product', [ProductApiController::class, 'index']); // GET semua produk
Route::get('/product/{id}', [ProductApiController::class, 'show']); // GET 1 produk
Route::get('/category', [CategoryApiController::class, 'index']); // GET semua kategori
Route::get('/category/{id}', [CategoryApiController::class, 'show']); // GET 1 kategori

// Route Terlindungi (Wajib pakai token Sanctum) sesuai tugas
Route::middleware('auth:sanctum')->group(function () {
    // API Product
    Route::post('/product', [ProductApiController::class, 'store']);
    Route::put('/product/{id}', [ProductApiController::class, 'update']);
    Route::delete('/product/{id}', [ProductApiController::class, 'destroy']);

    // API Category
    Route::post('/category', [CategoryApiController::class, 'store']);
    Route::put('/category/{id}', [CategoryApiController::class, 'update']);
    Route::delete('/category/{id}', [CategoryApiController::class, 'destroy']);
});
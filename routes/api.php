<?php

use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\NgayHocController;
use App\Http\Controllers\UserController;
use App\Models\MonhocNgayhoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', 'AuthController@login');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('/lophoc', LopHocController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/ngayhoc', NgayHocController::class);
    Route::resource('/monhoc', MonHocController::class);
});
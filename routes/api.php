<?php

use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\NgayHocController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PhongHocController;
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
Route::post('/login', [AuthController::class,'login']);
 Route::get('/getngayhocbygv/{id}', [NgayHocController::class,'getNgayHocByGiangVien']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/getphonghocbydate/{start}', [PhongHocController::class,'getPhongHocByDate']);
    Route::post('/changepassword',[UserController::class,'chagePassword']);
    Route::resource('/lophoc', LopHocController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/ngayhoc', NgayHocController::class);
    Route::resource('/monhoc', MonHocController::class);
    Route::resource('/phanquyen', PermissionsController::class);
    Route::resource('/phonghoc', PhongHocController::class);
   
});
<?php

use App\Helpers\Resfor;
use App\Http\Controllers\Api\KotaController;
use App\Http\Controllers\Api\ProvinsiController;
use App\Http\Controllers\ApiMitra\Auth\MitraAuthController;
use App\Http\Controllers\ApiMitra\Auth\MitraLupaPasswordController;
use App\Http\Controllers\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('setting', [SettingController::class, 'get']);
Route::get('provinsi', [ProvinsiController::class, 'get']);
Route::post('kota', [KotaController::class, 'getByProvinsi']);

// ==============================================================================

Route::post('mitra/auth/daftar', [MitraAuthController::class, 'daftar']);
Route::post('mitra/auth/login', [MitraAuthController::class, 'login']);

Route::post('mitra/auth/resend', [MitraAuthController::class, 'resend_otp']);
Route::post('mitra/auth/login-otp', [MitraAuthController::class, 'login_otp']);

Route::post('mitra/auth/lupa-password', [MitraLupaPasswordController::class, 'kirimLupaPassword']);


Route::middleware(['MitraApiLogin'])->group(function () {
    Route::post('mitra/auth/me', [MitraAuthController::class, 'me']);
    Route::post('mitra/auth/refresh', [MitraAuthController::class, 'refresh']);
    Route::post('mitra/auth/logout', [MitraAuthController::class, 'logout']);



});

// =================================================================================

Route::fallback(function () {
    return Resfor::error(null, 'api url tidak ada', 404);
});

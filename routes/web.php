<?php

use App\Http\Controllers\ApiMitra\Auth\MitraLupaPasswordController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\webAdminAuthController;
use App\Http\Livewire\AlasLapangan\AlasLapanganPage;
use App\Http\Livewire\BankPerusahaan\BankPerusahaanPage;
use App\Http\Livewire\Bank\BankPage;
use App\Http\Livewire\Customer\CustomerPage;
use App\Http\Livewire\DashboardPage;
use App\Http\Livewire\Fasilitas\FasilitasPage;
use App\Http\Livewire\IklanMitra\IklanMitraPage;
use App\Http\Livewire\KelolaAkun\KelolaAkunPage;
use App\Http\Livewire\KotaPage;
use App\Http\Livewire\LoginPage;
use App\Http\Livewire\MetodePembayaran\MetodePembayaranPage;
use App\Http\Livewire\Mitra\MitraPage;
use App\Http\Livewire\Olahraga\OlahragaPage;
use App\Http\Livewire\Promo\PromoPage;
use App\Http\Livewire\ProvinsiPage;
use App\Http\Livewire\Setting\SettingPage;
use App\Http\Livewire\TipeLapangan\TipeLapanganPage;
use App\Http\Livewire\TransaksiMember\TransaksiMemberPage;
use App\Http\Livewire\Transaksi\TransaksiPage;
use App\Mail\SendCodeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');

// });

// Route::middleware(['adminWeb'])->group(function () {

// });

// Route::get('test-email', function () {
//     try {
//         $details = [
//             'title' => 'GoLapang OTP',
//             'code' => 2324,
//         ];
//         Mail::to('vernandaspw@gmail.com')->send(new SendCodeMail($details));
//         if (Mail::failures()) {
//             dd('Sorry! Please try again latter');
//             return response()->Fail('Sorry! Please try again latter');
//         } else {
//             dd('Great! Successfully send in your mail');
//             return response()->success('Great! Successfully send in your mail');
//         }
//     } catch (\Exception$e) {
//         dd($e->getMessage());
//     }
// });

Route::middleware('adminWebLoged')->group(function () {
    Route::get('login', LoginPage::class);
});

Route::middleware('adminWebLogin')->group(function () {
    Route::get('logout', [webAdminAuthController::class, 'logout']);

    Route::get('/', DashboardPage::class);
    Route::get('setting', SettingPage::class);
    Route::get('akun', KelolaAkunPage::class);

    Route::get('alas-lapangan', AlasLapanganPage::class);
    Route::get('tipe-lapangan', TipeLapanganPage::class);
    Route::get('fasilitas', FasilitasPage::class);
    Route::get('olahraga', OlahragaPage::class);
    Route::get('kota', KotaPage::class);
    Route::get('provinsi', ProvinsiPage::class);
    Route::get('bank', BankPage::class);
    Route::get('bank-perusahaan', BankPerusahaanPage::class);
    Route::get('metode-pembayaran', MetodePembayaranPage::class);
    Route::get('promo', PromoPage::class);
    Route::get('iklan-mitra', IklanMitraPage::class);
    Route::get('mitra', MitraPage::class);
    Route::get('customer', CustomerPage::class);
    Route::get('transaksi', TransaksiPage::class);
    Route::get('transaksi-member', TransaksiMemberPage::class);

});

Route::get('mitra/auth/reset-password/{token}', [MitraLupaPasswordController::class, 'showResetPasswordForm']);
Route::post('mitra/auth/reset-password', [MitraLupaPasswordController::class, 'submitResetPasswordForm']);


Route::get('telegram', [TelegramBotController::class, 'send']);

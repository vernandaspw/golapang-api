<?php

namespace App\Http\Controllers\ApiMitra\Auth;

use App\Helpers\ApiWatsap;
use App\Helpers\Resfor;
use App\Http\Controllers\Controller;
use App\Models\MitraUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MitraLupaPasswordController extends Controller
{

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function kirimLupaPassword(Request $req)
    {

        $cekToken = DB::table('password_resets')
            ->where([
                'email_or_phone' => $req->email_or_phone,
            ])
            ->first();
        if ($cekToken) {
            $token = $cekToken->token;
            // kirim langsung
            if (strstr($req->email_or_phone, '@')) {
                $email = MitraUser::where('email', $req->email_or_phone)->first();
                if ($email) {
                    try {
                        Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use ($req) {
                            $message->to($req->email_or_phone);
                            $message->subject('Reset Password');
                        });
                    } catch (\Exception$e) {
                        info("Error: " . $e->getMessage());
                        return Resfor::error($e->getMessage(), 'kesalahan koneksi internet', 500);
                    }
                    return Resfor::success(null, 'Kami telah mengirimkan tautan setel ulang kata sandi Anda melalui email!');

                } else {
                    return Resfor::error(null, 'email tidak ditemukan');
                }
            } else {
                $tel = is_numeric($req->email_or_phone);
                if ($tel) {
                    $wa = MitraUser::where('phone', $req->email_or_phone)->first();
                    if ($wa) {
                        try {
                            ApiWatsap::send($wa->phone, '*Reset Password*
Anda dapat mengatur ulang kata sandi dari tautan berikut :
' . env('APP_URL_WEB') . '/reset-password/' . $token);
                        } catch (\Exception$e) {
                            info("Error: " . $e->getMessage());
                            return Resfor::error($e->getMessage(), 'kesalahan koneksi internet', 500);
                        }
                        return Resfor::success(null, 'Kami telah mengirimkan tautan setel ulang kata sandi Anda melalui whatsapp!');
                    } else {
                        return Resfor::error(null, 'whatsapp tidak ditemukan');
                    }
                } else {
                    return Resfor::error(null, 'isi email/nomor whatsapp dengan benar');
                }
            }
        } else {
            $token = Str::random(64);
            if (strstr($req->email_or_phone, '@')) {
                $email = MitraUser::where('email', $req->email_or_phone)->first();
                if ($email) {
                    try {
                        Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use ($req) {
                            $message->to($req->email_or_phone);
                            $message->subject('Reset Password');
                        });
                    } catch (\Exception$e) {
                        info("Error: " . $e->getMessage());
                        return Resfor::error($e->getMessage(), 'kesalahan koneksi internet', 500);
                    }
                    DB::table('password_resets')->insert([
                        'email_or_phone' => $req->email_or_phone,
                        'token' => $token,
                        'created_at' => Carbon::now(),
                    ]);
                    return Resfor::success(null, 'Kami telah mengirimkan tautan setel ulang kata sandi Anda melalui email!');

                } else {
                    return Resfor::error(null, 'email tidak ditemukan');
                }
            } else {
                $tel = is_numeric($req->email_or_phone);
                if ($tel) {
                    $wa = MitraUser::where('phone', $req->email_or_phone)->first();
                    if ($wa) {
                        try {
                            ApiWatsap::send($wa->phone, '*Reset Password*
Anda dapat mengatur ulang kata sandi dari tautan berikut :
' . env('APP_URL_WEB') . '/reset-password/' . $token);
                        } catch (\Exception$e) {
                            info("Error: " . $e->getMessage());
                            return Resfor::error($e->getMessage(), 'kesalahan koneksi internet', 500);
                        }
                        DB::table('password_resets')->insert([
                            'email_or_phone' => $req->email_or_phone,
                            'token' => $token,
                            'created_at' => Carbon::now(),
                        ]);
                        return Resfor::success(null, 'Kami telah mengirimkan tautan setel ulang kata sandi Anda melalui whatsapp!');
                    } else {
                        return Resfor::error(null, 'whatsapp tidak ditemukan');
                    }
                } else {
                    return Resfor::error(null, 'isi email/nomor whatsapp dengan benar');
                }
            }
        }

    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $akun = MitraUser::where('email', $request->email_or_phone)->orWhere('phone', $request->email_or_phone)->first();

        if (!$akun) {
            return back()->withInput()->with('error', 'Akun tidak ditemukan!');
        }

        $updatePassword = DB::table('password_resets')
            ->where([
                'email_or_phone' => $request->email_or_phone,
                'token' => $request->token,
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $akun->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_resets')->where(['email_or_phone' => $akun->email])->delete();
        DB::table('password_resets')->where(['email_or_phone' => $akun->phone])->delete();

        return back()->with('success', 'Kata sandi Anda telah diubah!');
    }
}

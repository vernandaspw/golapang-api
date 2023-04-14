<?php

namespace App\Http\Controllers\ApiMitra\Auth;

use App\Helpers\Resfor;
use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\MitraUser;
use App\Models\Setting;
use App\Models\Tempat;
use App\Models\TempatJamOperasional;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MitraAuthController extends Controller
{
    public function daftar(Request $req)
    {
        //  buat dulu mitra, lalu mitra user, lalu tempat olahraga utama
        $nama_pengguna = $req->nama_pengguna;
        $phone = $req->phone;
        $email = $req->email;
        $password = $req->password;
        $nama_mitra = $req->nama_mitra;
        $nama_tempat = $req->nama_tempat;
        $deskripsi_tempat = $req->deskripsi_tempat;
        $provinsi_id = $req->provinsi_id;
        $kota_id = $req->kota_id;
        $kecamatan = $req->kecamatan;
        $alamat = $req->alamat;

        $mitraNama = Mitra::where('nama', $nama_mitra)->first();
        if ($mitraNama != null) {
            return Resfor::error(null, 'nama mitra sudah ada', 405);
        }
        $mitraUserPhone = MitraUser::where('phone', $phone)->first();
        if ($mitraUserPhone != null) {
            return Resfor::error(null, 'phone user sudah terdaftar', 405);
        }
        $mitraUserEmail = MitraUser::where('email', $email)->first();
        if ($mitraUserEmail != null) {
            return Resfor::error(null, 'email user sudah terdaftar', 405);
        }
        $tempatNama = Tempat::where('nama', $nama_tempat)->first();
        if ($tempatNama != null) {
            return Resfor::error(null, 'nama tempat sudah ada', 405);
        }
        // buat validator password

        // 90 hari
        $billing_expired_at = Carbon::today()->addDays(30);

        $mitraCreate = Mitra::create([
            'nama' => $nama_mitra,
            'slug' => Str::slug($nama_mitra),
            'saldo' => 0,
            'saldo_kredit' => 0,
            'billing_status' => 'premium',
            'billing_expired_at' => $billing_expired_at,
        ]);
        $mitraUserCreate = MitraUser::create([
            'uuid' => Str::uuid(),
            'mitra_id' => $mitraCreate->id,
            'tempat_id' => null,
            'nama' => $nama_pengguna,
            'phone' => $phone,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'pemilik',
        ]);

        $tempat = Tempat::create([
            'mitra_id' => $mitraCreate->id,
            'nama' => $nama_tempat,
            'slug' => Str::slug($nama_tempat),
            'deskripsi' => $deskripsi_tempat,
            'provinsi_id' => $provinsi_id,
            'kota_id' => $kota_id,
            'kecamatan' => $kecamatan,
            'alamat' => $alamat,
            'isutama' => true,
        ]);

        TempatJamOperasional::create([
            'mitra_id' => $mitraCreate->id,
            'tempat_id' => $tempat->id,
            'hari' => 'senin',
            'jam_buka' => '07:00:00',
            'jam_tutup' => '24:59:00',
        ]);
        TempatJamOperasional::create([
            'mitra_id' => $mitraCreate->id,
            'tempat_id' => $tempat->id,
            'hari' => 'selasa',
            'jam_buka' => '07:00:00',
            'jam_tutup' => '24:59:00',
        ]);
        TempatJamOperasional::create([
            'mitra_id' => $mitraCreate->id,
            'tempat_id' => $tempat->id,
            'hari' => 'rabu',
            'jam_buka' => '07:00:00',
            'jam_tutup' => '24:59:00',
        ]);
        TempatJamOperasional::create([
            'mitra_id' => $mitraCreate->id,
            'tempat_id' => $tempat->id,
            'hari' => 'kamis',
            'jam_buka' => '07:00:00',
            'jam_tutup' => '24:59:00',
        ]);
        TempatJamOperasional::create([
            'mitra_id' => $mitraCreate->id,
            'tempat_id' => $tempat->id,
            'hari' => 'jumat',
            'jam_buka' => '07:00:00',
            'jam_tutup' => '24:59:00',
        ]);
        TempatJamOperasional::create([
            'mitra_id' => $mitraCreate->id,
            'tempat_id' => $tempat->id,
            'hari' => 'sabtu',
            'jam_buka' => '07:00:00',
            'jam_tutup' => '24:59:00',
        ]);
        TempatJamOperasional::create([
            'mitra_id' => $mitraCreate->id,
            'tempat_id' => $tempat->id,
            'hari' => 'minggu',
            'jam_buka' => '07:00:00',
            'jam_tutup' => '24:59:00',
        ]);

        // setelah barhasil, melakukan login
        $token = auth('mitra-api')->setTTL(env('JWT_LOGIN_EXPIRED'))->login($mitraUserCreate);

        return Resfor::success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('mitra-api')->factory()->getTTL(),
            'userId' => auth('mitra-api')->user()->id,
            'userUuid' => auth('mitra-api')->user()->uuid,
            'userMitraId' => auth('mitra-api')->user()->mitra_id,
            'userRole' => auth('mitra-api')->user()->role,
            'userNama' => auth('mitra-api')->user()->nama,
        ], 'success');

    }

    public function login(Request $req)
    {
        $setting = Setting::find(1);

        if ($setting->mitra_otp_wa == true && $setting->mitra_otp_email == true) {
            if (strstr($req->email_or_phone, '@')) {
                $email = MitraUser::where('email', $req->email_or_phone)->first();
                if ($email) {
                    if ($setting->mitra_password == true) {
                        if (Hash::check($req->password, $email->password)) {
                            $val = MitraUser::sendOtpEmail($email);
                            return $val;
                        } else {
                            return Resfor::error(null, 'password salah');
                        }
                    } else {
                        // tanpa password
                        $val = MitraUser::sendOtpEmail($email);
                        return $val;
                    }

                } else {
                    return Resfor::error(null, 'email tidak ditemukan');
                }
            } else {
                $tel = is_numeric($req->email_or_phone);
                if ($tel) {
                    $wa = MitraUser::where('phone', $req->email_or_phone)->first();
                    if ($wa) {
                        if ($setting->mitra_password == true) {
                            if (Hash::check($req->password, $wa->password)) {
                                $val = MitraUser::sendOtpWa($wa);
                                return $val;
                            } else {

                                return Resfor::error(null, 'password salah');
                            }
                        } else {
                            // tanpa password
                            $val = MitraUser::sendOtpWa($wa);
                            return $val;
                        }
                    } else {
                        return Resfor::error(null, 'whatsapp tidak ditemukan');
                    }
                } else {
                    return Resfor::error(null, 'isi email/nomor whatsapp dengan benar');
                }
            }
        } elseif ($setting->mitra_otp_email == true) {
            if (strstr($req->email_or_phone, '@')) {
                $email = MitraUser::where('email', $req->email_or_phone)->first();
                if ($email) {
                    if ($setting->mitra_password == true) {
                        if (Hash::check($req->password, $email->password)) {
                            $val = MitraUser::sendOtpEmail($email);
                            return $val;
                        } else {
                            return Resfor::error(null, 'password salah');
                        }
                    } else {
                        // tanpa password
                        $val = MitraUser::sendOtpEmail($email);
                        return $val;
                    }

                } else {
                    return Resfor::error(null, 'email tidak ditemukan');
                }
            } else {
                return Resfor::error(null, 'isi email dengan benar');
            }
        } elseif ($setting->mitra_otp_wa == true) {
            $tel = is_numeric($req->email_or_phone);
            if ($tel) {
                $wa = MitraUser::where('phone', $req->email_or_phone)->first();
                if ($wa) {
                    if ($setting->mitra_password == true) {
                        if (Hash::check($req->password, $wa->password)) {
                            $val = MitraUser::sendOtpWa($wa);
                            return $val;
                        } else {
                            return Resfor::error(null, 'password salah');
                        }
                    } else {
                        // tanpa password
                        $val = MitraUser::sendOtpWa($wa);
                        return $val;
                    }
                } else {
                    return Resfor::error(null, 'whatsapp tidak ditemukan');
                }
            } else {
                return Resfor::error(null, 'isi email/nomor whatsapp dengan benar');
            }
        } else {
            // jika tanpa otp  yyaaaa wajib password
            if ($req->password != null) {
                // langsung login tanpa kirim otp
                $akun = MitraUser::where('phone', $req->email_or_phone)->orWhere('email', $req->email_or_phone)->first();
                if ($akun) {
                    // cek pass
                    if (Hash::check($req->password, $akun->password)) {
                        $token = auth('mitra-api')->setTTL(env('JWT_LOGIN_EXPIRED'))->login($akun, true);
                        $akun->update([
                            'code' => bcrypt(rand(env('OTP_RAND_START'), env('OTP_RAND_END'))),
                            'last_seen_at' => now(),
                        ]);
                        return Resfor::success([
                            'access_token' => $token,
                            'token_type' => 'bearer',
                            'expires_in' => auth('mitra-api')->factory()->getTTL(),
                            'userId' => auth('mitra-api')->user()->id,
                            'userUuid' => auth('mitra-api')->user()->uuid,
                            'userMitraId' => auth('mitra-api')->user()->mitra_id,
                            'userRole' => auth('mitra-api')->user()->role,
                            'userNama' => auth('mitra-api')->user()->nama,
                        ], 'success');
                    } else {
                        return Resfor::error(null, 'password salah');
                    }
                } else {
                    return Resfor::error(null, 'Email/nomor whatsapp tidak ditemukan');
                }
            } else {
                return Resfor::error(null, 'password wajib diisi');
            }
        }
    }

    public function resend_otp(Request $req)
    {
        // $validator = Validator::make($req->all(), [
        //     'email_or_phone' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return Resfor::error($validator->errors(), 'validator', 422);
        // }

        // cek otp code_resend_at

        // cek scure
        $email_or_phone = $req->email_or_phone;

        if (strstr($email_or_phone, '@')) {
            $email = MitraUser::where('email', $email_or_phone)->first();
            if ($email) {
                if ($email->code_resend_at <= now()) {
                    return MitraUser::sendOtpEmail($email);
                } else {
                    return Resfor::error(null, 'kirim ulang setelah ' . date('H:i', strtotime($email->code_resend_at)));
                }
            } else {
                return Resfor::error(null, 'akun tidak ditemukan, silahkan login ulang', 401);
            }
        } else {
            $tel = is_numeric($email_or_phone);
            if ($tel) {
                $wa = MitraUser::where('phone', $email_or_phone)->first();
                if ($wa) {
                    if ($wa->code_resend_at <= now()) {
                        return MitraUser::sendOtpWa($wa);
                    } else {
                        return Resfor::error(null, 'kirim ulang setelah ' . date('H:i', strtotime($wa->code_resend_at)));
                    }
                } else {
                    return Resfor::error(null, 'akun tidak ditemukan, silahkan login ulang', 401);
                }
            } else {
                return Resfor::error(null, 'masukan nomor whatsapp yg benar');
            }
        }
    }

    public function login_otp(Request $req)
    {
        $email_or_phone = $req->email_or_phone;
        $password = $req->password;
        $otp = $req->otp;

        $setting = Setting::find(1);
        if (strstr($email_or_phone, '@')) {
            $email = MitraUser::where('email', $email_or_phone)->first();
            if ($email) {
                if ($password != null) {
                    if (Hash::check($password, $email->password)) {
                        if ($email->code_expired_at >= now()) {
                            $cekotp = Hash::check($otp, $email->code);
                            if ($cekotp) {
                                $token = auth('mitra-api')->setTTL(env('JWT_LOGIN_EXPIRED'))->login($email, true);
                                $email->update([
                                    'code' => bcrypt(rand(env('OTP_RAND_START'), env('OTP_RAND_END'))),
                                    'last_seen_at' => now(),
                                ]);
                                return Resfor::success([
                                    'access_token' => $token,
                                    'token_type' => 'bearer',
                                    'expires_in' => auth('mitra-api')->factory()->getTTL(),
                                    'userId' => auth('mitra-api')->user()->id,
                                    'userUuid' => auth('mitra-api')->user()->uuid,
                                    'userMitraId' => auth('mitra-api')->user()->mitra_id,
                                    'userRole' => auth('mitra-api')->user()->role,
                                    'userNama' => auth('mitra-api')->user()->nama,
                                ], 'success');
                            } else {
                                return Resfor::error(null, 'kode otp salah');
                            }
                        } else {
                            return Resfor::error(null, 'kode otp telah expired');
                        }
                    } else {
                        return Resfor::error(null, 'password salah');
                    }
                } else {
                    if ($email->code_expired_at >= now()) {
                        $cekotp = Hash::check($otp, $email->code);
                        if ($cekotp) {
                            $token = auth('mitra-api')->setTTL(env('JWT_LOGIN_EXPIRED'))->login($email, true);
                            $email->update([
                                'code' => bcrypt(rand(env('OTP_RAND_START'), env('OTP_RAND_END'))),
                                'last_seen_at' => now(),
                            ]);
                            return Resfor::success([
                                'access_token' => $token,
                                'token_type' => 'bearer',
                                'expires_in' => auth('mitra-api')->factory()->getTTL(),
                                'userId' => auth('mitra-api')->user()->id,
                                'userUuid' => auth('mitra-api')->user()->uuid,
                                'userMitraId' => auth('mitra-api')->user()->mitra_id,
                                'userRole' => auth('mitra-api')->user()->role,
                                'userNama' => auth('mitra-api')->user()->nama,
                            ], 'success');
                        } else {
                            return Resfor::error(null, 'kode otp salah');
                        }
                    } else {
                        return Resfor::error(null, 'kode otp telah expired');
                    }
                }
            } else {
                return Resfor::error(null, 'akun email tidak ditemukan');
            }
        } else {
            $tel = is_numeric($email_or_phone);
            if ($tel) {
                // if (strpos(substr($rmail_or_phone, 0, 3), '08') !== false) {
                //     $awal = str_replace("08", "628", substr($req->email_or_phone, 0, 3));
                //     $req->email_or_phone = $awal . substr($req->email_or_phone, 3);
                // }
                $wa = MitraUser::where('phone', $email_or_phone)->first();
                if ($wa) {
                    if ($req->password != null) {
                        if (Hash::check($password, $wa->password)) {
                            if ($wa->code_expired_at >= now()) {
                                $cekotp = Hash::check($otp, $wa->code);
                                if ($cekotp) {
                                    $token = auth('mitra-api')->setTTL(env('JWT_LOGIN_EXPIRED'))->login($wa, true);
                                    $wa->update([
                                        'code' => bcrypt(rand(env('OTP_RAND_START'), env('OTP_RAND_END'))),
                                        'last_seen_at' => now(),
                                    ]);
                                    return Resfor::success([
                                        'access_token' => $token,
                                        'token_type' => 'bearer',
                                        'expires_in' => auth('mitra-api')->factory()->getTTL(),
                                        'userId' => auth('mitra-api')->user()->id,
                                        'userUuid' => auth('mitra-api')->user()->uuid,
                                        'userMitraId' => auth('mitra-api')->user()->mitra_id,
                                        'userRole' => auth('mitra-api')->user()->role,
                                        'userNama' => auth('mitra-api')->user()->nama,
                                    ], 'success');
                                } else {
                                    return Resfor::error(null, 'kode otp salah');
                                }
                            } else {
                                return Resfor::error(null, 'kode otp telah expired');
                            }
                        } else {
                            return Resfor::error(null, 'password salah');
                        }
                    } else {
                        if ($wa->code_expired_at >= now()) {
                            $cekotp = Hash::check($otp, $wa->code);
                            if ($cekotp) {
                                $token = auth('mitra-api')->setTTL(env('JWT_LOGIN_EXPIRED'))->login($wa, true);
                                $wa->update([
                                    'code' => bcrypt(rand(env('OTP_RAND_START'), env('OTP_RAND_END'))),
                                    'last_seen_at' => now(),
                                ]);
                                return Resfor::success([
                                    'access_token' => $token,
                                    'token_type' => 'bearer',
                                    'expires_in' => auth('mitra-api')->factory()->getTTL(),
                                    'userId' => auth('mitra-api')->user()->id,
                                    'userUuid' => auth('mitra-api')->user()->uuid,
                                    'userMitraId' => auth('mitra-api')->user()->mitra_id,
                                    'userRole' => auth('mitra-api')->user()->role,
                                    'userNama' => auth('mitra-api')->user()->nama,
                                ], 'success');
                            } else {
                                return Resfor::error(null, 'kode otp salah');
                            }
                        } else {
                            return Resfor::error(null, 'kode otp telah expired');
                        }
                    }
                } else {
                    return Resfor::error(null, 'akun no wa tersebut tidak ditemukan');
                }
            } else {
                return Resfor::error(null, 'isi email / nomor whatsapp dengan benar!');
            }
        }
    }

    public function me()
    {
        if (auth('mitra-api')->check()) {
            return Resfor::success(auth('mitra-api')->user(), 'success');
        } else {
            return Resfor::error(auth('mitra-api')->user(), 'error');
        }
    }

    public function refresh()
    {
        return Resfor::success([
            'access_token' => auth('mitra-api')->setTTL(env('JWT_REFRESH_EXPIRED'))->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth('mitra-api')->factory()->getTTL(),
            'userId' => auth('mitra-api')->user()->id,
            'userUuid' => auth('mitra-api')->user()->uuid,
            'userMitraId' => auth('mitra-api')->user()->mitra_id,
            'userRole' => auth('mitra-api')->user()->role,
            'userNama' => auth('mitra-api')->user()->nama,
        ], 'success');
    }

    public function logout()
    {
        auth('mitra-api')->logout();

        return Resfor::success(null, 'Successfully logged out');
    }

    public function lupa_password()
    {
        //
    }

}

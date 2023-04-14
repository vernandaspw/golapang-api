<?php

namespace App\Http\Livewire;

use App\Helpers\ApiWatsap;
use App\Mail\SendCodeMail;
use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class LoginPage extends Component
{
    public $email_or_phone, $password;
    public $code_expired_at, $code_resend_at;

    public $otp_page;

    public $withPass = true;

    public function render()
    {
        $setting = Setting::find(1);

        if ($setting->admin_password == true) {
            $this->withPass = true;
        } else {
            // cek lagi klo otp false semua, maka withPass = true
            if ($setting->admin_otp_email == false && $setting->admin_otp_wa == false) {
                $this->withPass = true;
            } else {
                $this->withPass = false;
            }

        }

        return view('livewire.login-page')->extends('layouts.polos')->section('content');
    }
    public $cek;
    public function login()
    {
        $setting = Setting::find(1);

        if ($setting->admin_otp_wa == true && $setting->admin_otp_email) {
            if (strstr($this->email_or_phone, '@')) {
                $email = Admin::where('email', $this->email_or_phone)->first();
                if ($email) {
                    if ($setting->admin_password == true) {
                        if (Hash::check($this->password, $email->password)) {
                            $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
                            $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
                            $resend_code = now()->addMinutes(env('OTP_RESEND'));
                            $email->update([
                                'code' => Hash::make($code),
                                'code_expired_at' => $code_expired,
                                'code_resend_at' => $resend_code,
                            ]);
                            try {
                                $details = [
                                    'title' => 'Mail from GoLapang',
                                    'code' => $code,
                                ];
                                Mail::to($email->email)->send(new SendCodeMail($details));
                            } catch (\Exception$e) {
                                info("Error: " . $e->getMessage());
                            }
                            $this->code_expired_at = $code_expired->isoFormat('HH:mm');
                            $this->code_resend_at = $resend_code->isoFormat('HH:mm');
                            $this->otp_page = true;
                        } else {
                            session()->flash('alert', 'password salah');
                        }
                    } else {
                        // tanpa password
                        $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
                        $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
                        $resend_code = now()->addMinutes(env('OTP_RESEND'));
                        $email->update([
                            'code' => Hash::make($code),
                            'code_expired_at' => $code_expired,
                            'code_resend_at' => $resend_code,
                        ]);
                        try {
                            $details = [
                                'title' => 'Mail from GoLapang',
                                'code' => $code,
                            ];
                            Mail::to($email->email)->send(new SendCodeMail($details));
                        } catch (\Exception$e) {
                            info("Error: " . $e->getMessage());
                        }
                        $this->code_expired_at = $code_expired->isoFormat('HH:mm');
                        $this->code_resend_at = $resend_code->isoFormat('HH:mm');
                        $this->otp_page = true;
                    }

                } else {
                    session()->flash('alert', 'email tidak ditemukan');
                }
            } else {
                $tel = is_numeric($this->email_or_phone);
                if ($tel) {
                    $wa = Admin::where('phone', $this->email_or_phone)->first();
                    if ($wa) {
                        if ($setting->admin_password == true) {
                            if (Hash::check($this->password, $wa->password)) {
                                $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
                                $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
                                $resend_code = now()->addMinutes(env('OTP_RESEND'));
                                $wa->update([
                                    'code' => bcrypt($code),
                                    'code_expired_at' => $code_expired,
                                    'code_resend_at' => $resend_code,
                                ]);
                                ApiWatsap::send($wa->phone, 'kode OTP anda:' . ' ' . $code . ' untuk aplikasi golapang. Kode ini hanya berlaku selama ' . env('OTP_EXPIRED') . ' menit. Jangan berikan kode rahasia ini kepada siapapun, termasuk pihak yang mengaku dari golapang');

                                $this->code_expired_at = $code_expired->isoFormat('HH:mm');
                                $this->code_resend_at = $resend_code->isoFormat('HH:mm');
                                $this->otp_page = true;
                            } else {
                                session()->flash('alert', 'password salah');
                            }
                        } else {
                            // tanpa password
                            $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
                            $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
                            $resend_code = now()->addMinutes(env('OTP_RESEND'));
                            $wa->update([
                                'code' => bcrypt($code),
                                'code_expired_at' => $code_expired,
                                'code_resend_at' => $resend_code,
                            ]);
                            ApiWatsap::send($wa->phone, 'kode OTP anda:' . ' ' . $code . ' untuk aplikasi golapang. Kode ini hanya berlaku selama ' . env('OTP_EXPIRED') . ' menit. Jangan berikan kode rahasia ini kepada siapapun, termasuk pihak yang mengaku dari golapang');

                            $this->code_expired_at = $code_expired->isoFormat('HH:mm');
                            $this->code_resend_at = $resend_code->isoFormat('HH:mm');
                            $this->otp_page = true;
                        }
                    } else {
                        session()->flash('alert', 'whatsapp tidak ditemukan');
                    }
                } else {
                    session()->flash('alert', 'isi email/nomor whatsapp dengan benar');
                }
            }
        } elseif ($setting->admin_otp_email == true) {
            if (strstr($this->email_or_phone, '@')) {
                $email = Admin::where('email', $this->email_or_phone)->first();
                if ($email) {
                    if ($setting->admin_password == true) {
                        if (Hash::check($this->password, $email->password)) {
                            $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
                            $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
                            $resend_code = now()->addMinutes(env('OTP_RESEND'));
                            $email->update([
                                'code' => Hash::make($code),
                                'code_expired_at' => $code_expired,
                                'code_resend_at' => $resend_code,
                            ]);
                            try {
                                $details = [
                                    'title' => 'GoLapang OTP',
                                    'code' => $code,
                                ];
                                Mail::to($email->email)->send(new SendCodeMail($details));
                            } catch (\Exception$e) {
                                info("Error: " . $e->getMessage());
                            }
                            $this->code_expired_at = $code_expired->isoFormat('HH:mm');
                            $this->code_resend_at = $resend_code->isoFormat('HH:mm');
                            $this->otp_page = true;
                        } else {
                            session()->flash('alert', 'password salah');
                        }
                    } else {
                        // tanpa password
                        $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
                        $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
                        $resend_code = now()->addMinutes(env('OTP_RESEND'));
                        $email->update([
                            'code' => Hash::make($code),
                            'code_expired_at' => $code_expired,
                            'code_resend_at' => $resend_code,
                        ]);
                        try {
                            $details = [
                                'title' => 'Mail from GoLapang',
                                'code' => $code,
                            ];
                            Mail::to($email->email)->send(new SendCodeMail($details));
                        } catch (\Exception$e) {
                            info("Error: " . $e->getMessage());
                        }
                        $this->code_expired_at = $code_expired->isoFormat('HH:mm');
                        $this->code_resend_at = $resend_code->isoFormat('HH:mm');
                        $this->otp_page = true;
                    }

                } else {
                    session()->flash('alert', 'email tidak ditemukan');
                }
            } else {
                session()->flash('alert', 'masukan alamat email dengan benar');
            }
        } elseif ($setting->admin_otp_wa == true) {
            $tel = is_numeric($this->email_or_phone);
            if ($tel) {
                $wa = Admin::where('phone', $this->email_or_phone)->first();
                if ($wa) {
                    if ($setting->admin_password == true) {
                        if (Hash::check($this->password, $wa->password)) {
                            $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
                                $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
                                $resend_code = now()->addMinutes(env('OTP_RESEND'));
                                $wa->update([
                                    'code' => bcrypt($code),
                                    'code_expired_at' => $code_expired,
                                    'code_resend_at' => $resend_code,
                                ]);
                                ApiWatsap::send($wa->phone, 'kode OTP anda:' . ' ' . $code . ' untuk aplikasi golapang. Kode ini hanya berlaku selama ' . env('OTP_EXPIRED') . ' menit. Jangan berikan kode rahasia ini kepada siapapun, termasuk pihak yang mengaku dari golapang');

                            $this->code_expired_at = $code_expired->isoFormat('HH:mm');
                            $this->code_resend_at = $resend_code->isoFormat('HH:mm');
                            $this->otp_page = true;
                        } else {
                            session()->flash('alert', 'password salah');
                        }
                    } else {
                        // tanpa password
                        $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
                                $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
                                $resend_code = now()->addMinutes(env('OTP_RESEND'));
                                $wa->update([
                                    'code' => bcrypt($code),
                                    'code_expired_at' => $code_expired,
                                    'code_resend_at' => $resend_code,
                                ]);
                                ApiWatsap::send($wa->phone, 'kode OTP anda:' . ' ' . $code . ' untuk aplikasi golapang. Kode ini hanya berlaku selama ' . env('OTP_EXPIRED') . ' menit. Jangan berikan kode rahasia ini kepada siapapun, termasuk pihak yang mengaku dari golapang');

                        $this->code_expired_at = $code_expired->isoFormat('HH:mm');
                        $this->code_resend_at = $resend_code->isoFormat('HH:mm');
                        $this->otp_page = true;
                    }
                } else {
                    session()->flash('alert', 'whatsapp tidak ditemukan');
                }
            } else {
                session()->flash('alert', 'isi email/nomor whatsapp dengan benar!');
            }
        } else {
            // jika tanpa otp wajib password

            $this->otp_page = false;
            if ($this->password != null) {
                // langsung login tanpa kirim otp
                $this->login_proses();
            } else {
                session()->flash('alert', 'wajib isi password!');
            }
        }
    }

    public function login_proses()
    {
        $setting = Setting::find(1);
        if (strstr($this->email_or_phone, '@')) {
            $email = Admin::where('email', $this->email_or_phone)->first();
            if ($email) {
                if ($this->password) {
                    if (Hash::check($this->password, $email->password)) {

                        if ($setting->admin_otp_wa == true || $setting->admin_otp_wa == true) {
                            if ($email->code_expired_at >= now()) {
                                $cekotp = Hash::check($this->otp, $email->code);
                                if ($cekotp) {
                                    $token = auth('admin-web')->login($email, true);
                                    $email->update([
                                        'code' => bcrypt(rand(10000, 99999)),
                                        'last_seen_at' => now(),
                                    ]);
                                    return redirect()->to('/');
                                } else {
                                    session()->flash('alert', 'kode otp salah');
                                }
                            } else {
                                session()->flash('alert', 'kode otp telah expired');
                            }
                        } else {
                            $token = auth('admin-web')->login($email, true);
                            $email->update([
                                'code' => bcrypt(rand(10000, 99999)),
                                'last_seen_at' => now(),
                            ]);
                            return redirect()->to('/');
                        }

                    } else {
                        session()->flash('alert', 'password salah');
                    }
                } else {

                    if ($setting->admin_otp_wa == true || $setting->admin_otp_wa == true) {
                        if ($email->code_expired_at >= now()) {
                            $cekotp = Hash::check($this->otp, $email->code);
                            if ($cekotp) {
                                $token = auth('admin-web')->login($email, true);
                                $email->update([
                                    'code' => bcrypt(rand(10000, 99999)),
                                    'last_seen_at' => now(),
                                ]);
                                return redirect()->to('/');
                            } else {
                                session()->flash('alert', 'kode otp salah');
                            }
                        } else {
                            session()->flash('alert', 'kode otp telah expired');
                        }
                    } else {
                        $token = auth('admin-web')->login($email, true);
                        $email->update([
                            'code' => bcrypt(rand(10000, 99999)),
                            'last_seen_at' => now(),
                        ]);
                        return redirect()->to('/');
                    }

                }
            } else {
                session()->flash('alert', 'akun email tidak ditemukan');
            }
        } else {
            $tel = is_numeric($this->email_or_phone);
            if ($tel) {
                // if (strpos(substr($rmail_or_phone, 0, 3), '08') !== false) {
                //     $awal = str_replace("08", "628", substr($req->email_or_phone, 0, 3));
                //     $req->email_or_phone = $awal . substr($req->email_or_phone, 3);
                // }
                $wa = Admin::where('phone', $this->email_or_phone)->first();
                if ($wa) {
                    if ($this->password) {
                        if (Hash::check($this->password, $wa->password)) {

                            if ($setting->admin_otp_wa == true || $setting->admin_otp_wa == true) {
                                if ($wa->code_expired_at >= now()) {
                                    $cekotp = Hash::check($this->otp, $wa->code);
                                    if ($cekotp) {
                                        $token = auth('admin-web')->login($wa, true);
                                        $wa->update([
                                            'code' => bcrypt(rand(10000, 99999)),
                                            'last_seen_at' => now(),
                                        ]);
                                        return redirect()->to('/');
                                    } else {
                                        session()->flash('alert', 'kode otp salah');
                                    }
                                } else {
                                    session()->flash('alert', 'kode otp telah expired');
                                }
                            } else {
                                $token = auth('admin-web')->login($wa, true);
                                $wa->update([
                                    'code' => bcrypt(rand(10000, 99999)),
                                    'last_seen_at' => now(),
                                ]);
                                return redirect()->to('/');

                            }

                        } else {
                            session()->flash('alert', 'password salah');
                        }
                    } else {

                        if ($setting->admin_otp_wa == true || $setting->admin_otp_wa == true) {
                            if ($wa->code_expired_at >= now()) {
                                $cekotp = Hash::check($this->otp, $wa->code);
                                if ($cekotp) {
                                    $token = auth('admin-web')->login($wa, true);
                                    $wa->update([
                                        'code' => bcrypt(rand(10000, 99999)),
                                        'last_seen_at' => now(),
                                    ]);
                                    return redirect()->to('/');
                                } else {
                                    session()->flash('alert', 'kode otp salah');
                                }
                            } else {
                                session()->flash('alert', 'kode otp telah expired');
                            }
                        } else {
                            $token = auth('admin-web')->login($wa, true);
                            $wa->update([
                                'code' => bcrypt(rand(10000, 99999)),
                                'last_seen_at' => now(),
                            ]);
                            return redirect()->to('/');
                        }

                    }
                } else {
                    session()->flash('alert', 'akun wa tidak ditemukan');
                }
            } else {
                session()->flash('alert', 'isi email / nomor whatsapp dengan benar!');
            }
        }
    }

}

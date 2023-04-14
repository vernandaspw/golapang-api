<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\ApiWatsap;
use App\Helpers\Resfor;
use App\Mail\SendCodeMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class MitraUser extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'mitra';

    protected $fillable = [
        'uuid',
        'mitra_id',
        'tempat_id',
        'nama',
        'img',
        'alamat',
        'phone',
        'email',
        'role',
        'isaktif',
        'google_id',
        'password',
        'code',
        'code_expired_at',
        'code_resend_at',
        'last_seen_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'code',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function validatorLogin($req)
    {
        $validator = Validator::make($req->all(), [
            'email_or_phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return Resfor::error($validator->errors(), 'validator', 422);
        }
    }

    public static function sendOtpEmail($email)
    {
        $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
        $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
        $resend_code = now()->addMinutes(env('OTP_RESEND'));

        try {
            $details = [
                'title' => 'Mail from GoLapang',
                'code' => $code,
            ];
            Mail::to($email->email)->send(new SendCodeMail($details));
        } catch (\Exception$e) {
            info("Error: " . $e->getMessage());
            return Resfor::error(null, 'kesalahan koneksi internet', 500);
        }

        $email->update([
            'code' => Hash::make($code),
            'code_expired_at' => $code_expired,
            'code_resend_at' => $resend_code,

        ]);

        return Resfor::success(
            [
                'email_or_phone' => encrypt($email->email),
                'code_expired_at' => $code_expired->isoFormat('HH:mm'),
                'code_resend_at' => $resend_code->isoFormat('HH:mm'),
                'code_expired_menit' => env('OTP_EXPIRED'),
                'code_resend_menit' => env('OTP_RESEND'),
            ],
            'berhasil kirim otp ke email'
        );
    }

    public static function sendOtpWa($wa)
    {
        $code = rand(env('OTP_RAND_START'), env('OTP_RAND_END'));
        $code_expired = now()->addMinutes(env('OTP_EXPIRED'));
        $resend_code = now()->addMinutes(env('OTP_RESEND'));

        try {
            ApiWatsap::send($wa->phone, 'kode OTP anda:' . ' ' . $code . ' untuk aplikasi golapang. Kode ini hanya berlaku selama ' . env('OTP_EXPIRED') . ' menit. Jangan berikan kode rahasia ini kepada siapapun, termasuk pihak yang mengaku dari golapang');
        } catch (\Exception$e) {
            info("Error: " . $e->getMessage());
            return Resfor::error(null, 'kesalahan koneksi internet', 500);
        }

        $wa->update([
            'code' => bcrypt($code),
            'code_expired_at' => $code_expired,
            'code_expired_at' => $code_expired,
            'code_resend_at' => $resend_code,

        ]);
        return Resfor::success([
            'email_or_phone' => encrypt($wa->phone),

            'code_expired_at' => $code_expired->isoFormat('HH:mm'),
            'code_resend_at' => $resend_code->isoFormat('HH:mm'),
            'code_expired_menit' => env('OTP_EXPIRED'),
            'code_resend_menit' => env('OTP_RESEND'),
        ], 'berhasil kirim otp ke whatsapp');

    }
}

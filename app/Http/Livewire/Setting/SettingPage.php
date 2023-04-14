<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class SettingPage extends Component
{
    public $fee_customer_topup,
    $fee_customer_tarik,
    $fee_mitra_topup,
    $fee_mitra_tarik,
    $fee_customer_transaksi,
    $fee_customer_transaksi_member,
    $fee_mitra_transaksi,
    $fee_mitra_transaksi_member,
    $min_isi_customer,
    $max_isi_customer,
    $min_tarik_customer,
    $max_tarik_customer,
    $min_isi_mitra,
    $max_isi_mitra,
    $min_tarik_mitra,
    $max_tarik_mitra,
    $biaya_iklan_perhari,
    $biaya_iklan_perprovinsi,
    $biaya_iklan_perkota,
    $min_saldo_kredit_mitra,
    $admin_password,
    $admin_otp_wa,
    $admin_otp_email,
    $mitra_password,
    $mitra_otp_wa,
    $mitra_otp_email,
    $customer_password,
    $customer_otp_wa,
    $customer_otp_email
    ;

    public function mount()
    {
        $data = Setting::find(1);

        $this->fee_customer_topup = $data->fee_customer_topup;
        $this->fee_customer_tarik = $data->fee_customer_tarik;
        $this->fee_mitra_topup = $data->fee_mitra_topup;
        $this->fee_mitra_tarik = $data->fee_mitra_tarik;
        $this->fee_customer_transaksi = $data->fee_customer_transaksi;
        $this->fee_customer_transaksi_member = $data->fee_customer_transaksi_member;
        $this->fee_mitra_transaksi = $data->fee_mitra_transaksi;
        $this->fee_mitra_transaksi_member = $data->fee_mitra_transaksi_member;
        $this->min_isi_customer = $data->min_isi_customer;
        $this->max_isi_customer = $data->max_isi_customer;
        $this->min_tarik_customer = $data->min_tarik_customer;
        $this->max_tarik_customer = $data->max_tarik_customer;
        $this->min_isi_mitra = $data->min_isi_mitra;
        $this->max_isi_mitra = $data->max_isi_mitra;
        $this->min_tarik_mitra = $data->min_tarik_mitra;
        $this->max_tarik_mitra = $data->max_tarik_mitra;
        $this->biaya_iklan_perhari = $data->biaya_iklan_perhari;
        $this->biaya_iklan_perprovinsi = $data->biaya_iklan_perprovinsi;
        $this->biaya_iklan_perkota = $data->biaya_iklan_perkota;
        $this->min_saldo_kredit_mitra = $data->min_saldo_kredit_mitra;
        $this->admin_password = $data->admin_password;
        $this->admin_otp_wa = $data->admin_otp_wa;
        $this->admin_otp_email = $data->admin_otp_email;
        $this->mitra_password = $data->mitra_password;
        $this->mitra_otp_wa = $data->mitra_otp_wa;
        $this->mitra_otp_email = $data->mitra_otp_email;
        $this->customer_password = $data->customer_password;
        $this->customer_otp_wa = $data->customer_otp_wa;
        $this->customer_otp_email = $data->customer_otp_email;
    }

    public function render()
    {
        return view('livewire.setting.setting-page')->extends('layouts.app')->section('content');
    }

    public function toggle_customer_password()
    {
        if ($this->customer_password == true) {
            // cek apakah ada otp yang aktif
            $setting = Setting::find(1);
            if ($setting->customer_otp_wa == true || $setting->customer_otp_email == true) {
                $this->customer_password = false;
                $setting->update([
                    'customer_password' => $this->customer_password
                ]);
            }else{
                session()->flash('alert', 'harus ada otp email/wa yang aktif');
            }
        }else {
            $this->customer_password = true;
            Setting::find(1)->update([
                'customer_password' => $this->customer_password
            ]);
        }
    }
    public function toggle_customer_otp_wa()
    {
        if ($this->customer_otp_wa == true) {
            $this->customer_otp_wa = false;
        }else {
            $this->customer_otp_wa = true;
        }
        Setting::find(1)->update([
            'customer_otp_wa' => $this->customer_otp_wa
        ]);
    }
    public function toggle_customer_otp_email()
    {
        if ($this->customer_otp_email == true) {
            $this->customer_otp_email = false;
        }else {
            $this->customer_otp_email = true;
        }
        Setting::find(1)->update([
            'customer_otp_email' => $this->customer_otp_email
        ]);
    }

    public function toggle_mitra_password()
    {
        if ($this->mitra_password == true) {
            // cek apakah ada otp yang aktif
            $setting = Setting::find(1);
            if ($setting->mitra_otp_wa == true || $setting->mitra_otp_email == true) {
                $this->mitra_password = false;
                $setting->update([
                    'mitra_password' => $this->mitra_password
                ]);
            }else{
                session()->flash('alert', 'harus ada otp email/wa yang aktif');
            }
        }else {
            $this->mitra_password = true;
            Setting::find(1)->update([
                'mitra_password' => $this->mitra_password
            ]);
        }
    }
    public function toggle_mitra_otp_wa()
    {
        if ($this->mitra_otp_wa == true) {
            $this->mitra_otp_wa = false;
        }else {
            $this->mitra_otp_wa = true;
        }
        Setting::find(1)->update([
            'mitra_otp_wa' => $this->mitra_otp_wa
        ]);
    }
    public function toggle_mitra_otp_email()
    {
        if ($this->mitra_otp_email == true) {
            $this->mitra_otp_email = false;
        }else {
            $this->mitra_otp_email = true;
        }
        Setting::find(1)->update([
            'mitra_otp_email' => $this->mitra_otp_email
        ]);
    }
    public function toggle_admin_password()
    {
        if ($this->admin_password == true) {
            // cek apakah ada otp yang aktif
            $setting = Setting::find(1);
            if ($setting->admin_otp_wa == true || $setting->admin_otp_email == true) {
                $this->admin_password = false;
                $setting->update([
                    'admin_password' => $this->admin_password
                ]);
            }else{
                session()->flash('alert', 'harus ada otp email/wa yang aktif');
            }
        }else {
            $this->admin_password = true;
            Setting::find(1)->update([
                'admin_password' => $this->admin_password
            ]);
        }
    }
    public function toggle_admin_otp_wa()
    {
        if ($this->admin_otp_wa == true) {
            $this->admin_otp_wa = false;
        }else {
            $this->admin_otp_wa = true;
        }
        Setting::find(1)->update([
            'admin_otp_wa' => $this->admin_otp_wa
        ]);
    }
    public function toggle_admin_otp_email()
    {
        if ($this->admin_otp_email == true) {
            $this->admin_otp_email = false;
        }else {
            $this->admin_otp_email = true;
        }
        Setting::find(1)->update([
            'admin_otp_email' => $this->admin_otp_email
        ]);
    }

    public function save()
    {
        Setting::find(1)->update([
            'fee_customer_topup' => $this->fee_customer_topup,
            'fee_customer_tarik' => $this->fee_customer_tarik,

            'fee_mitra_topup' => $this->fee_mitra_topup,
            'fee_mitra_tarik' => $this->fee_mitra_tarik,

            'fee_customer_transaksi' => $this->fee_customer_transaksi,
            'fee_customer_transaksi_member' => $this->fee_customer_transaksi_member,

            'fee_mitra_transaksi' => $this->fee_mitra_tarik,
            'fee_mitra_transaksi_member' => $this->fee_mitra_transaksi_member,

            'min_isi_customer' => $this->min_isi_customer,
            'max_isi_customer' => $this->max_isi_customer,
            'min_tarik_customer' => $this->min_tarik_customer,
            'max_tarik_customer' => $this->max_tarik_customer,

            'min_isi_mitra' => $this->min_isi_mitra,
            'max_isi_mitra'=> $this->max_isi_mitra,
            'min_tarik_mitra' => $this->min_tarik_mitra,
            'max_tarik_mitra' => $this->max_tarik_mitra,

            'biaya_iklan_perhari' => $this->biaya_iklan_perhari,
            'biaya_iklan_perprovinsi' => $this->biaya_iklan_perprovinsi,
            'biaya_iklan_perkota' =>$this->biaya_iklan_perkota,
            'min_saldo_kredit_mitra' =>$this->min_saldo_kredit_mitra,

            'admin_password' => $this->admin_password,
            'admin_otp_wa' => $this->admin_otp_wa,
            'admin_otp_email' => $this->admin_otp_email,


            'mitra_password' => $this->mitra_password,
            'mitra_otp_wa' => $this->mitra_otp_wa,
            'mitra_otp_email' => $this->mitra_otp_email,

            'customer_password' => $this->customer_password,
            'customer_otp_wa'=> $this->customer_otp_wa,
            'customer_otp_email'=> $this->customer_otp_email,
        ]);

        session()->flash('alertsuccess', 'Berhasil perbarui!');
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'fee_customer_topup' => 0,
            'fee_customer_tarik' => 0,

            'fee_mitra_topup' => 0,
            'fee_mitra_tarik' => 2000,

            'fee_customer_transaksi' => 2500,
            'fee_customer_transaksi_member' => 2500,

            'fee_mitra_transaksi' => 2500,
            'fee_mitra_transaksi_member' => 2500,

            'min_isi_customer' => 10000,
            'max_isi_customer' => 1000000,
            'min_tarik_customer' => 20000,
            'max_tarik_customer' => 500000,

            'min_isi_mitra' => 20000,
            'max_isi_mitra'=> 1000000,
            'min_tarik_mitra' => 50000,
            'max_tarik_mitra' => 2000000,

            'biaya_iklan_perhari' => 2000,
            'biaya_iklan_perprovinsi' => 10000,
            'biaya_iklan_perkota' => 4000,

            'admin_password' => true,
            'admin_otp_wa' => false,
            'admin_otp_email' => false,


            'mitra_password' => true,
            'mitra_otp_wa' => true,
            'mitra_otp_email' => true,

            'customer_password' => true,
            'customer_otp_wa'=> true,
            'customer_otp_email'=> true,

        ]);
    }
}

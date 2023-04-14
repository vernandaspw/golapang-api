<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('admins')->insert([
            [
                'uuid' => \Str::uuid(),
                'nama' => 'vernandaspw',
                'phone' => '082299998741',
                'email' => 'vernandaspw@gmail.com',
                'password' => bcrypt('123@Z'),
                'role' => 'superadmin',
                'isaktif' => true,
                'google_id' => null,
                'code' => null,
                'code_expired_at' => null,
                'code_resend_at' => null,
                'last_seen_at' => null,
            ],

        ]);
    }
}

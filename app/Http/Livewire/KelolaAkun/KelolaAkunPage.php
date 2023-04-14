<?php

namespace App\Http\Livewire\KelolaAkun;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class KelolaAkunPage extends Component
{
    public $datas = [];
    public $tambahPage = false;

    public function render()
    {
        $this->datas = Admin::latest()->get();

        return view('livewire.kelola-akun.kelola-akun-page')->extends('layouts.app')->section('content');
    }

    public function ubahisaktif($id)
    {
        $data = Admin::find($id);
        if ($data->isaktif == true) {
            $data->update([
                'isaktif' => false
            ]);
        }else{
            $data->update([
                'isaktif' => true
            ]);
        }
    }

    public $nama, $phone, $email, $password, $role;

    public function simpan()
    {
        $this->validate([
            'phone' => 'unique:admins,phone',
            'email' => 'unique:admins,email',

        ]);

        Admin::create([
            'uuid' => Str::uuid(),
            'nama' => $this->nama,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        session()->flash('alertsuccess', 'berhasil tambah akun admin');
        $this->tambahPage = false;

    }
}

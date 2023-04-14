<?php

namespace App\Http\Livewire;

use App\Models\Provinsi;
use Livewire\Component;

class ProvinsiPage extends Component
{
    public $datas = [];
    public $tambahPage = false, $ubahPage = false;

    public $nama,  $isaktif;

    public $new_img;

    public $ID;

    public function render()
    {
        $this->datas = Provinsi::orderBy('nama', 'asc')->get();
        return view('livewire.provinsi-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->nama = null;
        $this->isaktif = null;
    }

    public function ubahisaktif($id)
    {
        $data = Provinsi::find($id);

        if ($data->isaktif == true) {
            $data->update([
                'isaktif' => false,
            ]);
        } else {
            $data->update([
                'isaktif' => true,
            ]);
        }
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'unique:olahragas,nama|max:30'
        ]);

        Provinsi::create([
            'nama' => $this->nama,
        ]);

        $this->resetData();
        session()->flash('alertsuccess', 'berhasil tambah data');
    }

    public function ubahPage($id)
    {
        $this->ID = $id;
        $data = Provinsi::find($id);
        $this->nama = $data->nama;
        $this->isaktif = $data->isaktif;
        $this->ubahPage = true;
    }

    public function batalUbah()
    {
        $this->ID = null;
        $this->resetData();
        $this->ubahPage = false;
    }

    public function perbarui()
    {
        $this->validate([
            'nama' => 'max:30'
        ]);

        $data = Provinsi::find($this->ID);

        $data->update([
            'nama' => $this->nama,
            'isaktif' => $this->isaktif,
        ]);

        $this->ubahPage = false;
        $this->resetData();

        session()->flash('alertsuccess', 'berhasil perbarui data');
    }
}

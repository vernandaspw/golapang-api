<?php

namespace App\Http\Livewire;

use App\Models\Kota;
use App\Models\Provinsi;
use Livewire\Component;

class KotaPage extends Component
{
    public $datas = [], $provinsis = [];
    public $tambahPage = false, $ubahPage = false;

    public $nama, $provinsi_id,  $isaktif;

    public $new_img;

    public $ID;

    public function render()
    {
        $this->datas = Kota::orderBy('nama', 'asc')->get();
        $this->provinsis = Provinsi::orderBy('nama', 'asc')->get();

        return view('livewire.kota-page')->extends('layouts.app')->section('content');
    }


    public function resetData()
    {
        $this->nama = null;
        $this->provinsi_id = null;
        $this->isaktif = null;
    }

    public function ubahisaktif($id)
    {
        $data = Kota::find($id);
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

        Kota::create([
            'nama' => $this->nama,
            'provinsi_id' => $this->provinsi_id
        ]);

        $this->resetData();
        session()->flash('alertsuccess', 'berhasil tambah data');
    }

    public function ubahPage($id)
    {
        $this->ID = $id;
        $data = Kota::find($id);
        $this->nama = $data->nama;
        $this->provinsi_id = $data->provinsi_id;
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

        $data = Kota::find($this->ID);

        $data->update([
            'nama' => $this->nama,
            'provinsi_id' => $this->provinsi_id,
            'isaktif' => $this->isaktif,
        ]);

        $this->ubahPage = false;
        $this->resetData();

        session()->flash('alertsuccess', 'berhasil perbarui data');
    }
}

<?php

namespace App\Http\Livewire\MetodePembayaran;

use App\Models\MetodePembayaran;
use Livewire\Component;

class MetodePembayaranPage extends Component
{
    public $datas = [];
    public $tambahPage = false, $ubahPage = false;

    public $nama, $keterangan, $istampil,  $isaktif;

    public $ID;

    public function render()
    {
        $this->datas = MetodePembayaran::orderBy('nama', 'asc')->get();
        return view('livewire.metode-pembayaran.metode-pembayaran-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->nama = null;
        $this->keterangan = null;
        $this->istampil = null;
        $this->isaktif = null;
    }

    public function ubahisaktif($id)
    {
        $data = MetodePembayaran::find($id);

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
    public function ubahistampil($id)
    {
        $data = MetodePembayaran::find($id);

        if ($data->istampil == true) {
            $data->update([
                'istampil' => false,
            ]);
        } else {
            $data->update([
                'istampil' => true,
            ]);
        }
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'unique:olahragas,nama|max:30'
        ]);

        MetodePembayaran::create([
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();
        session()->flash('alertsuccess', 'berhasil tambah data');
    }

    public function ubahPage($id)
    {
        $this->ID = $id;
        $data = MetodePembayaran::find($id);
        $this->nama = $data->nama;
        $this->keterangan = $data->keterangan;
        $this->istampil = $data->istampil;
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

        $data = MetodePembayaran::find($this->ID);

        $data->update([
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
            'istampil' => $this->istampil,
            'isaktif' => $this->isaktif,
        ]);

        $this->ubahPage = false;
        $this->resetData();

        session()->flash('alertsuccess', 'berhasil perbarui data');
    }
}

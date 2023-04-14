<?php

namespace App\Http\Livewire\AlasLapangan;

use App\Models\AlasLapangan;
use Livewire\Component;

class AlasLapanganPage extends Component
{
    public $datas = [];
    public $tambahPage = false, $ubahPage = false;

    public $nama, $keterangan, $isaktif;

    public $ID;

    public function render()
    {
        $this->datas = AlasLapangan::get();

        return view('livewire.alas-lapangan.alas-lapangan-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->nama = null;
        $this->keterangan = null;
        $this->isaktif = null;
    }

    public function ubahisaktif($id)
    {
        $data = AlasLapangan::find($id);

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
        AlasLapangan::create([
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();
        session()->flash('alertsuccess', 'berhasil tambah data');
    }

    public function ubahPage($id)
    {
        $this->ID = $id;
        $data = AlasLapangan::find($id);
        $this->nama = $data->nama;
        $this->keterangan = $data->keterangan;
        $this->isaktif = $data->isaktif;
        $this->ubahPage = true;
    }

    public function perbarui()
    {
        AlasLapangan::find($this->ID)->update([
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
            'isaktif' => $this->isaktif
        ]);

        $this->ubahPage = false;
        $this->resetData();

        session()->flash('alertsuccess', 'berhasil perbarui data');
    }
}

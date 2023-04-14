<?php

namespace App\Http\Livewire\TipeLapangan;

use App\Models\TipeLapangan;
use Livewire\Component;

class TipeLapanganPage extends Component
{
    public $datas = [];
    public $tambahPage = false, $ubahPage = false;

    public $nama, $keterangan, $isaktif;

    public $ID;

    public function render()
    {
        $this->datas = TipeLapangan::get();
        return view('livewire.tipe-lapangan.tipe-lapangan-page')->extends('layouts.app')->section('content');
    }
    public function resetData()
    {
        $this->nama = null;
        $this->keterangan = null;
        $this->isaktif = null;
    }

    public function ubahisaktif($id)
    {
        $data = TipeLapangan::find($id);

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
        TipeLapangan::create([
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();
        session()->flash('alertsuccess', 'berhasil tambah data');
    }

    public function ubahPage($id)
    {
        $this->ID = $id;
        $data = TipeLapangan::find($id);
        $this->nama = $data->nama;
        $this->keterangan = $data->keterangan;
        $this->isaktif = $data->isaktif;
        $this->ubahPage = true;
    }

    public function perbarui()
    {
        TipeLapangan::find($this->ID)->update([
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
            'isaktif' => $this->isaktif
        ]);

        $this->ubahPage = false;
        $this->resetData();

        session()->flash('alertsuccess', 'berhasil perbarui data');
    }
}

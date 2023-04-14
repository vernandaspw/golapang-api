<?php

namespace App\Http\Livewire\Bank;

use App\Models\Bank;
use Livewire\Component;
use Livewire\WithFileUploads;

class BankPage extends Component
{
    use WithFileUploads;

    public $datas = [];
    public $tambahPage = false, $ubahPage = false;

    public $nama, $img, $fee, $keterangan, $isaktif;

    public $ID;
    public $new_img;


    public function render()
    {
        $this->datas = Bank::get();
        return view('livewire.bank.bank-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->nama = null;
        $this->img = null;
        $this->fee = null;
        $this->keterangan = null;
        $this->isaktif = null;
    }

    public function ubahisaktif($id)
    {
        $data = Bank::find($id);
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
            'nama' => 'unique:banks,nama'
        ]);

        if ($this->img) {
            $image = $this->img->store('img');
        } else {
            $image = null;
        }

        Bank::create([
            'nama' => $this->nama,
            'img' => $image,
            'fee' => $this->fee,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();
        session()->flash('alertsuccess', 'berhasil tambah data');
    }

    public function ubahPage($id)
    {
        $this->ID = $id;
        $data = Bank::find($id);
        $this->nama = $data->nama;
        $this->img = $data->img;
        $this->fee = $data->fee;
        $this->keterangan = $data->keterangan;
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
        $data = Bank::find($this->ID);
        if ($this->new_img) {
             // hapus img lama, lalu store img baru
            Storage::delete($data->img);
            $image = $this->new_img->store('img');
        }else{
            $image = $data->img;
        }

        $data->update([
            'nama' => $this->nama,
            'img' => $image,
            'fee' => $this->fee,
            'keterangan' => $this->keterangan,
            'isaktif' => $this->isaktif,
        ]);

        $this->ubahPage = false;
        $this->resetData();

        session()->flash('alertsuccess', 'berhasil perbarui data');
    }

}

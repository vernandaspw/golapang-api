<?php

namespace App\Http\Livewire\Fasilitas;

use App\Models\Fasilitas;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FasilitasPage extends Component
{

    use WithFileUploads;

    public $datas = [];
    public $tambahPage = false, $ubahPage = false;

    public $nama, $img, $isaktif;

    public $new_img;

    public $ID;

    public function render()
    {
        $this->datas = Fasilitas::get();
        return view('livewire.fasilitas.fasilitas-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->nama = null;
        $this->img = null;
        $this->isaktif = null;
    }

    public function ubahisaktif($id)
    {
        $data = Fasilitas::find($id);

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
        // $this->validate([

        // ]);

        if ($this->img) {
            $image = $this->img->store('img');
        } else {
            $image = null;
        }

        Fasilitas::create([
            'nama' => $this->nama,
            'img' => $image,
        ]);

        $this->resetData();
        session()->flash('alertsuccess', 'berhasil tambah data');
    }

    public function ubahPage($id)
    {
        $this->ID = $id;
        $data = Fasilitas::find($id);
        $this->nama = $data->nama;
        $this->img = $data->img;
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
        $data = Fasilitas::find($this->ID);
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
            'isaktif' => $this->isaktif,
        ]);

        $this->ubahPage = false;
        $this->resetData();

        session()->flash('alertsuccess', 'berhasil perbarui data');
    }
}

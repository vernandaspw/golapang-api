<?php

namespace App\Http\Livewire\Olahraga;

use App\Models\Olahraga;
use Livewire\Component;
use Livewire\WithFileUploads;

class OlahragaPage extends Component
{
    use WithFileUploads;

    public $datas = [];
    public $tambahPage = false, $ubahPage = false;

    public $nama, $slug, $img, $keterangan, $isaktif;

    public $new_img;

    public $ID;

    public function render()
    {
        $this->datas = Olahraga::get();
        return view('livewire.olahraga.olahraga-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->nama = null;
        $this->slug = null;
        $this->img = null;
        $this->keterangan = null;
        $this->isaktif = null;
    }

    public function ubahisaktif($id)
    {
        $data = Olahraga::find($id);

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
            'nama' => 'unique:olahragas,nama'
        ]);

        if ($this->img) {
            $image = $this->img->store('img');
        } else {
            $image = null;
        }

        Olahraga::create([
            'nama' => $this->nama,
            'slug' => \Str::slug($this->nama),
            'img' => $image,
            'keterangan' => $this->keterangan,
        ]);

        $this->resetData();
        session()->flash('alertsuccess', 'berhasil tambah data');
    }

    public function ubahPage($id)
    {
        $this->ID = $id;
        $data = Olahraga::find($id);
        $this->nama = $data->nama;
        $this->slug = $data->slug;
        $this->img = $data->img;
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
        $data = Olahraga::find($this->ID);
        if ($this->new_img) {
             // hapus img lama, lalu store img baru
            Storage::delete($data->img);
            $image = $this->new_img->store('img');
        }else{
            $image = $data->img;
        }

        $data->update([
            'nama' => $this->nama,
            'slug' => \Str::slug($this->nama),
            'img' => $image,
            'keterangan' => $this->keterangan,
            'isaktif' => $this->isaktif,
        ]);

        $this->ubahPage = false;
        $this->resetData();

        session()->flash('alertsuccess', 'berhasil perbarui data');
    }
}

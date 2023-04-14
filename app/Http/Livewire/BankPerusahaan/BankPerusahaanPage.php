<?php

namespace App\Http\Livewire\BankPerusahaan;

use App\Models\BankPerusahaan;
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BankPerusahaanPage extends Component
{
    use WithFileUploads;

    public $datas = [], $metode_pembayarans = [];
    public $tambahPage = false, $ubahPage = false;

    public $nama, $img, $an, $norek, $keterangan, $metode_pembayaran_id, $isaktif;

    public $ID;
    public $new_img;

    public function render()
    {
        $this->datas = BankPerusahaan::get();
        $this->metode_pembayarans = MetodePembayaran::where('isaktif', true)->get();
        return view('livewire.bank-perusahaan.bank-perusahaan-page')->extends('layouts.app')->section('content');
    }

    public function resetData()
    {
        $this->nama = null;
        $this->img = null;
        $this->an = null;
        $this->norek = null;
        $this->keterangan = null;
        $this->metode_pembayaran_id = null;
        $this->isaktif = null;
    }

    public function ubahisaktif($id)
    {
        $data = BankPerusahaan::find($id);
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
            'nama' => 'unique:bank_perusahaans,nama'
        ]);

        if ($this->img) {
            $image = $this->img->store('img');
        } else {
            $image = null;
        }

        BankPerusahaan::create([
            'nama' => $this->nama,
            'img' => $image,
            'an' => $this->an,
            'norek' => $this->norek,
            'keterangan' => $this->keterangan,
            'metode_pembayaran_id' => $this->metode_pembayaran_id,
        ]);

        $this->resetData();
        session()->flash('alertsuccess', 'berhasil tambah data');
    }

    public function ubahPage($id)
    {
        $this->ID = $id;
        $data = BankPerusahaan::find($id);
        $this->nama = $data->nama;
        $this->img = $data->img;
        $this->an = $data->an;
        $this->norek = $data->norek;
        $this->keterangan = $data->keterangan;
        $this->metode_pembayaran_id = $data->metode_pembayaran_id;
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
        $data = BankPerusahaan::find($this->ID);
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
            'an' => $this->an,
            'norek' => $this->norek,
            'keterangan' => $this->keterangan,
            'metode_pembayaran_id' => $this->metode_pembayaran_id,
            'isaktif' => $this->isaktif,
        ]);

        $this->ubahPage = false;
        $this->resetData();

        session()->flash('alertsuccess', 'berhasil perbarui data');
    }

}

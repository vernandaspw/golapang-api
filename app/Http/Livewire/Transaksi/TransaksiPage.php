<?php

namespace App\Http\Livewire\Transaksi;

use Livewire\Component;

class TransaksiPage extends Component
{
    public function render()
    {
        return view('livewire.transaksi.transaksi-page')->extends('layouts.app')->section('content');
    }
}

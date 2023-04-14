<?php

namespace App\Http\Livewire\Mitra;

use Livewire\Component;

class MitraPage extends Component
{
    public function render()
    {
        return view('livewire.mitra.mitra-page')->extends('layouts.app')->section('content');
    }
}

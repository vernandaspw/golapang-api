<?php

namespace App\Http\Livewire\IklanMitra;

use Livewire\Component;

class IklanMitraPage extends Component
{
    public function render()
    {
        return view('livewire.iklan-mitra.iklan-mitra-page')->extends('layouts.app')->section('content');
    }
}

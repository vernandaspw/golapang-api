<?php

namespace App\Http\Livewire\Promo;

use Livewire\Component;

class PromoPage extends Component
{
    public function render()
    {
        return view('livewire.promo.promo-page')->extends('layouts.app')->section('content');
    }
}

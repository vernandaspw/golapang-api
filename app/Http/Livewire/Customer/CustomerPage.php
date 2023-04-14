<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class CustomerPage extends Component
{
    public function render()
    {
        return view('livewire.customer.customer-page')->extends('layouts.app')->section('content');
    }
}

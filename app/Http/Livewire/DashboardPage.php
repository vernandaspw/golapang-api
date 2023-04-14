<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardPage extends Component
{
    public function render()
    {
        return view('livewire.dashboard-page')->extends('layouts.app')->section('content');
    }
}

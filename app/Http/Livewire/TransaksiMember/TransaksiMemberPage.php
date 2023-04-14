<?php

namespace App\Http\Livewire\TransaksiMember;

use Livewire\Component;

class TransaksiMemberPage extends Component
{
    public function render()
    {
        return view('livewire.transaksi-member.transaksi-member-page')->extends('layouts.app')->section('content');
    }
}

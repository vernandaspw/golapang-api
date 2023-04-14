<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Resfor;
use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function get()
    {
        $data = Provinsi::where('isaktif', true)->orderBy('nama', 'asc')->get();

        return Resfor::success($data, 'success');
    }
}

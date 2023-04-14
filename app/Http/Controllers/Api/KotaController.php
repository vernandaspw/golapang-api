<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Resfor;
use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{

    public function getByProvinsi(Request $req)
    {
        $data = Kota::where('isaktif', true)->where('provinsi_id', $req->provinsi_id)->orderBy('nama', 'asc')->get();
        return Resfor::success($data, 'success');
    }
}

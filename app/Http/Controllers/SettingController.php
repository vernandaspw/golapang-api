<?php

namespace App\Http\Controllers;

use App\Helpers\Resfor;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function get()
    {
        $data = Setting::find(1);
        return Resfor::success($data, 'success');
    }
}

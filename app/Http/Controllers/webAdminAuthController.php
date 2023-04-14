<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class webAdminAuthController extends Controller
{
    public function logout()
    {
        auth('admin-web')->logout();
        return redirect('login');
    }
}

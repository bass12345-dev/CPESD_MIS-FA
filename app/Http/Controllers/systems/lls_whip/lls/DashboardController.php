<?php

namespace App\Http\Controllers\systems\lls_whip\lls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] = 'LLS Dashboard';
        return view('system.lls_whip.user.lls.dashboard.dashboard')->with($data);
    }
}

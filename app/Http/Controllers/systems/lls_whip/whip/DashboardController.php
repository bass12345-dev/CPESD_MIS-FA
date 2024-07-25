<?php

namespace App\Http\Controllers\systems\lls_whip\whip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] = 'WHIP Dashboard';
        return view('system.lls_whip.user.whip.dashboard.dashboard')->with($data);
    }
}

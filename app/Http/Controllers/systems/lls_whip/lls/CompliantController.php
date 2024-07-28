<?php

namespace App\Http\Controllers\systems\lls_whip\lls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompliantController extends Controller
{
    public function index(){
        $data['title'] = 'Compliant Reports';
        return view('system.lls_whip.user.lls.reports.compliant_reports.compliant_reports')->with($data);
    }
}

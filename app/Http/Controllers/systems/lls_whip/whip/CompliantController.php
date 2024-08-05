<?php

namespace App\Http\Controllers\systems\lls_whip\whip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompliantController extends Controller
{
    public function index()
    {
        $data['title'] = 'Compliant Report';
        return view('system.lls_whip.user.whip.reports.compliant_reports.compliant_reports')->with($data);
    }

}

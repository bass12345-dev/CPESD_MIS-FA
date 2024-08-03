<?php

namespace App\Http\Controllers\systems\lls_whip\lls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompliantController extends Controller
{
    public function index()
    {
        $data['title'] = 'Compliant Reports';
        return view('system.lls_whip.user.lls.reports.compliant_reports.compliant_reports')->with($data);
    }

    public function s()
    {
        $rows = DB::connection(config('app._database.lls_whip'))->table('establishment_employee as establishment_employee')
            ->select(
                DB::raw('COUNT(establishment_employee.nature_of_employment) as nature'),
                //Employee
                'establishment_employee.nature_of_employment as nature_of_employment'
            )
            ->groupBy('nature_of_employment')
            ->get();
            
            $r = [];
            foreach ($rows as $row) {
                $r[] = $row->nature;
              
            }
        $nature = config('app.lls_nature_of_employment2');

        $d = array_map(null, $r,$nature);

        dd($d);
        // $as = [];
        // while (current($nature)) {
        //     $n = key($nature);
        //     next($nature);
        //     array_push($as, $n);
        // }
        // $ad = [];
        // // foreach ($rows as $i) {
        // //     print_r($)
        // // }

      


    }

}

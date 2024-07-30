<?php

namespace App\Http\Controllers\systems\lls_whip\lls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CustomRepository;
use App\Repositories\lls\EmployeeQuery;

class DashboardController extends Controller
{
    protected $conn;
    protected $customRepository;
    protected $employeeQuery;
    protected $position_table;
    protected $status_table;
    protected $establishment_table;
    protected $default_city;
    public function __construct(CustomRepository $customRepository, EmployeeQuery $employeeQuery){
        $this->conn                 = config('app._database.lls_whip');
        $this->customRepository     = $customRepository;
        $this->employeeQuery        = $employeeQuery;
        $this->establishment_table       = 'establishments';
        $this->position_table       = 'positions';
        $this->status_table         = 'employment_status';
        $this->default_city         = '1004209000-City of Oroquieta';
        
      
    }
    public function index(){
        $data['title']              = 'LLS Dashboard';
        $data['positions']          = $this->customRepository->q_get($this->conn,$this->position_table)->count();
        $data['establishments']          = $this->customRepository->q_get($this->conn,$this->establishment_table)->count();
        $data['status']             = $this->customRepository->q_get($this->conn,$this->status_table)->count();
        $data['inside']             = $this->employeeQuery->inside($this->conn,$this->default_city);
        $data['outside']            = $this->employeeQuery->outside($this->conn,$this->default_city);
        return view('system.lls_whip.user.lls.dashboard.dashboard')->with($data);
    }

    public function count_all_employees_by_gender_inside(){
        $total = array();
        $gender = ['male','female'];
        foreach($gender as $row) {

            $res = $this->employeeQuery->countByGenderEmployedInside($this->conn,array('gender' => $row),$this->default_city);
            array_push($total, $res);
        }
       $data['label'] = $gender;
       $data['total']    = $total;
       $data['color'] = ['rgb(41,134,204)','rgb(201,0,118)'];
       return response()->json($data);
    }
    public function count_all_employees_by_gender_outside(){
        $total = array();
        $gender = ['male','female'];
        foreach($gender as $row) {

            $res = $this->employeeQuery->countByGenderEmployedOutside($this->conn,array('gender' => $row),$this->default_city);
            array_push($total, $res);
        }
       $data['label'] = $gender;
       $data['total']    = $total;
       $data['color'] = ['rgb(41,134,204)','rgb(201,0,118)'];
       return response()->json($data);
    }
}

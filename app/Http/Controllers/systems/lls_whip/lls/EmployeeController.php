<?php

namespace App\Http\Controllers\systems\lls_whip\lls;

use App\Http\Controllers\Controller;
use App\Http\Requests\lls\EmployeeStoreRequest;
use App\Repositories\CustomRepository;
use App\Repositories\lls\EmployeeQuery;
use App\Services\user\USerService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    protected $customRepository;
    protected $employeeQuery;
    protected $uSerService;
    protected $conn;
    protected $est_employee_table;

    protected $employee_table;
    protected $order_by_asc = 'asc';
    protected $order_by_key = 'estab_emp_id';
    

    public function __construct(CustomRepository $customRepository, EmployeeQuery $employeeQuery, USerService $uSerService){
        $this->customRepository     = $customRepository;
        $this->employeeQuery        = $employeeQuery;
        $this->uSerService          = $uSerService;
        $this->conn                 = config('app._database.lls_whip');
        $this->employee_table       = 'employees';
        $this->est_employee_table   = 'establishment_employee';
    }
    public function index(){
        $data['title'] = 'Establishments Position';
        return view('system.lls_whip.user.lls.positions.lists.lists')->with($data);
    }

    public function get_establishment_employees(){
        $items = $this->employeeQuery->get_establishment_employee($this->conn);
        $data = [];
        foreach ($items as $row) {
           $data[] = array(
                    'full_name'             => $this->uSerService->user_full_name($row),
                    'full_address'          => $this->uSerService->full_address($row),
                    'position'              => $row->position,
                    'nature_of_employment'  => $row->nature_of_employment,
                    'status_of_employment'  => $row->status,
                    'year_employed'         => $row->year_employed,
                    'level_of_employment'   => $row->level_of_employment
           );
        }
        return response()->json($data);
    }

    public function insert_employee(Request $request){
        $items  = array(
            'employee_id'               => $request->input('employee_id'),
            'position_id'               => $request->input('position'),
            'nature_of_employment'      => $request->input('employment_nature'),
            'status_of_employment_id'   => $request->input('employment_status'),
            'year_employed'             => $request->input('year_employed'),
            'level_of_employment'       => $request->input('employment_level'),
            'created_on'                => Carbon::now()->format('Y-m-d H:i:s'),
        );

        $insert = $this->customRepository->insert_item($this->conn,$this->est_employee_table,$items);
        if ($insert) {
            // Registration successful
            return response()->json([
                'message' => 'Employmee Added Successfully', 
                'response' => true
            ], 201);
        }else {
            return response()->json([
                'message' => 'Something Wrong', 
                'response' => false
            ], 422);
        }
    }


    public function search_query(){
        $q = trim($_GET['key']);
        $emp = $this->employeeQuery->q_search($this->conn,$q);
        $data = [];
        foreach ($emp as $row) {
            $data[] = array(
                'employee_id'   => $row->employee_id,
                'first_name'    => $row->first_name,
                'middle_name'   => $row->middle_name == null ? ' ' : $row->middle_name,
                'last_name'     => $row->last_name,
                'extension'     => $row->extension == null ? ' ' : $row->extension
            );
        }
        return response()->json($data);
    }
}

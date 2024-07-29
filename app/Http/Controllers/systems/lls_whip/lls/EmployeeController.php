<?php

namespace App\Http\Controllers\systems\lls_whip\lls;

use App\Http\Controllers\Controller;
use App\Http\Requests\lls\EmployeeStoreRequest;
use App\Repositories\CustomRepository;
use App\Repositories\lls\EmployeeQuery;
use App\Services\lls\EstablishmentService;
use App\Services\user\USerService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;


class EmployeeController extends Controller
{
    protected $customRepository;
    protected $employeeQuery;
    protected $uSerService;
    protected $establishmentService;
    protected $conn;
    protected $est_employee_table;

    protected $employee_table;
    protected $order_by_asc = 'asc';
    protected $order_by_desc = 'desc';
    protected $order_by_key = 'estab_emp_id';
    

    public function __construct(CustomRepository $customRepository, EmployeeQuery $employeeQuery, USerService $uSerService , EstablishmentService $establishmentService){
        $this->customRepository     = $customRepository;
        $this->employeeQuery        = $employeeQuery;
        $this->uSerService          = $uSerService;
        $this->establishmentService = $establishmentService;
        $this->conn                 = config('app._database.lls_whip');
        $this->employee_table       = 'employees';
        $this->est_employee_table   = 'establishment_employee';
    }
    public function index(){
        $data['title'] = 'Employees Records';
        return view('system.lls_whip.user.lls.employees_records.lists.lists')->with($data);
    }
    public function view_employee($id){
        $row                = $this->customRepository->q_get_where($this->conn,array('employee_id' => $id),$this->employee_table)->first();
        $data['title']      = $this->uSerService->user_full_name($row);
        $data['full_address'] = $this->uSerService->full_address($row);
        $data['row']        = $row;
        return view('system.lls_whip.user.lls.employees_records.view.view')->with($data);
    }

    public function get_all_employees(){
        $es = $this->customRepository->q_get_order($this->conn,$this->employee_table,'employee_id',$this->order_by_desc)->get();
        $items = [];
        foreach ($es as $row) {
           $items[] = array(
                    'employee_id'           => $row->employee_id,
                    'full_name'             => $this->uSerService->user_full_name($row),
                    'full_address'          => $this->uSerService->full_address($row),
                    'contact_number'       => $row->contact_number,
                    'created'         => date('M d Y - h:i a', strtotime($row->created_on)),
           );
        }
        return response()->json($items);
    }

    public function insert_employee(Request $request){

        $items  = array(
            'first_name'            => $request->input('first_name'),
            'middle_name'           => $request->input('middle_name'),
            'last_name'             => $request->input('last_name'),
            'extension'             => $request->input('extension'),
            'province'              => $request->input('province'),
            'city'                  => $request->input('city'),
            'barangay'              => $request->input('barangay'),
            'street'                => $request->input('street'),
            'contact_number'        => $request->input('contact_number'),
            'created_on'            => Carbon::now()->format('Y-m-d H:i:s'),
        );
        
        $insert = $this->customRepository->insert_item($this->conn,$this->employee_table,$items);
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

    public function delete_employee(Request $request)
    {

        $id = $request->input('id')['id'];
        if (is_array($id)) {
            foreach ($id as $row) {
               $where = array('employee_id' => $row);
               $this->customRepository->delete_item($this->conn,$this->employee_table,$where);
            }

            $data = array('message' => 'Deleted Succesfully', 'response' => true);
        } else {
            $data = array('message' => 'Error', 'response' => false);
        }



        return response()->json($data);
    }

    public function delete_establishment_employee(Request $request)
    {

        $id = $request->input('id')['id'];
        if (is_array($id)) {
            foreach ($id as $row) {
               $where = array('estab_emp_id' => $row);
               $this->customRepository->delete_item($this->conn,$this->est_employee_table,$where);
            }

            $data = array('message' => 'Deleted Succesfully', 'response' => true);
        } else {
            $data = array('message' => 'Error', 'response' => false);
        }



        return response()->json($data);
    }


    public function get_employee_information(Request $request){
        $employee_id  = $request->input('id');
        $items = $this->employeeQuery->get_employee_information($this->conn,$employee_id);
        return response()->json($items);
    }

    public function get_establishment_employees(Request $request){
        $id = $request->input('id');
        $items = $this->employeeQuery->get_establishment_employee($this->conn,$id);
        $data = [];
        foreach ($items as $row) {
           $data[] = array(
                    'establishment_employee_id' => $row->estab_emp_id,
                    'employee_id'           => $row->employee_id,
                    'full_name'             => $this->uSerService->user_full_name($row),
                    'full_address'          => $this->uSerService->full_address($row),
                    'position'              => $row->position,
                    'position_id'           => $row->position_id,
                    'nature_of_employment'  => $row->nature_of_employment,
                    'status_id'                  => $row->employ_stat_id,
                    'status_of_employment'  => $row->status,
                    'year_employed'         => $row->year_employed,
                    'level_of_employment'   => $row->level_of_employment
           );
        }
        return response()->json($data);
    }


    public function insert_or_update_establishment_employee(Request $request){

        $items  = array(
            'establishment_id'          => $request->input('establishment_id'),
            'employee_id'               => $request->input('employee_id'),
            'position_id'               => $request->input('position'),
            'nature_of_employment'      => $request->input('employment_nature'),
            'status_of_employment_id'   => $request->input('employment_status'),
            'year_employed'             => $request->input('year_employed'),
            'level_of_employment'       =>  $request->input('employment_level'),
        );

        if(empty($request->input('establishment_employee_id'))){
            $resp = $this->establishmentService->insert_establishment_employee($items);
            
        }else {
            $where = array('estab_emp_id' => $request->input('establishment_employee_id'));
            $resp = $this->establishmentService->update_establishment_employee($where,$items);
        }

        return response()->json($resp);
     
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
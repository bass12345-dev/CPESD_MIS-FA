<?php

namespace App\Http\Controllers\systems\lls_whip\whip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CustomRepository;
use App\Repositories\whip\EmployeeQuery;
use App\Services\lls\EstablishmentService;
use App\Services\user\UserService;
use App\Services\whip\ContractorsService;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    protected $customRepository;
    protected $employeeQuery;
    protected $uSerService;
    protected $establishmentService;
    protected $contractorsService;
    protected $conn;
    protected $contractor_employee_table;

    protected $employee_table;
    protected $order_by_asc = 'asc';
    protected $order_by_desc = 'desc';
    protected $order_by_key = 'estab_emp_id';


    public function __construct(CustomRepository $customRepository, EmployeeQuery $employeeQuery, UserService $uSerService, EstablishmentService $establishmentService, ContractorsService $contractorsService)
    {
        $this->customRepository     = $customRepository;
        $this->employeeQuery        = $employeeQuery;
        $this->uSerService          = $uSerService;
        $this->establishmentService = $establishmentService;
        $this->contractorsService   = $contractorsService;
        $this->conn                 = config('app._database.lls_whip');
        $this->employee_table       = 'employees';
        $this->contractor_employee_table   = 'contractor_employee';
    }

    public function insert_or_update_project_employee(Request $request)
    {

        $items  = array(
            'contractor_id'             => $request->input('contractor_id'),
            'project_id'                => $request->input('project_id'),
            'employee_id'               => $request->input('employee_id'),
            'position_id'               => $request->input('position'),
            'nature_of_employment'      => $request->input('employment_nature'),
            'status_of_employment_id'   => $request->input('employment_status'),
            'level_of_employment'       =>  $request->input('employment_level'),
            'start_date'                => $request->input('start') == NULL ? NULL :  Carbon::parse($request->input('start'))->format('Y-m-d'),
            'end_date'                  => $request->input('end') == NULL ? NULL :  Carbon::parse($request->input('end'))->format('Y-m-d'),
        );



        if ($items['start_date'] <= $items['end_date'] ||  empty($items['end_date'])) {

            if (empty($request->input('contractor_employee_id'))) {
                $resp = $this->contractorsService->insert_contractor_employee($items);
            } else {
                $where = array('contractor_employee_id' => $request->input('contractor_employee_id'));
                $resp = $this->contractorsService->update_establishment_employee($where, $items);
            }
        } else {
            $resp = [
                'message' => 'Start Date is greater than End Date',
                'response' => false
            ];
        }



        return response()->json($resp);
    }


    public function delete_project_employee(Request $request)
    {

        $id = $request->input('id')['id'];
        if (is_array($id)) {
            foreach ($id as $row) {
               $where = array('contractor_employee_id' => $row);
               $this->customRepository->delete_item($this->conn,$this->contractor_employee_table,$where);
            }
            $data = array('message' => 'Deleted Succesfully', 'response' => true);
        } else {
            $data = array('message' => 'Error', 'response' => false);
        }
        return response()->json($data);
    }



    public function get_project_employee(Request $request){
        $id = $request->input('id');

        $items =  $this->employeeQuery->get_project_employee($this->conn,$id);
        $data = [];
        foreach ($items as $row) {
           $data[] = array(
                    'contractor_employee_id'     => $row->contractor_employee_id,
                    'employee_id'                   => $row->employee_id,
                    'full_name'                     => $this->uSerService->user_full_name($row),
                    'full_address'                  => $this->uSerService->full_address($row),
                    'position'                      => $row->position,
                    'position_id'                   => $row->position_id,
                    'nature_of_employment'          => $row->nature_of_employment,
                    'status_id'                     => $row->employ_stat_id,
                    'status_of_employment'          => $row->status,
                    'start_date'                    =>  $row->start_date == NULL ? '-' :  Carbon::parse($row->start_date)->format('M Y'),
                    'end_date'                      => $row->end_date == NULL ? '-' :  Carbon::parse($row->end_date)->format('M Y'),
                    'level_of_employment'           => $row->level_of_employment,
                    'gender'                        => $row->gender
           );
        }
        return response()->json($data);
    }
}

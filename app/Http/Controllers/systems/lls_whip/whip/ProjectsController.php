<?php

namespace App\Http\Controllers\systems\lls_whip\whip;

use App\Http\Controllers\Controller;
use App\Repositories\CustomRepository;
use App\Services\whip\ContractorsService;
use App\Services\whip\ProjectsService;
use App\Http\Requests\whip\ProjectStoreRequest;
use App\Repositories\whip\ContractorQuery;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ProjectsController extends Controller
{
    protected $conn;
    protected $Contractorquery;
    protected $projectService;
    protected $contractorService;
    protected $customRepository;
    protected $projects_table;
    protected $status_table;
    protected $order_by_asc = 'asc';
    protected $order_by_key = 'project_id';
    protected $position_table;
    
    public function __construct(CustomRepository $customRepository, ProjectsService $projectService, ContractorsService $contractorsService, ContractorQuery $Contractorquery){
        $this->conn                 = config('app._database.lls_whip');
        $this->customRepository     = $customRepository;
        $this->projectService       = $projectService;
        $this->contractorService    = $contractorsService;
        $this->projects_table       = 'projects';
        $this->position_table       = 'positions';
        $this->status_table         = 'employment_status';
        $this->Contractorquery      = $Contractorquery;
    }

    public function index(){
        $data['title'] = 'Contractors';
        return view('system.lls_whip.user.whip.projects.lists.lists')->with($data);
    }

    public function add_new_project_view(){
        $data['title'] = 'Add New Project';
        return view('system.lls_whip.user.whip.projects.add_new.add_new')->with($data);
    }

    public function project_information_view($id){

        $data['row']                     = $this->customRepository->q_get_where($this->conn,array('project_id' => $id),$this->projects_table)->first();
        $data['title']                   = $data['row']->project_title;
        $data['year_now']                = Carbon::now()->format('Y');
        $data['barangay']                = config('app.barangay');
        $data['level_of_employment']     = config('app.level_of_employment');
        $data['nature_of_employment']    = config('app.lls_nature_of_employment');
        $data['positions']               =  $this->customRepository->q_get_where_order($this->conn,$this->position_table,array('type' => 'whip'),'position','asc')->get();
        $data['employment_status']       = $this->customRepository->q_get_order($this->conn,$this->status_table,'status','asc')->get();
        return view('system.lls_whip.user.whip.projects.view.view')->with($data);

    }

    public function insert_project(ProjectStoreRequest $request){

        $validatedData = $request->validated();
        $insert = $this->projectService->registerProj($validatedData);
        
        if ($insert) {
            // Registration successful
            return response()->json([
                'message' => 'Project Added Successfully', 
                'response' => true
            ], 201);
        }else {
            return response()->json([
                'message' => 'Something Wrong', 
                'response' => false
            ], 422);
        }
    }


    public function delete_projects(Request $request){

        $id = $request->input('id')['id'];
        if (is_array($id)) {
            foreach ($id as $row) {
               $where = array('project_id' => $row);
               $this->customRepository->delete_item($this->conn,$this->projects_table,$where);
            }

            $data = array('message' => 'Deleted Succesfully', 'response' => true);
        } else {
            $data = array('message' => 'Error', 'response' => false);
        }



        return response()->json($data);
    }
   

    public function get_all_projects(){
        $query_row = $this->Contractorquery->QueryAllProjects($this->conn);
        $items = [];
        foreach ($query_row as $row) {
            $items[] = array(
                        'project_id'        => $row->project_id,
                        'project_title'     => $row->project_title,
                        'project_cost'      => $row->project_cost,
                        'project_status'    => $row->project_status,
                        'contractor'        => $row->contractor_name,
                        'project_location'  => $this->contractorService->full_address($row),
            );
        }
        return response()->json($items);

    }

    public function get_contractor_projects($id){
        $query_row = $this->customRepository->q_get_where_order($this->conn,$this->projects_table,array('contractor_id'=> $id),$this->order_by_key,$this->order_by_asc)->get();
        $items = [];
        foreach ($query_row as $row) {
            $items[] = array(
                        'project_title'     => $row->project_title,
                        'project_cost'      => $row->project_cost,
                        'project_location'  => $this->contractorService->full_address($row),
            );
        }
        return response()->json($items);
    }
}

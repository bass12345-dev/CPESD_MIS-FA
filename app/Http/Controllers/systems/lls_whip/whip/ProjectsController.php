<?php

namespace App\Http\Controllers\systems\lls_whip\whip;

use App\Http\Controllers\Controller;
use App\Repositories\CustomRepository;
use App\Services\whip\ContractorsService;
use App\Services\whip\ProjectsService;
use GuzzleHttp\Psr7\Request;
use App\Http\Requests\whip\ProjectStoreRequest;

class ProjectsController extends Controller
{
    protected $conn;
    protected $projectService;
    protected $contractorService;
    protected $customRepository;
    protected $projects_table;
    protected $order_by_asc = 'asc';
    protected $order_by_key = 'project_id';

    public function __construct(CustomRepository $customRepository, ProjectsService $projectService, ContractorsService $contractorsService){
        $this->conn                 = config('app._database.lls_whip');
        $this->customRepository     = $customRepository;
        $this->projectService       = $projectService;
        $this->contractorService    = $contractorsService;
        $this->projects_table       = 'projects';
    }

    public function index(){
        $data['title'] = 'Contractors';
        return view('system.lls_whip.user.whip.projects.lists.lists')->with($data);
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

    public function get_all_projects(){
        $query_row = $this->customRepository->q_get_order($this->conn,$this->projects_table,$this->order_by_key,$this->order_by_asc)->get();
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

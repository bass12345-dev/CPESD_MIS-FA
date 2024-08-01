<?php

namespace App\Http\Controllers\systems\lls_whip\lls;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstablishmentStoreRequest;
use App\Http\Requests\lls\SurveyStoreRequest;
use App\Repositories\CustomRepository;
use App\Services\lls\EstablishmentService;
use App\Services\lls\UserService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EstablishmentController extends Controller
{
    protected $conn;
    
    protected $users;
    
    protected $dts;
    protected $customRepository;
    protected $establishmentService;
    protected $establishments_table;
    protected $survey_table;
    protected $position_table;
    protected $employment_status_table;
    protected $order_by_asc = 'asc';
    protected $order_by_key = 'establishment_code';
    public function __construct(CustomRepository $customRepository, EstablishmentService $establishmentService){
        $this->conn                 = config('app._database.lls_whip');
        $this->users                = env('DB_DATABASE', '');
        $this->dts                  = config('app._database.dts');
        $this->customRepository     = $customRepository;
        $this->establishmentService = $establishmentService;
        $this->establishments_table = 'establishments';
        $this->survey_table         = 'survey';
        $this->position_table       = 'positions';
        $this->employment_status_table = 'employment_status';
    }
    public function add_new_establishment_view(){
        $data['title'] = 'Add New Establishments';
        $data['barangay'] = config('app.barangay');
        return view('system.lls_whip.user.lls.establishments.add_new.add_new')->with($data);
    }
    public function establishments_list_view(){
        $data['title']      = 'Establishments';
        return view('system.lls_whip.user.lls.establishments.lists.lists')->with($data);
    }

    public function establishments_view($id){
        $data['row']                    = $this->customRepository->q_get_where($this->conn,array('establishment_id' => $id),$this->establishments_table)->first();
        $data['year_now']               = Carbon::now()->format('Y');
        $data['barangay']               = config('app.barangay');
        $data['title']                  = $data['row']->establishment_name;
        $data['level_of_employment']    = config('app.level_of_employment');
        $data['nature_of_employment']   = config('app.lls_nature_of_employment');
        $data['positions']              =  $this->customRepository->q_get_order($this->conn,$this->position_table,'position','asc')->get();
        $data['employment_status']      = $this->customRepository->q_get_order($this->conn,$this->employment_status_table,'status','asc')->get();
        return view('system.lls_whip.user.lls.establishments.view.view')->with($data);
    }
    
    public function insert_es(EstablishmentStoreRequest $request){

        $validatedData = $request->validated();
        $resp = $this->establishmentService->registerES($validatedData);

        if ($resp) {
            return response()->json([
                'message' => 'Establishment Added Successfully', 
                'response' => true
            ], 201);
        }else {
            return response()->json([
                'message' => 'Something Wrong', 
                'response' => false
            ], 422);
        }
    }


    public function delete_establishment(Request $request)
    {

        $id = $request->input('id')['id'];
        if (is_array($id)) {
            foreach ($id as $row) {
               $where = array('establishment_id' => $row);
               $this->customRepository->delete_item($this->conn,$this->establishments_table,$where);
            }

            $data = array('message' => 'Deleted Succesfully', 'response' => true);
        } else {
            $data = array('message' => 'Error', 'response' => false);
        }



        return response()->json($data);
    }

    public function update_establishment(Request $request){

        $resp = $this->establishmentService->Update_Establishment($request);
        if ($resp) {
            // Registration successful
            return response()->json([
                'message' => 'Establishment Updated Successfully', 
                'response' => true
            ], 201);
        }else {
            return response()->json([
                'message' => 'Something Wrong/No Changes Applied', 
                'response' => false
            ], 422);
        }

    }

    public function get_all_establishment(){
        $es = $this->customRepository->q_get_order($this->conn,$this->establishments_table,$this->order_by_key,$this->order_by_asc)->get();
        $items = [];
        foreach ($es as $row) {
           $items[] = array(
                    'establishment_id'          => $row->establishment_id,
                    'establishment_code'        => $row->establishment_code,
                    'establishment_name'        => $row->establishment_name,
                    'contact_number'            => $row->contact_number,
                    'telephone_number'          => $row->telephone_number,
                    'full_address'              => $this->establishmentService->establishment_full_address($row),
                    'email_address'             => $row->email_address,
                    'authorized_personnel'      => $row->authorized_personnel,
                    'position'                  => $row->position,
                    'status'                    => $row->status,
                    
           );
        }

        return response()->json($items);
    }

    public function submit_survey(SurveyStoreRequest $request){

        $validatedData = $request->validated();
        $resp = $this->establishmentService->Submit_Survey($validatedData);

        if ($resp) {
            return response()->json([
                'message' => 'Survey Updated Successfully', 
                'response' => true
            ], 201);
        }else {
            return response()->json([
                'message' => 'Something Wrong', 
                'response' => false
            ], 422);
        }
        
        
    }

    public function get_survey_by_year(Request $request){
        $data = $this->establishmentService->get_survey($request->input('id'),$request->input('year'));
        return response()->json($data);
    }


    //REPORTS
    public function generate_compliant_report(Request $request){
       $year = $request->input('date').'-01';
       $data = $this->establishmentService->compliant_process($year);
       return response()->json($data);
       
    }


    
    public function sample(){
        // $rows =  DB::select("select cpesd_mis_users_db.users.first_name,dts.documents.document_name
        //     from cpesd_mis_users_db.users INNER JOIN dts.documents 
        //     ON cpesd_mis_users_db.users.user_id=dts.documents.u_id
        //     ");
        
        // echo json_encode($rows);

        $query = DB::table($this->users.'.users as userDB')->leftjoin('dts.documents as documentsDB', 'documentsDB.u_id', '=', 'userDB.user_id');        
        $output = $query->select(['userDB.*','documentsDB.*'])->get();

        dd($output);
        
    }
}

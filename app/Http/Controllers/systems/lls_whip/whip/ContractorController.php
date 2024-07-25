<?php

namespace App\Http\Controllers\systems\lls_whip\whip;

use App\Http\Controllers\Controller;
use App\Http\Requests\whip\ContractorStoreRequest;
use App\Repositories\CustomRepository;
use App\Services\whip\ContractorsService;

class ContractorController extends Controller
{   
    protected $conn;
    protected $contractorService;
    protected $customRepository;
    protected $contractors_table;
    protected $order_by_asc = 'asc';
    protected $order_by_key = 'contractor_id';
    public function __construct(CustomRepository $customRepository, ContractorsService $contractorService){
        $this->conn                 = config('app._database.lls_whip');
        $this->customRepository     = $customRepository;
        $this->contractorService    = $contractorService;
        $this->contractors_table    = 'contractors';
    }
    public function add_new_contractor(){
        $data['title'] = 'Add New Contractor';
        return view('system.lls_whip.user.whip.contractor.add_new.add_new')->with($data);
    }
    public function contractors_list(){
        $data['title'] = 'Contractors';
        return view('system.lls_whip.user.whip.contractor.lists.lists')->with($data);
    }

    public function contractor_information($id){
       
        $row                    = $this->customRepository->q_get_where($this->conn,array('contractor_id' => $id),$this->contractors_table)->first();
        $data['title']          = $row->contractor_name;
        $data['barangay']       = explode('-',$row->barangay)[0];
        $data['city']            = explode('-',$row->city)[0];
        $data['province']        = explode('-',$row->province)[0];
        $data['row']            = $row;
        $data['full_address']   = $this->contractorService->full_address($row); 
        return view('system.lls_whip.user.whip.contractor.view.view')->with($data);
    }
    
    public function insert_contr(ContractorStoreRequest $request){
        $validatedData = $request->validated();
        $insert = $this->contractorService->registerContr($validatedData);
        
        if ($insert) {
            // Registration successful
            return response()->json([
                'message' => 'Contractor Added Successfully', 
                'response' => true
            ], 201);
        }else {
            return response()->json([
                'message' => 'Something Wrong', 
                'response' => false
            ], 422);
        }
    }


    public function get_all_contractors(){
        $contractors = $this->customRepository->q_get_order($this->conn,$this->contractors_table,$this->order_by_key,$this->order_by_asc)->get();
        $items = [];
        foreach ($contractors as $row) {
           $items[] = array(
                    'contractor_id'         => $row->contractor_id,
                    'contractor_name'       => $row->contractor_name,
                    'proprietor'            => $row->proprietor,
                    'full_address'          => $this->contractorService->full_address($row),
                    'phone_number'          => $row->phone_number,
                    'phone_number_owner'          => $row->phone_number_owner,
                    'telephone_number'      => $row->telephone_number,
                    'email_address'         => $row->email_address,
                    'status'                => $row->status
           );
        }

        return response()->json($items);
    }
   
}

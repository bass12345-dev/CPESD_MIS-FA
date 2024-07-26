<?php

namespace App\Http\Controllers\systems\lls_whip\lls;

use App\Http\Controllers\Controller;
use App\Repositories\CustomRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmploymentStatusController extends Controller
{
    protected $customRepository;
    protected $conn;
    protected $status_table;
    protected $order_by_asc = 'asc';
    protected $order_by_key = 'status';

    public function __construct(CustomRepository $customRepository){
        $this->customRepository = $customRepository;
        $this->conn               = config('app._database.lls_whip');
        $this->status_table       = 'employment_status';
    }
    public function index(){
        $data['title'] = 'Employment Status List';
        return view('system.lls_whip.user.lls.employment_status.lists.lists')->with($data);
    }

    public function get_all_status(){
        $es = $this->customRepository->q_get_order($this->conn,$this->status_table,$this->order_by_key,$this->order_by_asc)->get();
        $items = [];
        foreach ($es as $row) {
           $items[] = array(
                    'employ_stat_id'    => $row->employ_stat_id,
                    'status'            => $row->status,
                    'created'           => date('M d Y - h:i a', strtotime($row->created_on)),
           );
        }
        return response()->json($items);
    }

    public function insert_status(Request $request){


        $validated = $request->validate([
            'status' => 'required|unique:'.$this->conn.'.employment_status|max:255',
        ]);

        $items = array(
            'status'      =>$validated['status'],
            'created_on'  => Carbon::now()->format('Y-m-d H:i:s'),
        );
        $insert = $this->customRepository->insert_item($this->conn,$this->status_table,$items);
        if ($insert) {
            // Registration successful
            return response()->json([
                'message' => 'Employment Status Added Successfully', 
                'response' => true
            ], 201);
        }else {
            return response()->json([
                'message' => 'Something Wrong', 
                'response' => false
            ], 422);
        }
    }
}

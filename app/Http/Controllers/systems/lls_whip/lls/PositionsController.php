<?php

namespace App\Http\Controllers\systems\lls_whip\lls;

use App\Http\Controllers\Controller;
use App\Repositories\CustomRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PositionsController extends Controller
{
    protected $customRepository;
    protected $conn;
    protected $position_table;
    protected $order_by_asc = 'asc';
    protected $order_by_key = 'position';

    public function __construct(CustomRepository $customRepository){
        $this->customRepository = $customRepository;
        $this->conn                 = config('app._database.lls_whip');
        $this->position_table       = 'positions';
    }
    public function index(){
        $data['title'] = 'Establishments Position';
        return view('system.lls_whip.user.lls.positions.lists.lists')->with($data);
    }

    public function get_all_positions(){
        $es = $this->customRepository->q_get_order($this->conn,$this->position_table,$this->order_by_key,$this->order_by_asc)->get();
        $items = [];
        foreach ($es as $row) {
           $items[] = array(
                    'position_id'     => $row->position_id,
                    'position'        => $row->position,
                    'created'         => date('M d Y - h:i a', strtotime($row->created_on)),
           );
        }
        return response()->json($items);
    }

    public function insert_position(Request $request){
        $items = array(
            'position'      => $request->input('position'),
            'created_on'    => Carbon::now()->format('Y-m-d H:i:s'),
        );
        $insert = $this->customRepository->insert_item($this->conn,$this->position_table,$items);
        if ($insert) {
            // Registration successful
            return response()->json([
                'message' => 'Position Added Successfully', 
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

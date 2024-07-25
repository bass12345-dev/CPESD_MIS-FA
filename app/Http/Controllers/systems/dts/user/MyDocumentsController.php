<?php

namespace App\Http\Controllers\systems\dts\user;

use App\Http\Controllers\Controller;
use App\Repositories\CustomRepository;
use App\Repositories\dts\DtsQuery;
use App\Services\dts\user\DashboardService;
use App\Services\dts\user\DocumentService;
use App\Services\user\USerService;
use Illuminate\Http\Request;

class MyDocumentsController extends Controller
{
    protected $dashboardService;
    protected $uSerService;
    protected $documentService;
    protected $conn;
    protected $document_types_table;
    protected $office_table;
    protected $history_table;
    protected $customRepository;
    protected $dtsQuery;
    public function __construct(DashboardService $dashboardService, CustomRepository $customRepository, DtsQuery $dtsQuery, USerService $uSerService, DocumentService $documentService){
        $this->conn                 = config('app._database.dts');
        $this->dashboardService     = $dashboardService;
        $this->uSerService          = $uSerService;
        $this->documentService      = $documentService;
        $this->customRepository     = $customRepository;
        $this->dtsQuery             = $dtsQuery;
        $this->document_types_table = 'document_types';
        $this->office_table         = 'offices';
        $this->history_table        = 'history';
    }
    public function index()
    {
        $data['title']          = 'My Documents';
        $data['document_types'] = $this->customRepository->q_get_order($this->conn,$this->document_types_table,'type_name', 'asc')->get();
        $data['offices']        = $this->customRepository->q_get_order($this->conn,$this->office_table, 'office', 'asc')->get();
        return view('system.dts.user.contents.my_documents.my_documents')->with($data);
    }


    public function get_my_documents(){

        $items = array();
        $rows = $this->dtsQuery->get_my_documents($this->conn);
        $i = 1;
        foreach ($rows as $value => $key) {
    
                $delete_button = $this->customRepository->q_get_where($this->conn,array('t_number' => $key->tracking_number),$this->history_table)->count() > 1 ? true : false;
                $status = $this->documentService->check_status($key->doc_status);
                $items[] = array(
                    'number'            => $i++,
                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'created'           => date('M d Y - h:i a', strtotime($key->d_created)),
                    'a'                 => $delete_button,
                    'document_id'       => $key->document_id,
                    'is'                => $status,
                    'doc_type'          => $key->doc_type,
                    'description'       => $key->document_description,
                    'destination_type'  => $key->destination_type,
                    'doc_status'        => $key->doc_status,
                    'name'              => $key->name,
                    'document_type_name' => $key->type_name,
                    'encoded_by'        => $this->uSerService->user_full_name($key),
                    'origin'            => $key->origin == NULL ? '-' : $key->origin,
                    'origin_id'         => $key->origin_id
                );
        }

        return response()->json($items);
    }


   
}

<?php

namespace App\Services\lls;

use App\Repositories\CustomRepository;
use App\Repositories\lls\EmployeeQuery;
use Carbon\Carbon;

class EstablishmentService
{
    
    protected $conn;
    protected $customRepository;
    protected $establishments_table;
    protected $establishment_employee_table;
    protected $employeeQuery;
    protected $survey_table;
    public function __construct(CustomRepository $customRepository, EmployeeQuery $employeeQuery){
        $this->conn                 = config('app._database.lls_whip');
        $this->customRepository     = $customRepository;
        $this->establishments_table = 'establishments';
        $this->survey_table         = 'survey';
        $this->establishment_employee_table = 'establishment_employee';
        $this->employeeQuery        = $employeeQuery;

    }
    

    //REGISTER USER
    public function registerES(array $row)
    {

        $items = array(
            'establishment_code'     => 'ES-'.$row['establishment_code'],
            'establishment_name'     => $row['establishment_name'],
            'authorized_personnel'   => $row['authorized_personnel'],
            'position'               => $row['position'],
            'barangay'               => $row['barangay'],
            'street'                 => $row['street'],
            'contact_number'         => $row['contact_number'],
            'telephone_number'       => $row['telephone_number'],
            'email_address'          => $row['email_address'],
            'created_on'             => Carbon::now()->format('Y-m-d H:i:s'),
            'status'                 => 'active'
        );
        $user = $this->customRepository->insert_item($this->conn,$this->establishments_table,$items);
        return $user;
    }


    public function Update_Establishment($row)
    {

        $where = array('establishment_id' => $row->input('establishment_id'));

        $items = array(
            'establishment_code'     => $row->input('establishment_code'),
            'establishment_name'     => $row->input('establishment_name'),
            'authorized_personnel'   => $row->input('authorized_personnel'),
            'position'               => $row->input('position'),
            'barangay'               => $row->input('barangay'),
            'street'                 => $row->input('street'),
            'contact_number'         => $row->input('contact_number'),
            'email_address'          => $row->input('email_address'),
            'status'                 => $row->input('status'),
        );
        $user = $this->customRepository->update_item($this->conn,$this->establishments_table,$where,$items);
        return $user;
    }


    public function get_survey($id,$year){

            $arr = [];

            foreach (config('app.lls_nature_of_employment') as $row) {
                    array_push($arr,'inside '.$row[0]);
            }

            foreach (config('app.lls_nature_of_employment') as $row) {
                array_push($arr,'outside '.$row[0]);
            }
        
            // $query_survey   = $this->employeeQuery->get_employee_survey_by_year($this->conn,$id,$year);
            // $data=[];
            // foreach ($query_survey as $row) {
            //     $data = array(
            //         ''
            //     );
            // }

            // $count          = $query_survey->count();
            // $query_row      = $count == 0 ? null : $query_survey->first();
    
            // $row = array(                    
            //     'inside_permanent'       => $query_row == null ? 0 :  $query_row->inside_permanent,
            //     'inside_probationary'    => $query_row == null ? 0 : $query_row->inside_probationary,
            //     'inside_contractuals'     => $query_row == null ? 0 :   $query_row->inside_contractuals,
            //     'inside_project_based'   => $query_row == null ? 0 : $query_row->inside_project_based,
            //     'inside_seasonal'        =>  $query_row == null ? 0 :   $query_row->inside_seasonal,
            //     'inside_job_order'       =>  $query_row == null ? 0 :   $query_row->inside_job_order,
            //     'inside_mgt'             =>  $query_row == null ? 0 :   $query_row->inside_mgt,
            //     'outside_permanent'     =>  $query_row == null ? 0 : $query_row->outside_permanent,
            //     'outside_probationary'  => $query_row == null ? 0 : $query_row->outside_probationary,
            //     'outside_contractuals'   => $query_row == null ? 0 : $query_row->outside_contractuals,  
            //     'outside_project_based' =>  $query_row == null ? 0 : $query_row->outside_project_based,
            //     'outside_seasonal'      => $query_row == null ? 0 : $query_row->outside_seasonal,
            //     'outside_job_order'     => $query_row == null ? 0 : $query_row->outside_job_order,
            //     'outside_mgt'           => $query_row == null ? 0 : $query_row->outside_mgt,
            //     'inside_total'          =>  $query_row == null ? 0 : $this->total_inside($query_row),
            //     'outside_total'         =>  $query_row == null ? 0 : $this->total_outside($query_row),
            // );
    
            return $arr;
          
        }
    


    // public function get_survey($id,$year){

        
    //     $query_survey   = $this->customRepository->q_get_where($this->conn,array('establishment_id' => $id,'year' => $year),$this->survey_table);
    //     $count          = $query_survey->count();
    //     $query_row      = $count == 0 ? null : $query_survey->first();

    //     $row = array(                    
    //         'inside_permanent'       => $query_row == null ? 0 :  $query_row->inside_permanent,
    //         'inside_probationary'    => $query_row == null ? 0 : $query_row->inside_probationary,
    //         'inside_contractuals'     => $query_row == null ? 0 :   $query_row->inside_contractuals,
    //         'inside_project_based'   => $query_row == null ? 0 : $query_row->inside_project_based,
    //         'inside_seasonal'        =>  $query_row == null ? 0 :   $query_row->inside_seasonal,
    //         'inside_job_order'       =>  $query_row == null ? 0 :   $query_row->inside_job_order,
    //         'inside_mgt'             =>  $query_row == null ? 0 :   $query_row->inside_mgt,
    //         'outside_permanent'     =>  $query_row == null ? 0 : $query_row->outside_permanent,
    //         'outside_probationary'  => $query_row == null ? 0 : $query_row->outside_probationary,
    //         'outside_contractuals'   => $query_row == null ? 0 : $query_row->outside_contractuals,  
    //         'outside_project_based' =>  $query_row == null ? 0 : $query_row->outside_project_based,
    //         'outside_seasonal'      => $query_row == null ? 0 : $query_row->outside_seasonal,
    //         'outside_job_order'     => $query_row == null ? 0 : $query_row->outside_job_order,
    //         'outside_mgt'           => $query_row == null ? 0 : $query_row->outside_mgt,
    //         'inside_total'          =>  $query_row == null ? 0 : $this->total_inside($query_row),
    //         'outside_total'         =>  $query_row == null ? 0 : $this->total_outside($query_row),
    //     );

    //     return $row;
      
    // }

    public function Submit_Survey($row){


        $where = array('establishment_id' => $row['establishment_id'], 'year' => $row['year']);

        $row = array(    
            'establishment_id' => $row['establishment_id'],
            'year' => $row['year']  ,             
            'inside_permanent'      => $row['inside_permanent'],
            'inside_probationary'   => $row['inside_probationary'],
            'inside_contractuals'   => $row['inside_contractuals'],
            'inside_project_based'  => $row['inside_project_based'],
            'inside_seasonal'       => $row['inside_seasonal'],
            'inside_job_order'      => $row['inside_job_order'],
            'inside_mgt'            => $row['inside_mgt'],
            'outside_permanent'     => $row['outside_permanent'],
            'outside_probationary'  => $row['outside_probationary'],
            'outside_contractuals'  => $row['outside_contractuals'],  
            'outside_project_based' => $row['outside_project_based'],
            'outside_seasonal'      => $row['outside_seasonal'],
            'outside_job_order'     => $row['outside_job_order'],
            'outside_mgt'           => $row['outside_mgt'],
        );

        $count = $this->customRepository->q_get_where($this->conn,$where,$this->survey_table)->count();
        if($count > 0 ) {
            $user = $this->customRepository->update_item($this->conn,$this->survey_table,$where,$row);
        }else {
            $user = $this->customRepository->insert_item($this->conn,$this->survey_table,$row);
        }

        // $user = $this->customRepository->update_item($this->conn,$this->survey_table,$where,$row);
        return $user;


    }

    function total_inside($query_row){
        return $query_row->inside_permanent + $query_row->inside_probationary + $query_row->inside_contractuals + $query_row->inside_project_based + $query_row->inside_seasonal + $query_row->inside_job_order + $query_row->inside_mgt;
    }

    function total_outside($query_row){
        return $query_row->outside_permanent + $query_row->outside_probationary + $query_row->outside_contractuals + $query_row->outside_project_based + $query_row->outside_seasonal + $query_row->outside_job_order + $query_row->outside_mgt;
    }

    public function establishment_full_address($row){
        
        $street     = $row->street == NULL ? ' ' : $row->street.' , ';
        $barangay   = $row->barangay == NULL ? ' ' : $row->barangay;
        return $street.$barangay;        
    }


}
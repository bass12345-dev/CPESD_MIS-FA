<?php

namespace App\Repositories\lls;

use Illuminate\Support\Facades\DB;

class EmployeeQuery
{
    public function q_search($conn,$search){
        $rows = DB::connection($conn)->table('employees as employees')
        ->select(   
                    //Employee
                    'employees.employee_id as employee_id', 
                    'employees.first_name as first_name', 
                    'employees.middle_name as middle_name', 
                    'employees.last_name as last_name', 
                    'employees.extension as extension',
        )
        ->where(DB::raw("concat(employees.first_name,' ', employees.last_name)"), 'LIKE', "%" . $search . "%")
        ->orderBy('employees.first_name', 'desc')->get();
        return $rows;
    }

    public function get_employee_survey_by_year_inside($conn,$es_id,$year,$nature,$default_city){

      $rows = DB::connection($conn)->table('establishment_employee as establishment_employee')
        ->leftJoin('employees', 'employees.employee_id', '=', 'establishment_employee.employee_id')
        ->leftJoin('employment_status', 'employment_status.employ_stat_id', '=', 'establishment_employee.status_of_employment_id')
        ->select(   
        'employees.city as city',
      )
      ->where('establishment_employee.establishment_id', $es_id)
      ->whereYear('establishment_employee.start_date',$year)
      ->where('establishment_employee.nature_of_employment',$nature)
      ->where('employment_status.employ_stat_id',5)
      ->where('establishment_employee.level_of_employment','rank_and_file')
      ->where('city',$default_city)
      ->count();
     
      return $rows;

    }


    public function get_employee_survey_by_year_outside($conn,$es_id,$year,$nature,$default_city){

      $rows = DB::connection($conn)->table('establishment_employee as establishment_employee')
        ->leftJoin('employees', 'employees.employee_id', '=', 'establishment_employee.employee_id')
        ->leftJoin('employment_status', 'employment_status.employ_stat_id', '=', 'establishment_employee.status_of_employment_id')
        ->select(   
        'employees.city as city',
      )
      ->where('establishment_employee.establishment_id', $es_id)
      ->whereYear('establishment_employee.start_date',$year)
      ->where('establishment_employee.nature_of_employment',$nature)
      ->where('employment_status.employ_stat_id',5)
      ->where('establishment_employee.level_of_employment','rank_and_file')
      ->where('city','!=',$default_city)
      ->count();
      return $rows;

    }

    public function get_employee_information($conn,$id){

        $rows = DB::connection($conn)->table('establishment_employee as establishment_employee')
        ->leftJoin('positions', 'positions.position_id', '=', 'establishment_employee.position_id')
        ->leftJoin('establishments', 'establishments.establishment_id', '=', 'establishment_employee.establishment_id')
        ->leftJoin('employment_status', 'employment_status.employ_stat_id', '=', 'establishment_employee.status_of_employment_id')
        ->select(   
        //Establishment
        'establishments.establishment_name as establishment_name',
        'establishments.establishment_id as establishment_id',
        //Position
        'positions.position as position',
        //Status
        'employment_status.status as status',
        //Nature of Employment
        'establishment_employee.employee_id as employee_id',
        'establishment_employee.nature_of_employment as nature_of_employment',
        'establishment_employee.year_employed as year_employed',
        'establishment_employee.level_of_employment as level_of_employment'
      )
      ->where('establishment_employee.employee_id', $id)
      ->orderBy('establishment_employee.estab_emp_id', 'desc')
      ->get();
    
    return $rows;

    }

    public function get_establishment_employee($conn,$id){

        $rows = DB::connection($conn)->table('establishment_employee as establishment_employee')
        ->leftJoin('employees', 'employees.employee_id', '=', 'establishment_employee.employee_id')
        ->leftJoin('positions', 'positions.position_id', '=', 'establishment_employee.position_id')
        ->leftJoin('employment_status', 'employment_status.employ_stat_id', '=', 'establishment_employee.status_of_employment_id')
        ->select(   
        'establishment_employee.estab_emp_id as estab_emp_id',
        //User
        'employees.first_name as first_name',
        'employees.middle_name as middle_name',
        'employees.last_name as last_name',
        'employees.extension as extension',
        'employees.province as province',
        'employees.city as city',
        'employees.barangay as barangay',
        'employees.street as street',
        //Position
        'positions.position_id as position_id',
        'positions.position as position',
        //Status
        'employment_status.employ_stat_id as employ_stat_id',
        'employment_status.status as status',
        //Nature of Employment
        'establishment_employee.employee_id as employee_id',
        'establishment_employee.nature_of_employment as nature_of_employment',
        'establishment_employee.start_date as start_date',
        'establishment_employee.end_date as end_date',
        'establishment_employee.level_of_employment as level_of_employment'
      )
      ->where('establishment_employee.establishment_id', $id)
      ->orderBy('employees.first_name', 'asc')
      ->get();
    
    return $rows;

    }   

  
  public function count_inside($conn,$es_id,$date,$default_city){

    $rows = DB::connection($conn)->table('establishment_employee as establishment_employee')
    ->leftJoin('employees', 'employees.employee_id', '=', 'establishment_employee.employee_id')
    ->leftJoin('employment_status', 'employment_status.employ_stat_id', '=', 'establishment_employee.status_of_employment_id')
    ->select(   
      'employees.city as city',
    )
    ->where('establishment_employee.establishment_id', $es_id)
    ->where('city', $default_city)
    ->where('employment_status.employ_stat_id',5)
    ->whereDate('establishment_employee.start_date', '<=', $date)
    ->where('establishment_employee.level_of_employment','rank_and_file')
    ->count();
    return $rows;

  }

  public function count_outside($conn,$es_id,$date,$default_city){

    $rows = DB::connection($conn)->table('establishment_employee as establishment_employee')
    ->leftJoin('employees', 'employees.employee_id', '=', 'establishment_employee.employee_id')
    ->leftJoin('employment_status', 'employment_status.employ_stat_id', '=', 'establishment_employee.status_of_employment_id')
    ->select(   
      'employees.city as city',
    )
    ->where('establishment_employee.establishment_id', $es_id)
    ->where('city','!=',$default_city)
    ->where('employment_status.employ_stat_id',5)
    ->whereDate('establishment_employee.start_date', '<=', $date)
    ->where('establishment_employee.level_of_employment','rank_and_file')
    ->count();
    return $rows;

  }
    

    
}
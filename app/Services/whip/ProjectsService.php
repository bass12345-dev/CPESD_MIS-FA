<?php

namespace App\Services\whip;

use App\Repositories\CustomRepository;
use Carbon\Carbon;

class ProjectsService
{
    
    protected $conn;
    protected $customRepository;
    protected $projects_table;
    public function __construct(CustomRepository $customRepository){
        $this->conn                 = config('app._database.lls_whip');
        $this->customRepository     = $customRepository;
        $this->projects_table       = 'projects';
    }
    

    //REGISTER PROJECT
    public function registerProj(array $userData)
    {

        $items = array(
            'contractor_id'         => $userData['contractor_id'],
            'project_title'         => $userData['project_title'],
            'project_cost'          => $userData['project_cost'],
            'street'                => $userData['street'],
            'barangay'              => $userData['barangay'],
            'city'                  => $userData['city'],
            'province'              => $userData['province'],
            'created_on'            => Carbon::now()->format('Y-m-d H:i:s'),
            
        );
        $user = $this->customRepository->insert_item($this->conn,$this->projects_table,$items);
        return $user;
    }



    
}
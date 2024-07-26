<?php

namespace App\Services\user;

use App\Repositories\CustomRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\IpUtils;
use Illuminate\Support\Facades\Http;

class USerService
{
    
    protected $conn;
    protected $customRepository;
    protected $user_table;
    protected $login_history_table;
    protected $request;

    public function __construct(CustomRepository $customRepository, Request $request){
        $this->conn                 = config('app._database.users');
        $this->customRepository     = $customRepository;
        $this->request              = $request;
        $this->user_table           = 'users';
        $this->login_history_table  = 'logged_in_history';

    }
    

    //REGISTER USER
    public function LoginUser(array $auth)
    {
        $response = array();
        if ($auth['g-recaptcha-response'] != null) {

            $url = "https://www.google.com/recaptcha/api/siteverify";
            $body = [
                            'secret' => config('services.recaptcha.secret'),
                            'response' => $auth['g-recaptcha-response'],
                            'remoteip' => IpUtils::anonymize($this->request->ip()) //anonymize the ip to be GDPR compliant. Otherwise just pass the default ip address
                    ];
            $response = Http::asForm()->post($url, $body);
            $result = json_decode($response);
            if ($response->successful() && $result->success == true) {  
                $user = $this->customRepository->q_get_where($this->conn,array('username' => $auth['username']),$this->user_table);
                if ($user->count() > 0) {
                    $user_row = $user->first();
                    if ($user_row->user_status == 'active') {
                        $check = password_verify($auth['password'], $user_row->password);
                        if ($check) {

                            $response = [
                                'response' => true,
                                'message' => 'Success'
                            ];
                            $this->set_session($user_row);
                            $this->store_login_history($user_row);
                        }else {
                            $response = [
                                'response' => false,
                                'message' => 'Invalid Password.'
                            ];
                        }
                        
                    }else {

                        $response = [
                            'response' => false,
                            'message' => 'Please Contact Administrator to activate your Account!!!'
                        ];

                    }  

                }else{

                    $response = [
                        'response' => false,
                        'message' => 'Invalid Username.'
                    ];
                }
                

            }else{
                $response = [
                    'response' => false,
                    'message' => 'Please Complete the Recaptcha Again to proceed.'
                ];
            }
        }else{
            $response = [
                'response' => false,
                'message' => 'Please Complete the Recaptcha Again to proceed.'
            ];
        }



        return $response;
    }


    private function set_session($user_row){
        
        $this->request->session()->put(
            array(
                'name'              => $user_row->first_name,
                'user_id'           => $user_row->user_id,
                'isLoggedIn'        => true,
                'user_type'         => $user_row->user_type,
                'is_receiver'       => $user_row->is_receiver,
                'is_oic'            => $user_row->is_oic == 'yes' ? true : false
            )
        );
    }

    private function store_login_history($user_row){

        $items = ['web_type'=> 'cpesd-mis','user_id'=>$user_row->user_id,'logged_in_date'=> Carbon::now()->format('Y-m-d H:i:s') ];
        $this->customRepository->insert_item($this->conn,$this->login_history_table,$items);
    }

    public function user_full_name($key){

        return $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name . ' ' . $key->extension;

    }

    public function full_address($row){
        
        $province   = $row->province == NULL ? '' :  explode("-", $row->province)[1];
        $city       = $row->city == NULL ? '' : explode("-", $row->city)[1].' , ';
        $barangay   = $row->barangay == NULL ? '' : explode("-", $row->barangay)[1].' , ';
        $street     = $row->street == NULL ? '' : $row->street.' , ';

        return $street.''.$barangay.''.$city.''.$province;
    }


    public function get_systems(array $row_sys){

            $systems =  config('app._systems');
            $system_array = [];
            $system_names = [];
            foreach ($systems as $key) {
             array_push($system_array,$key[0]);
            }
            foreach ($systems as $key) {
             array_push($system_names,$key[1]);
            }
            $d = array_map(null,$row_sys, $system_array, $system_names);
            return $d;
          
    
         
    }
    
}
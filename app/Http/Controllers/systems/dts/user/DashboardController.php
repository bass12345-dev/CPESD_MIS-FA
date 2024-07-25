<?php

namespace App\Http\Controllers\systems\dts\user;
use App\Http\Controllers\Controller;
use App\Services\dts\user\DashboardService;
use Carbon\Carbon;
class DashboardController extends Controller
{
    protected $dashboardService;
    protected $conn;
    public function __construct(DashboardService $dashboardService){
        $this->conn                 = config('app._database.dts');
        $this->dashboardService     = $dashboardService;
    }
 
    public function index(){
        $data['title']  = 'User Dashboard';
        $date_now       = Carbon::now()->format('Y-m-d');
        $data['count']  = $this->dashboardService->user_dashboard_display();
        $data['today'] = Carbon::now()->format('M d Y');
        $data['forwarded_to_users'] = $this->dashboardService->get_forwarded_documents();
        return view('system.dts.user.contents.dashboard.dashboard')->with($data);

    
    }
}

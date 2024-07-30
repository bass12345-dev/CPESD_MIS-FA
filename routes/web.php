<?php

use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\SessionGuard;
use App\Http\Middleware\UserLoginCheck;
use Illuminate\Support\Facades\Route;

//Auth View
Route::get('/', function () {
   $data['title'] = 'CPESD MIS LOGIN';
   return view('system_auth.login')->with($data);
})->middleware(UserLoginCheck::class);
//Auth Login Action
Route::post('/v-u', [App\Http\Controllers\auth\AuthController::class, 'verify_user']);
Route::get('/logout', [App\Http\Controllers\auth\AuthController::class, 'logout']);


Route::get('/home', function () {
   return view('home.index');
})->middleware(SessionGuard::class);



            ////SYSTEM MANAGEMENT


//SYSTEM MANAGEMENT ROUTES
Route::middleware([SessionGuard::class, AdminCheck::class])->prefix('/admin/sysm')->group(function () {
   Route::get("/dashboard",[ App\Http\Controllers\system_management\DashboardController::class, 'index']);
   Route::get("/login-history",[ App\Http\Controllers\system_management\LoginHistoryController::class, 'index']);
   //Manage USer
   Route::get("/manage-users",[ App\Http\Controllers\system_management\ManageUserController::class, 'index']);
   Route::get("/user/{id}",[ App\Http\Controllers\system_management\ManageUserController::class, 'view_profile']);
});
//SYSTEM MANAGEMENT ACTIONS
Route::middleware([SessionGuard::class, AdminCheck::class])->prefix('/admin/sysm/act')->group(function () {
   Route::get("/g-a-l-l",[ App\Http\Controllers\system_management\LoginHistoryController::class, 'get_all_login_logs']);
   //Manage User
   Route::get("/g-a-u",[ App\Http\Controllers\system_management\ManageUserController::class, 'get_all_users']);
   //System Authorization
   Route::post("/a-s",[ App\Http\Controllers\system_management\ManageUserController::class, 'authorize_system']);
});


            ////LABOR LOCALIZATION AND WHIP

//ADMIN SECTION LLS WHIP
Route::middleware([SessionGuard::class, AdminCheck::class])->prefix('/admin')->group(function () {
   //LLS
   Route::get("/lls/dashboard",[ App\Http\Controllers\systems\lls_whip\lls\DashboardController::class, 'index']);
      //ESTABLISHMENT
      Route::get("/lls/add-new-establishment",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'add_new_establishment_view']);
      Route::get("/lls/establishments-list",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'establishments_list_view']);
      Route::get("/lls/establishment/{id}",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'establishments_view']);
      //EMPLOYEES
      Route::get("/lls/employees-record",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'index']);
      Route::get("/lls/employee/{id}",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'view_employee']);
      // POSITION
      Route::get("/lls/establishments-positions",[App\Http\Controllers\systems\lls_whip\lls\PositionsController::class, 'index']);
      // Employment Status
      Route::get("/lls/employment-status-list",[App\Http\Controllers\systems\lls_whip\lls\EmploymentStatusController::class, 'index']);
      //Reports
      Route::get("/lls/compliant-reports",[App\Http\Controllers\systems\lls_whip\lls\CompliantController::class, 'index']);


      Route::get("/sample",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'sample']);

   //WHIP
      Route::get("/whip/dashboard",[App\Http\Controllers\systems\lls_whip\whip\DashboardController::class, 'index']);
      //Contractor
      Route::get("/whip/add-new-contractor",[App\Http\Controllers\systems\lls_whip\whip\ContractorController::class, 'add_new_contractor']);
      Route::get("/whip/contractors-list",[App\Http\Controllers\systems\lls_whip\whip\ContractorController::class, 'contractors_list']);
      Route::get("/whip/contractor-information/{id}",[App\Http\Controllers\systems\lls_whip\whip\ContractorController::class, 'contractor_information']);

      //Projects
      Route::get("/whip/projects-list",[App\Http\Controllers\systems\lls_whip\whip\ProjectsController::class, 'index']);

      //EMPLOYEES
      Route::get("/whip/employees-record",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'index']);

      


});
       
//ACTIONS LLS WHIP
Route::middleware([SessionGuard::class])->prefix('/admin/act')->group(function () {
   //LLS ACTIONS
   //Establishment
      Route::post("/lls/insert-es",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'insert_es']);
      Route::get("/lls/g-a-e",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'get_all_establishment']);
      Route::post("/lls/u-e",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'update_establishment']);
      Route::post("/lls/s-s",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'submit_survey']);
      Route::post("/lls/d-e",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'delete_establishment']);
   //POSITION
      Route::get("/lls/a-p",[App\Http\Controllers\systems\lls_whip\lls\PositionsController::class, 'get_all_positions']);
      Route::post("/lls/i-u-p",[App\Http\Controllers\systems\lls_whip\lls\PositionsController::class, 'insert_update_position']);
      Route::post("/lls/d-p",[App\Http\Controllers\systems\lls_whip\lls\PositionsController::class, 'delete_position']);
   //EMPLOYMENT STATUS
      Route::get("/lls/a-e-s",[App\Http\Controllers\systems\lls_whip\lls\EmploymentStatusController::class, 'get_all_status']);
      Route::post("/lls/i-u-e-s",[App\Http\Controllers\systems\lls_whip\lls\EmploymentStatusController::class, 'insert_update_status']);
      Route::post("/lls/d-s",[App\Http\Controllers\systems\lls_whip\lls\EmploymentStatusController::class, 'delete_status']);
   //Employees
      Route::post("/lls/g-a-em",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'get_all_employees']);
      Route::post("/lls/i-e",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'insert_employee']);
      Route::post("/lls/g-e-i",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'get_employee_information']);
      Route::post("/lls/d-em",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'delete_employee']);
   //Establishment Employee
      Route::post("/lls/i-u-e-e",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'insert_or_update_establishment_employee']);  
      Route::post("/lls/d-e-e",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'delete_establishment_employee']);  
      Route::post("/lls/g-a-e-e",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'get_establishment_employees']);  
      Route::get("/lls/search-query",[App\Http\Controllers\systems\lls_whip\lls\EmployeeController::class, 'search_query']);  
   //SURVEY
   Route::post("/lls/g-e-s",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'get_survey_by_year']);
      // Route::post("/lls/get-survey",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'get_survey_by_year']);

   //COMPLIANT REPORTS
   Route::post("/lls/generate-compliant-report",[App\Http\Controllers\systems\lls_whip\lls\EstablishmentController::class, 'generate_compliant_report']);
   //Dashboard
   Route::get("/lls/c-b-g-i",[App\Http\Controllers\systems\lls_whip\lls\DashboardController::class, 'count_all_employees_by_gender_inside']);
   Route::get("/lls/c-b-g-o",[App\Http\Controllers\systems\lls_whip\lls\DashboardController::class, 'count_all_employees_by_gender_outside']);

   //ACTIONS WHIP
   //Contractor
      Route::post("/whip/insert-contr",[App\Http\Controllers\systems\lls_whip\whip\ContractorController::class, 'insert_contr']);
      Route::get("/whip/g-a-c",[App\Http\Controllers\systems\lls_whip\whip\ContractorController::class, 'get_all_contractors']);
   //Projects
      Route::post("/whip/insert-proj",[App\Http\Controllers\systems\lls_whip\whip\ProjectsController::class, 'insert_project']);
      Route::get("/whip/g-a-p",[App\Http\Controllers\systems\lls_whip\whip\ProjectsController::class, 'get_all_projects']);
      Route::get("/whip/g-c-p/{id}",[App\Http\Controllers\systems\lls_whip\whip\ProjectsController::class, 'get_contractor_projects']);
});

      /// DOCUMENT TRACKING SYSTEM

//USER SECTION DTS
Route::middleware([SessionGuard::class])->prefix('/user')->group(function () {
   Route::get("/dts/dashboard",[ App\Http\Controllers\systems\dts\user\DashboardController::class, 'index']);
   Route::get("/dts/my-documents",[ App\Http\Controllers\systems\dts\user\MyDocumentsController::class, 'index']);
});


//USER DTS ACTION
Route::middleware([SessionGuard::class])->prefix('/user/act')->group(function () {

   //My Documents
   Route::get("/dts/g-m-d",[App\Http\Controllers\systems\dts\user\MyDocumentsController::class, 'get_my_documents']);
     

  
});

          
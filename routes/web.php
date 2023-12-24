<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Position\PositionController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Salary\SalaryController;
use App\Http\Controllers\Salary_calculation\SalarycalcController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('login');
});

 Route::post('login',[LoginController::class,'login'])->name('login');

 Route::group(['middleware' => ['auth']], function(){
    Route::get('logout',[LoginController::class,'logout']);
    Route::match(['get', 'post'],'dashboard',[HomeController::class,'index']);

    // department
    Route::get('department',[DepartmentController::class,'index']);
    Route::get('create-department',[DepartmentController::class,'create']);
    Route::post('insert-department',[DepartmentController::class,'store']);
    Route::get('edit-department/{id}',[DepartmentController::class,'edit']);
    Route::post('update-department',[DepartmentController::class,'update']);
    Route::get('delete-department/{id}',[DepartmentController::class,'destroy']);

    //position
    Route::get('position',[PositionController::class,'index']);
    Route::get('create-position',[PositionController::class,'create']);
    Route::post('insert-position',[PositionController::class,'store']);
    Route::get('edit-position/{id}',[PositionController::class,'edit']);
    Route::post('update-position',[PositionController::class,'update']);
    Route::get('delete-position/{id}',[PositionController::class,'destroy']);

    //employee
    Route::get('employee',[EmployeeController::class,'index']);
    Route::get('create-employee',[EmployeeController::class,'create']);
    Route::post('insert-employee',[EmployeeController::class,'store']);
    Route::get('edit-employee/{id}',[EmployeeController::class,'edit']);
    Route::post('update-employee',[EmployeeController::class,'update']);
    Route::get('delete-employee/{id}',[PositionController::class,'destroy']);

    //attendance
     Route::get('attendance',[AttendanceController::class,'index']);
     Route::get('create-attendance',[AttendanceController::class,'create']);
     Route::post('insert-attendance',[AttendanceController::class,'store']);
     Route::get('delete-attendance/{id}',[AttendanceController::class,'destroy']);
    // Route::post('attendance-check',[AttendanceController::class,'attendanceCheck']);

      //salary
      Route::get('salary',[SalaryController::class,'index']);
      Route::get('create-salary',[SalaryController::class,'create']);
      Route::post('insert-salary',[SalaryController::class,'store']);
      Route::get('edit-salary/{id}',[SalaryController::class,'edit']);
      Route::post('update-salary',[SalaryController::class,'update']);
      Route::get('delete-salary/{id}',[SalaryController::class,'destroy']);

      // salary calculation
      Route::get('salarycalc',[SalarycalcController::class,'index']);
      Route::get('salary-calculation',[SalarycalcController::class,'salary_calculation']);
      Route::post('insert-salarycalc',[SalarycalcController::class,'insert_salary_calc']);
    
 });





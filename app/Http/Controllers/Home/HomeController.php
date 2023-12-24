<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Salary;

class HomeController extends Controller
{
    public function index(Request $request){
        // Get the current month and year
       
         $input = $request->all(); 
        if(!empty($input['start_date']) && !empty($input['end_date'])){
            $startOfMonth = $input['start_date'].' 00:00:00';
            $endOfMonth = $input['end_date'].' 23:59:59';
        }else{
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
        }
        

        $employee_id = DB::table('attendance')->distinct()->pluck('employee_id');

        $attendanceSummary = [];
       
        foreach ($employee_id as $employeeID) {

            $month = date('m',strtotime($startOfMonth));
            $year = date('Y',strtotime($startOfMonth));

            $employee = Employee::find($employeeID);

            $salary = Salary::where('position_id',$employee->position_id)->first();


            $myTime = strtotime(date('d/m/Y',strtotime($startOfMonth)));
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
            $workDays = 0;
            
            while($daysInMonth > 0)
            {
                $day = date("D", $myTime); // Sun - Sat
                if($day != "Sun" && $day != "Sat")
                    $workDays++;
            
                $daysInMonth--;
                $myTime += 86400;
            }

            $presentDays = DB::table('attendance')
                            ->where('employee_id', $employeeID)
                            ->whereNotNull('in_time')
                            ->whereNotNull('out_time')
                            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                            ->count();
            $dailySalary = $salary->gross_salary /  $workDays;
            $totalSalary = $dailySalary * $presentDays;

            $days=array();
            for($d=1; $d<=31; $d++) {
                $time=mktime(12, 0, 0, $month, $d, $year);  
              
                if(date('m', $time)==$month && date('w', $time)>0 && date('w', $time)<6) {

                    $attendance = DB::table('attendance')
                    ->where('employee_id', $employeeID)
                    ->whereDate('created_at', date('Y-m-d', $time))
                    ->first();
        
                    $days[]= [
                        'date' => date('Y-m-d', $time),
                        'in_time' => isset($attendance->in_time) ? date('H:i:s',strtotime($attendance->in_time)):'',
                        'out_time' => isset($attendance->out_time) ? date('H:i:s',strtotime($attendance->out_time)):''
                    ];
                   
                }
            }
            $attendanceSummary[] = [
               'employee_name' => $employee->name,
               'presentDays' => $presentDays,
               'absentDays' => $workDays - $presentDays,
               'working_day' => $workDays,
               'total_salary' => $totalSalary,
               'data' => $days,
              
            ];
        
        }

        $month = date('m',strtotime($startOfMonth));
        $year = date('Y',strtotime($startOfMonth));

        $days=array();

        for($d=1; $d<=31; $d++) {
            $time=mktime(12, 0, 0, $month, $d, $year);  
        
            if(date('m', $time)==$month && date('w', $time)>0 && date('w', $time)<6) {
                $days[]= date('d-m', $time);
            }
        }

       return view('home.index', ['attendanceSummary' => $attendanceSummary,'days' => $days]);

    }

}

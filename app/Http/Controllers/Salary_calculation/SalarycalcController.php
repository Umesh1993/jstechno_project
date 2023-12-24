<?php

namespace App\Http\Controllers\Salary_calculation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary_calculation;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Salary;
use DB;

class SalarycalcController extends Controller
{
    public function index(){
        $salarycalc = Salary_calculation::with('employee')->get();
        return view('salary_calculation.index',compact('salarycalc'));
    }

    public function salary_calculation(Request $request){

        $startOfMonth = Carbon::now()->startOfMonth()->subMonth();
        $endOfMonth = Carbon::now()->subMonth()->endOfMonth();

        $calc_date = date('Y-m-d',strtotime($startOfMonth)).' to '.date('Y-m-d',strtotime($endOfMonth));
        
        $salarycalc = Salary_calculation::where('calculation_date',$calc_date)->first();
        
        if(empty($salarycalc)){
            
        $employee = Employee::get();

        $salary_calculation = [];
        if(!empty($employee)){
            foreach($employee as $e){
                $salary = Salary::where('position_id',$e->position_id)->first();

                $month = date('m',strtotime($startOfMonth));
                $year = date('Y',strtotime($startOfMonth));
    
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
                                ->where('employee_id', $e->id)
                                ->whereNotNull('in_time')
                                ->whereNotNull('out_time')
                                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                                ->count();

                $dailySalary = $salary->gross_salary /  $workDays;
                $totalSalary = $dailySalary * $presentDays;

                $attendanceSummary[] = [
                    'employee_id' => $e->id,
                    'employee_name' => $e->name,
                    'presentDays' => $presentDays,
                    'absentDays' => $workDays - $presentDays,
                    'working_day' => $workDays,
                    'total_salary' => $totalSalary,
                    'status' => 'Pending',
                    'start_month' => date('Y-m-d',strtotime($startOfMonth)),
                    'end_month' => date('Y-m-d',strtotime($endOfMonth))
                   
                 ];
           
            }
        }    

         return view('salary_calculation.add',compact('attendanceSummary'));

        }else{
            return redirect('salarycalc')->withErrors(['msg' => 'Salary calculation has been completerd for previous month.']);
        }

               
    }

    public function insert_salary_calc(Request $request){
        $input = $request->all();

      

        if(!empty($input['salary_calc'])){
            foreach($input['salary_calc'] as $e){
                $salary_calc = new Salary_calculation();
                $salary_calc->employee_id = $e['employee_id'];
                $salary_calc->calculation_date = $e['calculate_date'];
                $salary_calc->status = 'Completed';
                $salary_calc->save();
            }

         return redirect('salarycalc');

        }else{
            return redirect('salary-calculation')->withErrors(['msg' => 'Something went wrong.']);
        }
    }

}

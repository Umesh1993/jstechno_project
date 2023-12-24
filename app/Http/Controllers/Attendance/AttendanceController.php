<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index(){

        $attendance = Attendance::with('employee')->get();
        return view('attendance.index',compact('attendance'));
    }

    public function create(){
        $attendance = Attendance::get();
        $employee = Employee::get();
        return view('attendance.add',compact('attendance','employee'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'employee_id' => 'required',
            'reason' => 'required',
            'datetime'=> 'required'
        ]);

        $input = $request->all();

        $attendance = Attendance::where('employee_id',$input['employee_id'])->whereDate('created_at',date('Y-m-d'))->first();
        if(empty($attendance)){
            $insert = new Attendance();
            $insert->employee_id = $input['employee_id'];
    
            $datetime = str_replace('/','-',$input['datetime']);
            if($input['reason'] == 'in'){
                $insert->in_time = date('Y-m-d H:i:s',strtotime($datetime));
            }else{
                $insert->in_time = NULL;
            }
            $data = $insert->save();
        }else{
            $update = Attendance::find($attendance->id);
            $update->employee_id = $input['employee_id'];
    
            $datetime = str_replace('/','-',$input['datetime']);
            if($input['reason'] == 'out'){
                $update->out_time = date('Y-m-d H:i:s',strtotime($datetime));
            }else{
                $update->out_time = NULL;
            }
            $data = $update->save();
        }
        
        if($data){
            return redirect('attendance');
        } else {
            return redirect('create-attendance')->withErrors(['msg' => 'Something went wrong.']);
        }
    }

    public function destroy($id){
        Attendance::find($id)->delete();
        return redirect('attendance');
    }

    // public function attendanceCheck(Request $request){
    //     $input = $request->all();
    //    dd($input);
    //     $attendance = Attendance::where('employee_id',$input['employee_id'])->whereDate('created_at',date('Y-m-d'))->first();
    //     $html = '';
    //     if(!empty($attendance)){
    //       $html.='<option value="out">OUT</option>';
    //     }else{
    //         $html.='<option value="in">IN</option>
    //         <option value="out">OUT</option>';
    //     }
    //     return response()->json(['success' => true,'html' => $html], 200);
    // }
}

<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Position;
use App\Models\Employee;

class SalaryController extends Controller
{
    public function index(){

        $salary = Salary::with(['position'])->get();
        return view('salary.index',compact('salary'));
    }

    public function create(){
        $position = Position::get();
        return view('salary.add',compact('position'));
    }

    public function store(Request $request){
        $input = $request->all();
     
        $salary = new Salary();
        $salary->position_id = $input['position_id'];
        $salary->basic_salery = $input['basic_salary'];
        $salary->hra = $input['hra'];
        $salary->da = $input['da'];
        $salary->gross_salary = $input['gross_salary'];
        $salary->other_allowances = $input['other_allowances'];
        $data = $salary->save();
        if($data){
            return redirect('salary');
        } else {
            return redirect('create-salary')->withErrors(['msg' => 'Something went wrong.']);
        }
    }

    public function edit($id){
        $salary = Salary::find($id);
        $position = Position::get();
        return view('salary.edit',compact('salary','position'));
    }

    public function update(Request $request){
        $input = $request->all();
     
       
        $salary = Salary::find($input['id']);
        $salary->position_id = $input['position_id'];
        $salary->basic_salery = $input['basic_salary'];
        $salary->hra = $input['hra'];
        $salary->da = $input['da'];
        $salary->gross_salary = $input['gross_salary'];
        $salary->other_allowances = $input['other_allowances'];
        $data = $salary->save();
        if($data){
            return redirect('salary');
        } else {
            return redirect('edit-salary/'.$input['id']);
        }
    }

    public function destroy($id){
        Salary::find($id)->delete();
        return redirect('salary');
    }

   
}

<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;

class EmployeeController extends Controller
{
    public function index(){

        $employee = Employee::with(['department','position'])->get();
        return view('employee.index',compact('employee'));
    }

    public function create(){
        $department = Department::get();
        $position = Position::get();
        return view('employee.add',compact('department','position'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'email'=> 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        $input = $request->all();
     
        $employee = new Employee();
        $employee->name = $input['name'];
        $employee->department_id = $input['department_id'];
        $employee->position_id = $input['position_id'];
        $employee->email = $input['email'];
        $employee->phone_number = $input['phone_number'];
        $employee->address = $input['address'];
        $data = $employee->save();
        if($data){
            return redirect('employee');
        } else {
            return redirect('create-employee')->withErrors(['msg' => 'Something went wrong.']);
        }
    }

    public function edit($id){
        $employee = Employee::find($id);
        $department = Department::get();
        $position = Position::get();
        return view('employee.edit',compact('employee','department','position'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'email'=> 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        $input = $request->all();

        $employee = Employee::find($input['id']);
        $employee->name = isset($input['name']) ? $input['name']: $employee->name;
        $employee->department_id = isset($input['department_id']) ? $input['department_id']:$employee->department_id;
        $employee->position_id = isset($input['position_id']) ? $input['position_id']:$employee->position_id;
        $employee->email = isset($input['email']) ? $input['email']:$employee->email;
        $employee->phone_number = isset($input['phone_number']) ? $input['phone_number']:$employee->phone_number;
        $employee->address = isset($input['address']) ? $input['address']:$employee->address;
        $data = $employee->save();
        if($data){
            return redirect('employee');
        } else {
            return redirect('edit-employee/'.$input['id']);
        }
    }

    public function destroy($id){
        Employee::find($id)->delete();
        return redirect('employee');
    }
}

<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index(){

        $department = Department::get();
        return view('department.index',compact('department'));
    }

    public function create(){
        return view('department.add');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $input = $request->all();

        $department = new Department();
        $department->name = $input['name'];
        $data = $department->save();
        if($data){
            return redirect('department');
        } else {
            return redirect('create-department')->withErrors(['msg' => 'Something went wrong.']);
        }
    }

    public function edit($id){
        $department = Department::find($id);
        return view('department.edit',compact('department'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $input = $request->all();

        $department = Department::find($input['id']);
        $department->name = isset($input['name']) ? $input['name']:'';
        $data = $department->save();
        if($data){
            return redirect('department');
        } else {
            return redirect('edit-department/'.$input['id']);
        }
    }

    public function destroy($id){
        Department::find($id)->delete();
        return redirect('department');
    }
}

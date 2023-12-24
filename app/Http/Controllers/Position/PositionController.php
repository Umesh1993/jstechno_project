<?php

namespace App\Http\Controllers\Position;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;

class PositionController extends Controller
{
    public function index(){

        $position = Position::with('department')->get();
        return view('position.index',compact('position'));
    }

    public function create(){
        $department = Department::get();
        return view('position.add',compact('department'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'department_id' => 'required',
            'name' => 'required'
        ]);

        $input = $request->all();

        $position = new Position();
        $position->name = $input['name'];
        $position->department_id = $input['department_id'];
        $data = $position->save();
        if($data){
            return redirect('position');
        } else {
            return redirect('create-position')->withErrors(['msg' => 'Something went wrong.']);
        }
    }

    public function edit($id){
        $position = Position::find($id);
        $department = Department::get();
        return view('position.edit',compact('position','department'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'department_id' => 'required',
            'name' => 'required'
        ]);

        $input = $request->all();

        $position = Position::find($input['id']);
        $position->department_id = isset($input['department_id']) ? $input['department_id']:$position->department_id;
        $position->name = isset($input['name']) ? $input['name']:'';
        $data = $position->save();
        if($data){
            return redirect('position');
        } else {
            return redirect('edit-position/'.$input['id']);
        }
    }

    public function destroy($id){
        Position::find($id)->delete();
        return redirect('position');
    }
}

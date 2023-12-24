<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Position;

class Employee extends Model
{
    protected $table="employee";
    use HasFactory;

    public function department(){
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function position(){
        return $this->hasOne(Position::class,'id','position_id');
    }
}

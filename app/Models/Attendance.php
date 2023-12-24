<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Attendance extends Model
{
    protected $table = "attendance";
    use HasFactory;

    public function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
}

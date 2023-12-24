<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Salary_calculation extends Model
{
    protected $table = "salary_calculation";
    use HasFactory;

    public function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
}

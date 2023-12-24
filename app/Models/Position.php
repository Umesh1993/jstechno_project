<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Position extends Model
{
    protected $table = "position";
    use HasFactory;

    public function department(){
        return $this->hasOne(Department::class,'id','department_id');
    }
}

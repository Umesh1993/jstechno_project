<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;

class Salary extends Model
{
    protected $table = "salary";
    use HasFactory;

    public function position(){
        return $this->hasOne(Position::class,'id','position_id');
    }
}

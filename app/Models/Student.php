<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";
    protected $fillable = [
        'student_number',
        'internship_start_date',
        'internship_end_date',
        'user_id',
        'business_id',
    ];

    public function user(){

        return $this->hasOne(User::class,'id','user_id');

    }

    public function business(){

        return $this->hasOne(Business::class,'id','business_id');

    }

}

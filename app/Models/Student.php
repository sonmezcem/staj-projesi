<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Comment\Doc;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";
    protected $fillable = [
        'student_number',
        'internship_start_date',
        'internship_end_date',
        'internship_status',
        'internship_type',
        'user_id',
        'business_id',
    ];

    protected $casts = [
        'expired_at'=>'datetime',
        'internship_start_date' => 'date',
        'internship_end_date' => 'date',
    ];


    public function user(){

        return $this->hasOne(User::class,'id','user_id');

    }

    public function business(){

        return $this->hasOne(Business::class,'id','business_id');

    }

    public function document(){


            return $this->hasMany(Documents::class,'student_number_id','id');

    }
    public function rejection(){


        return $this->hasOne(RejectionReason::class,'student_id','id');

    }

    public function error(){


        return $this->hasMany(Errors::class,'student_id','id');

    }


}

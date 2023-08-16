<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Errors extends Model
{
    use HasFactory;

    protected $table = "errors";
    protected $fillable = [
        'student_id',
        'problem',
        'status',
    ];

    public function error(){

        return $this->belongsTo(Errors::class);

    }


}

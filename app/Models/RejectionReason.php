<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectionReason extends Model
{
    use HasFactory;

    protected $table = "rejection_reason";

    protected $fillable = [
        'student_id',
        'reason',
    ];

    public function rejection(){

        return $this->belongsTo(RejectionReason::class);

    }


}

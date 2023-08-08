<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $table = "documents";

    protected $fillable = [
        'student_number_id',
        'document_type_id',
        'file_path',

    ];

}

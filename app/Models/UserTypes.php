<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class UserTypes extends Model
{
    use HasFactory;
    protected $table = "user_types";
    protected $fillable = [
        'user_type',
        'user_type_name'
    ];
}

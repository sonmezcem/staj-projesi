<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = "businesses";
    protected $fillable = [
        'business_name',
        'business_address',
        'business_phone',
        'quota',
        'applicants',
        'status',
    ];

    public function business(){

        return $this->belongsTo(Business::class);

    }
}

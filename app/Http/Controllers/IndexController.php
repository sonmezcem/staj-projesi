<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Business;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        $officers = User::whereHas("roles", function($q){ $q->where("name", "Yetkili")->where('status', 1); })->get()->take(100);
        //$students = User::whereHas("roles", function($q){ $q->where("name", "Öğrenci")->where('status', 1); })->get()->take(100);
        $status = 1;
        $students = Student::query()
            ->with('user.user', 'business.business')
            ->whereHas('user',  function ($query) use ($status) {
                return $query->where('status', 'LIKE', '%' . $status . '%');
            })
            ->paginate(10);

        //$businesses = Business::all()->take(100);
        $businesses = Business::all()->where('status', 1)->take(100);

        return view('admin.index',compact('officers','students','businesses'));

    }
}

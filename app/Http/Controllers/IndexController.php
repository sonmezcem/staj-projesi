<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Business;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

/*        $roles = Role::all();
        $officers = User::with('roles')
            ->limit(100)
            ->get();*/

        $officers = User::whereHas("roles", function($q){ $q->where("name", "Yetkili")->where('status', 1); })->get()->take(100);
        $students = User::whereHas("roles", function($q){ $q->where("name", "Öğrenci")->where('status', 1); })->get()->take(100);
        $businesses = Business::all()->take(100);

        return view('admin.index',compact('officers','students','businesses'));

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Business;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        $roles = Role::all();
        $users = User::with('roles')->get();
        $businesses = Business::all();

        return view('admin.index',compact('users','businesses'));

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index(){

        $users = User::whereHas("roles", function($q){ $q->where("name", "Yetkili"); })->get();

        return view('admin.officer.index', compact('users'));

    }

    public function create(){
        echo "admin.officer.create";
    }

    public function show(){

    }

    public function edit($id){

        $user = User::find($id);

        return view("admin.officer.edit",compact('user'));

    }

    public function destroy($id){

    }
}

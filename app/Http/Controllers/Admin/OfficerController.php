<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Hash;


class OfficerController extends Controller
{
    public function index(){

        $users = User::whereHas("roles", function($q){ $q->where("name", "Yetkili")->where('status', 1); })->paginate(10);

        return view('admin.officer.index', compact('users'));

    }

    public function create(){

        return view('admin.officer.create');

    }

    public function store(Request $request){

/*        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        exit();*/


        $validated = $request->validate(
            [
                'username' => ['required', 'min:3'],
                'name' => ['required'],
                'surname' => ['required'],
                'major' => ['required', 'min:3'],
                'phone' => ['required', 'phone:tr'],
                'email' => ['required', 'email'],
            ]);

        $data = new User();

        $characters = "abcdefghijklmnoprstuvyzABCDEFGHIJKLMNOPRSTUVYZ0123456789!+$&=";

        $password = substr(str_shuffle($characters),0,9);

        $validated['password'] = $password;

        //buraya email gönderme kodları gelecek...

        $user = User::create([
            'username' => $validated['username'],
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'status' => 1
        ]);

        $officer = Officer::create([
            'officer_id' => $user->id,
            'major' => $validated['major']
        ]);

    }

    public function show(){

        echo "deneme";

    }

    public function update($id, User $user, Request $request){



        if ($request->password == '') {

            $data = $request->validate([
                'name' => ['required'],
                'surname' => ['required'],
                'email' => ['required','email'],
                'phone' => ['phone:TR'],
            ]);
        }
        else {
            $data = $request->validate([
                'name' => ['required'],
                'surname' => ['required'],
                'email' => ['required'],
                'phone' => ['phone:TR'],
                'password' => ['required','confirmed'],
            ]);
        }
        //                'password-confirm' => ['required']

        User::whereId($id)->update([
            'password' => Hash::make($request->password)
        ]);
/*
        $user->where('id', $id)->update($data);

        User::create($request->all($data)*/

        $users = User::whereHas("roles", function($q){ $q->where("name", "Yetkili")->where('status', 1); })->get();
        // $users = User::whereHas("roles", function($q){ $q->where("name", "Yetkili"); })->where("status", 1)->get();


        return back()->with('success','Kullanıcı başarılı bir şekilde düzenlendi!');

    }


    public function edit($id){

        $user = User::find($id);

        return view("admin.officer.edit",compact('user'));

    }


    public function destroy($id, User $user){

        $statusUpdate = ['status' => 0];

        $user->where('id', $id)->update($statusUpdate);

        //User::destroy($id); kullaniciyi siler

        return back()->with('success','Kullanıcı başarılı bir şekilde silindi!');

    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }



}

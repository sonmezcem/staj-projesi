<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        $validated = $request->validate(
            [
                'username' => ['required', 'min:3'],
                'name' => ['required'],
                'surname' => ['required'],
                'major' => ['required', 'min:3'],
                'phone' => ['required', 'phone:tr'],
                'email' => ['required', 'email'],
            ]);

        $characters = "abcdefghijklmnoprstuvyzABCDEFGHIJKLMNOPRSTUVYZ0123456789!+$&=";
        $password = substr(str_shuffle($characters),0,9);
        $validated['password'] = $password;

/*        Mail::from('')
            ->from('deneme@deneme.com', 'Me')
            ->to('cemsonmezapi@gmail.com','cemsonmezapi@gmail.com')
            ->from('')
            ->subject('kullanici bilgileriniz')
        ;*/

        Mail::send('admin.mail' ,compact('validated','password'), function ($message) {
            $message->to('staj@trends.com.tr')->subject('Hesabınız Oluşturuldu');
            $message->from('staj@trends.com.tr', 'Staj Takip Sistemi Yönetim');
        });

        /*
         * $message->to('staj@trends.com.tr')->subject('Hesabınız Oluşturuldu');
         * $message->from('staj@trends.com.tr', 'Staj Takip Sistemi Yönetim');
         * */


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

        $users = User::whereHas("roles", function($q){ $q->where("name", "Yetkili")->where('status', 1); })->paginate(10);

        return view('admin.officer.index', compact('users'));


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
            $data['password'] = bcrypt($data['password']);
        }

        $user->where('id', $id)->update($data);

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
}

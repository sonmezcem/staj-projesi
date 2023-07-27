<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {

        return view('sections.login.login');

    }

    public function loginChecker(Request $request)
    {

        $request->validate([
            'kullanici_adi' => 'required',
            'parola' => 'required'
        ]);

        $request->merge([
            'username' => $request->kullanici_adi,
            'password' => $request->parola,
        ]);

        $credentials = $request->only('username' ,'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Başarılı bir şekilde giriş yapıldı');
        }

        return redirect('login')->withSuccess('Kullanıcı bilgileri hatalı');

    }

    public function register(Request $request){

        $request->validate([
            'kayit_ad' => 'required|max:100',
            'kayit_soyad' => 'required|max:100',
            'kayit_telefon' => 'required|numeric',
            'kayit_kullanici_adi' => 'required|max:100',
            'kayit_eposta' => 'required|email|max:255',
            'kayit_parola' => 'required|max:100',
            'kayit_parola_tekrari' => 'required|max:100|same:kayit_parola',
        ]);

        $request->merge([
            'name' => $request->kayit_ad,
            'surname' => $request->kayit_soyad,
            'phone' => $request->kayit_telefon,
            'email' => $request->kayit_eposta,
            'profile_picture' => 'null',
            'username' => $request->kayit_kullanici_adi,
            'password' => $request->kayit_parola,
            'user_type' => 1,
            'status' => 1,
        ]);

        $credentials = $request->only('name' ,'surname','phone','email','profile_picture','username','password','user_type','status');


        User::create($credentials);

        echo "<pre>";
        print_r($credentials);
        echo "</pre>";

    }
}

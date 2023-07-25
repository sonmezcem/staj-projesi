<?php

namespace App\Http\Controllers;

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
}

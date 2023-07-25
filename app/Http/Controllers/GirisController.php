<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GirisController extends Controller
{
    public function index(){

        return view('bolumler.giris.giris');

    }

    public function giris(Request $talep){


        $talep->validate([
            'kullanici_adi' => 'required',
            'parola' => 'required'
        ]);

        $yetkilendirme = $talep->only('kullanici_adi', 'parola');

        if(Auth::attempt($yetkilendirme)){
            return redirect()->intended('dashboard')
                ->withSuccess('Giriş Yapıldı');
        }

        return redirect("login")->withSuccess('Giriş bilgileri doğru değil!');

    }
}

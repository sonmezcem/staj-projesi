<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function myCaptcha()
    {
        return view('myCaptcha');
    }

    public function index()
    {
        if (Auth::check()) {

            if (Auth::user()->hasRole('Yönetici')) {
                return redirect()->route('admin.index');
            } else if (Auth::user()->hasRole('Yetkili')) {
                return redirect()->route('officer.index');
            } else if (Auth::user()->hasRole('Öğrenci')) {
                return redirect()->route('student.index');
            } else {
                return redirect()->route('index');
            }
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function myCaptchaPost(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ],
            ['captcha.captcha' => 'Invalid captcha code.']);
        dd("You are here :) .");
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }


}

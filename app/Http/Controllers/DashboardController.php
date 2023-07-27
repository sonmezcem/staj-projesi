<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $userID = Auth::id();

        $user = User::find($userID);

        return view('sections.dashboard.index',compact('user'));

    }
}

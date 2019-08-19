<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('pages.home', [
            'auth_user' => Auth::user()
        ]);
    }
    public function showReg(){
        return view('auth.register');
        /*  return view('auth.register', ['name' => $getInfo->name, 'email' => $getInfo->email, 'provider' => $provider,
              'provider_id' => $getInfo->id]);*/
    }
}

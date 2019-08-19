<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function attemptLogin(Request $request)
    {
        if($this->guard()->attempt($this->credentials($request), $request->filled('remember'))) {
            if (Auth::user()->status == 0) {
                $this->guard()->logout();
                $request->session()->invalidate();
                throw ValidationException::withMessages([
                    $this->username() => [trans('auth.verified')],
                ]);
            }
            elseif (Auth::user()->allowed == 0) {
                $this->guard()->logout();
                $request->session()->invalidate();
                throw ValidationException::withMessages([
                    $this->username() => [trans('auth.allowed')],
                ]);
            }

        }
    }


}

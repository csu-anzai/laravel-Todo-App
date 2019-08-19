<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response, File;
use Socialite;
use App\User;


class SocialController extends Controller
{
    public function redirect(Request $request)
    {
        $provider=$request->route('provider');

        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request)
    {
        $provider=$request->route('provider');
        $getInfo = Socialite::driver($provider)->user();

        $user = User::where('provider_id', $getInfo->id)->first();
        dd($user);
        if (!$user) {
            return redirect()->action(
                'Auth\RegisterController@showReg', ['name' => $getInfo->name, 'email' => $getInfo->email, 'provider' => $provider,
                    'provider_id' => $getInfo->id]
            );

        }
        return $user;
        /* $user = $this->createUser($getInfo, $provider);
         auth()->login($user);
         return redirect()->to('/');*/
    }

    function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'username' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}

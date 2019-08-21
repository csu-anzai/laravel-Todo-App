<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\UserRegisteredSuccessfully;
use App\Notifications\UserRegisteredSuccessfullyNoVerify;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ReCaptchaFormRequest;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Register new account.
     * @param Request $request
     * @return User
     */
    protected function register(Request $request)
    {
        /** @var User $user */
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'g-recaptcha-response' => ['required', 'recaptcha'],
            'provider' => ['string', 'max:255'],
            'provider_id' => ['string', 'max:255'],
            'avatar' => ['string', 'max:255'],
            'uploadedNewImage' => ['boolean'],

        ]);
        $validatedData['password'] = bcrypt(array_get($validatedData, 'password'));
        if ($validatedData['provider_id'] !== "") {
            $validatedData['status'] = 1;
            $validatedData['activation_code'] = "";
        } else {
            $validatedData['status'] = 0;
            $validatedData['activation_code'] = str_random(30) . time();
        }
        DB::beginTransaction();
        try {

            $user = app(User::class)->create($validatedData);
            if ($validatedData['uploadedNewImage'] == 1) {
                File::move(public_path('avatar_temp') . '/' . $validatedData['avatar'], public_path('avatar') . '/' . $validatedData['avatar']);
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
            logger()->error($exception);
            return redirect()->back()->with('message', 'Unable to create new user.');
        }
        if ($validatedData['provider_id'] !== "") {
            $user->notify(new UserRegisteredSuccessfullyNoVerify($user));
            auth()->login($user);
            return redirect()->to('/');
        }else{
            $user->notify(new UserRegisteredSuccessfully($user));
        }
        return redirect()->back()->with('message', 'Successfully created a new account. Please check your email and activate your account.');

    }

    /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
    {
        try {
            $user = app(User::class)->where('activation_code', $activationCode)->first();

            if (!$user) {
                return "The code does not exist for any user in our system.";
            }
            $user->status = 1;
            $user->activation_code = null;
            $isAllowed = $user->allowed;

            $user->save();

            if ($isAllowed == 1) {
                auth()->login($user);
            } else {
                return redirect()->to('/login');
            }
        } catch (Exception $exception) {
            logger()->error($exception);
            return "Whoops! something went wrong.";
        }
        return redirect()->to('/');
    }

    public function captcha(ReCaptchaFormRequest $reCaptchaFormRequest)
    {
        return "Done!";
    }


}
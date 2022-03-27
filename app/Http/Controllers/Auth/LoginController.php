<?php

namespace App\Http\Controllers\Auth;

// use Socialite;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        // $user->token; (return as your need)
        $email = $user->email;
        $db_user = User::where('email', '=', 'email')->first;
        if ($db_user == null) {
            $reg_user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('123456'),
                'oauth_token' => $user->token
            ]);

            Auth::login($reg_user);
        } else {
            Auth::login($db_user);
        }
    }
}

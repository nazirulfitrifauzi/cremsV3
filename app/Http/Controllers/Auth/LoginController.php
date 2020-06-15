<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

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

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['active'] = 1;
        return $credentials;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if (!$user) {
            return back()->with('error', "This email is not exist in our database.");
        } elseif ($user && \Hash::check($request->password, $user->password) && $user->active == 0) {
            return back()->with('error', "This account has not been activated yet.");
        } elseif ($user && \Hash::check($request->password, $user->password) && $user->active == 2) {
            return back()->with('error', "This account has been rejected by admin.");
        } elseif ($user && ($request->password != $user->password)) {
            return back()->with('error', "These credentials do not match our records.");
        }
    }
}

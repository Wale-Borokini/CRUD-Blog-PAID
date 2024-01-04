<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = RouteServiceProvider::PROFILE;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override the attemptLogin method to handle both username and email
    protected function attemptLogin(Request $request)
    {
        // Check if the input is an email address
        $username = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        return $this->guard()->attempt(
            [$username => $request->input('email'), 'password' => $request->input('password')],
            $request->filled('remember')
        );
    }

    // Modify the validation rules for both username and email
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'The username or email field is required.',
        ]);
    }
}

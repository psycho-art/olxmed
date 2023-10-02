<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected function authenticated()
    // {
    //    return redirect()->route('admin.dashboard');
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function adminLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email','password');

        $remember_me = $request->has('remember') ? true : false;

        if (Auth::guard('admin')->attempt($credentials, $remember_me)) {
            // $user = Auth::guard('admin')->user()->id;
            // $user = Admin::find($user);
            // Auth::guard('admin')->login($user);
            return redirect()->route('admin.dashboard');
        }  

        // dd(Auth::guard('admin')->check());

        return redirect()->route('admin.login')->with('error', 'Email or Password is incorrect!');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

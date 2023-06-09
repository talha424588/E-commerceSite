<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\user;
use App\Models\profile;
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

    public function index()
    {
        if(auth()->user())
        {
            $Profile =profile::with('user')->where('user_id',auth::user()->id)->first();
            if(!$Profile)
            {
                $updateProfile = new profile();
                $updateProfile->user_id = Auth::user()->id;
                $updateProfile->save();
                return view('Admin.Profile',compact('Profile'));
            }
            return view('Admin.index');
        }
        else
        {
            return view('Admin.login');
        }
    }

    public function register(Register $request)
    {
        return $request->input();
    }
}

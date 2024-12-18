<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

use Auth;

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
    protected $redirectTo = '/tracker';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index() { return view('login'); }

    public function login(LoginRequest $request)
    {
      if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
      { 
        return response(null, 200); 
      } 
      else 
      { 
        return response(null, 500); 
      } 
    }
    public function logout(Request $request) 
    {
      Auth::logout();
      return redirect('/');
    }
}

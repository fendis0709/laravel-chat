<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/chat';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $email      = $request->input('email');
        $password   = $request->input('password');

        if(!$request->ajax()) {
            if (Auth::attempt(['email' => $email, 'password' => $password], true)) {
                return redirect($this->redirectTo);
            }

            return view('auth.login', ['error' => 'Email dan Password tidak cocok !']);
        } else {
            if(Auth::attempt(['email' => $email, 'password' => $password], true)) {
                return $this->responseJson([
                    'status'    => 'success',
                    'data'      => [
                        'user_id'       => Auth::user()->id,
                        'role_id'       => Auth::user()->user_role_id,
                        'redirect'      => url($this->redirectTo),
                    ]
                ]);
            }

            return $this->responseJson([
                'status'    => 'error',
                'message'   => 'Email dan password tidak cocok !',
            ]);
        }
    }
}

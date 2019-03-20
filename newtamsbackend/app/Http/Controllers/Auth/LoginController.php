<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Validator;
use Illuminate\Http\Request;

use App\User;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $user = new User();

        $v = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($v->fails()) return $this->apiReturn('Validation Failed', 'failed', [], $v->errors());


        if(Auth::attempt(['email' => $request->post('email'), 'password' => $request->post('password')])) {
            return $this->apiReturn('Authenticated', 'success', Auth::user());
        }

		else {
			return $this->apiReturn('Login Failed', 'failed', []);
		}
    }

    public function apiReturn ($message, $status, $data = [], $validation_errors = []) {
		return response()->json([
			'data' => $data,
			'status' => $status,
			'message' => $message,
			'validation_errors' => $validation_errors,
		]);
	}

}

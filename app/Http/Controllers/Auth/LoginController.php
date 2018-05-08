<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'email';
    }

    public function login(Request $request){
        $msgs = [
            'email.required'=>'Vui lòng nhập địa chỉ email.',
            'email.email'=>'Đĩa chỉ email không đúng.',
            'password.required'=>'Vui lòng nhập mật khẩu.',
        ];
        $validator = Validator::make($this->credentials($request),[
            'email'=>'required|email',
            'password'=>'required|'
        ],$msgs);
        if(!$validator->fails()){
            if($this->attemptLogin($request)){
                return redirect()->route('admin.dashboard')->withMessages(['login-success'=>'Chào mừng bạn đến với Sale Management']);;
            }
            return redirect()->back()->withErrors(['login-fail'=>'Thông tin đăng nhập không đúng.']);
        }
        return redirect()->back()->withErrors($validator)->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}

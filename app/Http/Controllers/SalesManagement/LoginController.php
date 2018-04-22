<?php

namespace App\Http\Controllers\SalesManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $all = $request->only('email','password');
        $msgs = [
                    'email.required'=>'Vui lòng nhập địa chỉ email.',
                    'email.email'=>'Địa chỉ email không đúng.',
                    'password.required'=>'Vui lòng nhập mật khẩu.',
                ];
        $vali = Validator::make($all,[
            'email'=>'required|string|email',
            'password'=>'required|string',
        ],$msgs);
        if(!$vali->fails()){
            if(Auth::attempt(['email'=>$all['email'],'password'=>$all['password']])){
                return redirect()->route('admin.dashboard')->withMesssages(['login-success'=>'Chào mừng bạn đến với Sale management']);
            }
            return redirect()->back()->withErrors(['login-fail'=>'Thông tin đăng nhập không đúng.']);
        }
        return redirect()->back()->withErrors($vali)->withInput();
        
    }

    public function showFormLogin(){
        return view('auth.login');
    }

    public function logout(){

    }
}

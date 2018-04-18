<?php

namespace App\Http\Controllers\SalesManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $all = $request->only('email','password');
        $msgs = [
                    'email.required'=>'* Vui lòng nhập địa chỉ email.',
                    'email.email'=>'Địa * chỉ email không chính xác.',
                    'password.required'=>'* Vui lòng nhập mật khẩu.',
                ];
        $vali = Validator::make($all,[
            'email'=>'required|string|email',
            'password'=>'required|string',
        ],$msgs);
        if(!$vali->fails()){
            if(Auth::attempt(['email'=>$all['email'],'password'=>$all['password']])){
            }
            return redirect()->back()->with(['login-fail'=>'Thông tin đăng nhập không chính xác.']);
        }
        return redirect()->back()->withErrors($vali)->withInput();
        
    }

    public function showFormLogin(){
        return view('auth.login');
    }
}

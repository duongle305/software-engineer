<?php

namespace App\Http\Controllers\SalesManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function setting(Request $request){
        if($request->type == 'header'){
            session(['header'=>$request->color]);
        }else{
            session(['sidebar'=>$request->color]);
        }
    }
}

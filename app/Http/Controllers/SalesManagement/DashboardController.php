<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        $order = new Order();
        $totals = $order->total();
        return view('admin.dashboard')->withTotal($totals);
    }

    public function setting(Request $request){
        if($request->type == 'header'){
            session(['header'=>$request->color]);
        }else{
            session(['sidebar'=>$request->color]);
        }
    }
}

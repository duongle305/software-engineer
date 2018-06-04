<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        $totals = Order::total();
        $hotProducts = Product::hotProducts(5);
        $hotCustomers = Customer::hotCustomers(5);
        return view('admin.dashboard')->withTotal($totals)->withHotProducts($hotProducts)->withHotCustomers($hotCustomers);
    }

    public function setting(Request $request){
        if($request->type == 'header'){
            session(['header'=>$request->color]);
        }else{
            session(['sidebar'=>$request->color]);
        }
    }
}

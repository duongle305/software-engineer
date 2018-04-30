<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-orders')) abort(401,'Bạn không được phép xem danh sách đơn hàng.');

        $orders = Order::paginate(10);
        return view('admin.orders.index')->withOrders($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create-orders')) abort(401,'Bạn không được phép tạo mới đơn hàng.');

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermission('create-orders')) abort(401,'Bạn không được phép tạo mới đơn hàng.');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermission('read-orders')) abort(401,'Bạn không được phép xem đơn hàng.');

        return view('admin.orders.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermission('update-orders')) abort(401,'Bạn không được phép cập nhật đơn hàng.');

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermission('update-orders')) abort(401,'Bạn không được phép cập nhật đơn hàng.');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermission('delete-orders')) abort(401,'Bạn không được phép xóa đơn hàng.');
        $supplier = Supplier::find($id);
        if($supplier){
            $supplier->delete();
            return response()->json(['message'=>''],200);
        }
    }
}

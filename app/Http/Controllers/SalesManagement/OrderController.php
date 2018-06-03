<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->hasPermission('read-orders')) abort(401, 'Bạn không được phép xem danh sách đơn hàng.');

        return view('admin.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->hasPermission('create-orders')) abort(401, 'Bạn không được phép tạo mới đơn hàng.');

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasPermission('create-orders')) abort(401, 'Bạn không được phép tạo mới đơn hàng.');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->hasPermission('read-orders')) abort(401, 'Bạn không được phép xem đơn hàng.');

        $order = Order::find($id);
        if($order){
            $products = [];
            foreach ($order->products as $product) {
                $quantity = $product->pivot->whereOrderId($order->id)->first()->quantity;
                $product->quantity_order = $quantity;
                $products[] = $product;
            }
            $order->products = $products;
            return view('admin.orders.show')->withOrder($order);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermission('update-orders')) abort(401, 'Bạn không được phép cập nhật đơn hàng.');

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasPermission('update-orders')) abort(401, 'Bạn không được phép cập nhật đơn hàng.');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('delete-orders')) abort(401, 'Bạn không được phép xóa đơn hàng.');

        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response()->json(['message' => ''], 200);
        }
    }

    public function dataOrders($status = 'PENDING')
    {
        $status = strtoupper($status);
        $dataOrders = DB::table('orders')->where('status',$status)->paginate(15);
        return response()->json($dataOrders,200);
    }

    public function changeStatus(Request $request,$id)
    {
        $order = Order::find($id);
        if($order){
            $order->update(['status'=>$request->status]);
            return response()->json(['message'=>''],200);
        }
        return response()->json(['message'=>''],400);
    }

    public function search($status = 'PENDING',$keyword = '')
    {
        $status = strtoupper($status);
        $keyword = str_slug($keyword);
        $data = DB::table('orders')->select('orders.*')
            ->leftJoin('customers','customers.id','=','orders.customer_id')
            ->where('orders.status','=',$status)
            ->where('orders.code','LIKE','%'.$keyword.'%')
            ->groupBy('orders.id')->paginate(15);

        return response()->json($data,200);
    }


}

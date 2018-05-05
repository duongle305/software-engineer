<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-customers')) abort(401, 'Bạn không được phép xem danh sách khách hàng.');
        $customers = Customer::paginate(10);
        return view('admin.customers.index')->withCustomers($customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermission('update-customer')) abort(401,'Bạn không được phép chỉnh sửa thông tin khách hàng.');
        $customer = Customer::find($id);
        return view('admin.customers.edit')->withCustomer($customer);
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
        if(Auth::user()->hasPermission('update-customer')) abort(401,'Bạn không được phép chỉnh sửa thông tin khách hàng.');
        $all = $request->only(['first_name','last_name','email','phone','ward','district','province']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermission('delete-customter')) abort(401,'Bạn không được xóa thông tin khách hàng.');
        $customer = Customer::find($id);
        if($customer){
            $customer->delete();
            return response()->json(['message'=>'Xóa khách hàng '.$customer->first_name.' '.$customer->last_name.' thành công']);
        }
    }
}

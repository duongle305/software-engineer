<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return view('admin.suppliers.index')->withSuppliers($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->only(['title','phone','email','detail','ward','district','province']);
        $validator = Validator::make($all,[
            'title'=>'required|string',
            'phone'=>'required|string|unique:suppliers,phone',
            'email'=>'required|email|unique:suppliers,email',
            'detail'=>'required',
            'ward'=>'required',
            'district'=>'required',
            'province'=>'required',
        ],[
            'title.required'=>'Vui lòng nhập tên công nhà cung cấp',
            'phone.required'=>'Vui lòng nhập số điện thoại nhà cung cấp.',
            'email.required'=>'Vui lòng nhập địa chỉ email nhà cung cấp',
            'email.email'=>'Địa chỉ email không đúng.',
            'detail'=>'Vui lòng nhập số nhà, tên đường.',
            'ward'=>'Vui lòng chọn phường, xã',
            'district'=>'Vui lòng chọn quận, huyện',
            'province'=>'Vui lòng chọn tỉnh, thành phố.',
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $all['address'] = $all['detail'].', '.$all['ward'].', '.$all['district'].', '.$all['province'];
        $all = collect($all)->except(['detail','ward','district','province']);
        $supplier = Supplier::create($all->toArray());
        return redirect()->route('suppliers.show',$supplier->id)->withMessages(['create-supplier'=>'Thêm mới nhà cung cấp thành công.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('admin.suppliers.show')->withSupplier($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('admin.suppliers.edit')->withSupplier($supplier);
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
        $rules = [
            'title'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required|email',
        ];
        $msgs = [
            'title.required'=>'Vui lòng nhập tên công nhà cung cấp',
            'phone.required'=>'Vui lòng nhập số điện thoại nhà cung cấp.',
            'email.required'=>'Vui lòng nhập địa chỉ email nhà cung cấp',
            'email.email'=>'Địa chỉ email không đúng.',
        ];
        if(!isset($request->change_address) ){
            $all = $request->only(['title','phone','email']);
            $validator = Validator::make($all,$rules,$msgs);
            if($validator->fails()) return redirect()->back()->withErrors($validator);
        }else{
            $all = $request->only(['title','phone','email','detail','ward','district','province']);
            $rules['detail'] = 'required';
            $rules['ward'] = 'required';
            $rules['district'] = 'required';
            $rules['province'] = 'required';
            $msgs['detail.required'] = 'Vui lòng nhập số nhà, tên đường.';
            $msgs['ward.required'] = 'Vui lòng nhập phường, xã.';
            $msgs['district.required'] = 'Vui lòng nhập quận, huyện.';
            $msgs['province.required'] = 'Vui lòng nhập tỉnh, thành phố';
            $validator = Validator::make($all,$rules,$msgs);
            if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
            $all['address'] = $all['detail'].', '.$all['ward'].', '.$all['district'].', '.$all['province'];
            $all = collect($all)->except(['detail','ward','district','province','change_address'])->toArray();
        }
        $supplier = Supplier::find($id);
        $supplier->update($all);
        return redirect()->route('suppliers.show',$supplier->id)->withMessages(['update-supplier'=>'Cập nhật thông tin '.$supplier->title.' thành công.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if($supplier){
            $supplier->delete();
        }
    }
}

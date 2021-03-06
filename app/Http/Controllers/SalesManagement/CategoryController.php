<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-categories')) abort(401,'Bạn không được phép xem danh mục sản phẩm.');
        $categories = Category::all();
        return view('admin.categories.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('read-categories')) abort(401,'Bạn không được phép thêm mới danh mục sản phẩm.');
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermission('create-categories')) abort(401,'Bạn không được phép thêm mới danh mục sản phẩm.');
        $all = $request->only(['title','slug']);
        $validator = Validator::make($all,[
            'title'=>'required|string',
            'slug'=>'required|string'
        ],[
            'title.required'=>'Vui lòng nhập tiêu đề danh mục.',
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator);
        $cate = Category::create($all);
        return redirect()->route('categories.index')->withMessages(['create-category'=>'Thêm mới danh mục '.$cate->title.' thành công.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->hasPermission('read-categories')) abort(401, 'Bạn không được phép xem danh mục sản phẩm.');
        $category = Category::find($id);
        return view('admin.categories.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermission('update-categories')) abort(401, 'Bạn không được phép chỉnh sửa danh mục');
        $category = Category::find($id);
        return view('admin.categories.edit')->withCategory($category);
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
        if (!Auth::user()->hasPermission('update-categories')) abort(401, 'Bạn không được phép chỉnh sửa danh mục');
        $all = $request->only(['title','slug']);
        $validator = Validator::make($all,[
            'title'=>'required|string',
            'slug'=>'required|string'
        ],[
            'title.required'=>'Vui lòng nhập tiêu đề danh mục.',
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator);
        $cate = Category::find($id);
        if($cate)
            $cate->update($all);
        return redirect()->route('categories.index')->withMessages(['create-category'=>'Cập nhật danh mục'.$cate->title.'thành công.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermission('delete-categories')) abort(401,'Bạn không được phép xóa danh mục.');
        $cate = Category::find($id);
        if($cate){
            $cate->delete();
            return response()->json(['message'=>''],200);
        }
    }
}

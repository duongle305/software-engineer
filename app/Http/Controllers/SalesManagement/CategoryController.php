<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $cate = Category::find($id);
        if($cate){
            $cate->delete();
        }
    }
}

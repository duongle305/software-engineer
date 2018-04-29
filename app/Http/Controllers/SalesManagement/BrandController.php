<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('admin.brands.index')->withBrands($brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->only(['title','description','image']);

        $validator = Validator::make($all,[
            'title'=>'required|string',
            'description'=>'required|string',
            'image'=>'required|image|mimes:jpg,png,jpeg'
        ],[
            'title.required'=>'Vui lòng nhập tên thương hiệu.',
            'description.required'=>'Vui lòng nhập mô tả cho thương hiệu.',
            'image.required'=>'Vui lòng thêm ảnh cho thương hiệu.',
            'image.image'=>'Vui ',
            'image.mimes'=>''
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator);

        $image = $request->file('image');
        $image_name = str_slug($request->title).'-'.time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/brands'),$image_name);
        $all['image'] = 'uploads/brands/'.$image_name;
        $brand = Brand::create($all);
        return redirect()->route('brands.index')->withMessages(['create-brand'=>'Thêm mới thương hiệu '.$brand->title.' thành công.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        return view('admin.brands.show')->withBrand($brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brands.edit')->withBrand($brand);
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
        $all = $request->only(['title','description','image']);

        $validator = Validator::make($all,[
            'title'=>'required|string',
            'description'=>'required|string',
            'image'=>'sometimes|image|mimes:jpg,png,jpeg'
        ],[
            'title.required'=>'Vui lòng nhập tên thương hiệu.',
            'description.required'=>'Vui lòng nhập mô tả cho thương hiệu.',
            'image.image'=>'Vui ',
            'image.mimes'=>''
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator);
        $brand = Brand::find($id);
        $image = $request->file('image');
        $all = collect($all)->except(['image'])->toArray();
        if($image){
            if(File::exists($brand->image))
                File::delete($brand->image);
            $image_name = str_slug($request->title).'-'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/brands'),$image_name);
            $all['image'] = 'uploads/brands/'.$image_name;

        }
        $brand->update($all);
        return redirect()->route('brands.index')->withMessages(['update-brand'=>'Cập nhật thương hiệu '.$brand->title.' thành công.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

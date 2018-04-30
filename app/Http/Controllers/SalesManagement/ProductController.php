<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-products')) abort(401,'Bạn không được xem danh sách sản phẩm.');
        $products = Product::paginate(10);
        return view('admin.products.index')->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create-products')) abort(401,'Bạn không được phép thêm mới sản phẩm.');

        $categories = Category::all();
        $brands = Brand::all();
        $suppliers = Supplier::all();

        return view('admin.products.create')->withBrands($brands)->withCategories($categories)->withSuppliers($suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermission('create-products')) abort(401,'Bạn không được phép thêm mới sản phẩm.');

        $all = $request->only(['title','description','unit_price','base_price','quantity','supplier_id','brand_id','category_id']);
        return $request->all();
        $validator = Validator::make($all,[
            'title'=>'required|string',
            'description'=>'required|string',
            'unit_price'=>'required|string',
            'base_price'=>'required|string',
            'quantity'=>'required|string',
            'colors'=>'sometimes|array',
            'sizes'=>'sometimes|array'
        ],[
            'title.required'=>'Vui lòng nhập tên sản phẩm.',
            'description.required'=>'Vui lòng nhập mô tả cho sản phẩm.',
            'unit_price.required'=>'Vui lòng nhập giá bán cho sản phẩm.',
            'base_price.required'=>'Vui lòng nhập giá mua cho sản phẩm',
            'quantity.required'=>'Vui lòng nhập só lượng cho sản phẩm',
        ]);

        if($validator->fails()) return redirect()->back()->withErrors($validator);
        $all['code'] = $this->generateCode($request);

        $product = Product::create($all);

        $images= $request->file('images');
        $i = 1;
        foreach ($images as $image){
            if($image){
                $image_name = str_slug($request->title).'-'.$i.'-'.time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'),$image_name);
                Image::create(['url'=>'uploads/products/'.$image_name,'product_id'=>$product->id]) ;
                $i++;
            }
        }
        return redirect()->route('products.show',$product->id)->withMessages(['create-product'=>'Thêm mới sản phẩm'.$product->title.'thành công.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermission('read-products')) abort(401,'Bạn không được phép xem sản phẩm.');


        $product = Product::find($id);


        return view('admin.products.show')->withProduct($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermission('update-products')) abort(401,'Bạn không được phép câp nhật sản phẩm.');
        $categories = Category::all();
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $product = Product::find($id);

        return view('admin.products.edit')->withBrands($brands)->withCategories($categories)->withSuppliers($suppliers)->withProduct($product);
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
        if(!Auth::user()->hasPermission('delete-products')) abort(401,'Bạn không được phép xóa sản phẩm.');
        $supplier = Product::find($id);
        if($supplier){
            $supplier->delete();
            return response()->json(['message'=>''],200);
        }
    }

    private function generateCode(Request $request)
    {
        $productName = $request->title;
        if($productName){
            $productName = explode(' ',$productName);
            $temp = '';
            foreach($productName as $item){
              $temp .= strtoupper(substr($item,0,1));
            }
            $rand = (string)rand(0,99999999);
            if(strlen($rand) < 8){
                $tmp = '';
                for($i = 0; $i < 8-strlen($rand); $i++){
                    $tmp .= '0';
                }
                $rand = $tmp.$rand;
            }
            $temp.=$rand;
            $check = Product::whereCode($temp)->count();
            if($check > 0)
                $this->generateCode($request);
            return $temp;
        }

    }
}

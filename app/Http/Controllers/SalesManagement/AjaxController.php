<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\SizeType;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function provinces(){
        $provinces = Province::orderBy('title','asc')->get();
        return response()->json($provinces,200);
    }
    public function districts($id){
        $districts = Province::find($id)->districts;
        if($districts){
            return response()->json($districts,200);
        }
    }

    public function wards($id){
        $wards = District::find($id)->wards;
        if($wards){
            return response()->json($wards,200);
        }
    }

    public function category($id)
    {
        $cate =Category::find($id);
        if($cate)
            return response()->json($cate,200);

    }

    public function sizes($id)
    {
        $type = SizeType::find($id);
        return response()->json($type->sizes,200);
    }

    public function colors()
    {
        $colors = Color::all();
        return response()->json($colors,200);
    }

}

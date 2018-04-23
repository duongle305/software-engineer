<?php

namespace App\Http\Controllers\SalesManagement;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function provinces(){
        $provinces = Province::all();
        return response()->json($provinces,200);
    }
    public function districts($province){
        $districts= Province::where('slug',str_slug($province))->first()->districts;
        return response()->json($districts,200);
    }
}

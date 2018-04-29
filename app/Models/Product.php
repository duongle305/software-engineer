<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['code','title','description','unit_price','base_price','quantity','category_id','brand_id','supplier_id'];

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function sizes()
    {
        return $this->hasMany('App\Size');
    }
}

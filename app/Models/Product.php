<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['code', 'title', 'description', 'unit_price', 'base_price', 'quantity', 'category_id', 'brand_id', 'supplier_id','status'];

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Models\Size');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Models\Color');
    }

    public function attachColor($color)
    {
        if (is_int($color)) {
            return $this->colors()->save(Color::find($color));
        }
        return $this->colors()->save($color);
    }

    public function attachSize($size)
    {
        if (is_int($size)) {
            return $this->sizes()->save(Size::find($size));
        }
        return $this->sizes()->save($size);
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public static function hotProducts($limit)
    {
        $current = date('Y-m-d');

        $y = substr($current,0,4);
        $m = substr($current,5,2);
        $start = $y.'-'.$m.'-01 00:00:00';
        return DB::table('products')->selectRaw('products.id, products.code AS code, products.title AS title, SUM(order_product.quantity) AS quantity')
            ->join('order_product','products.id','=','order_product.product_id','left outer')
            ->join('orders','orders.id','=','order_product.order_id','left outer')
            ->where('orders.created_at','>=',$start)
            ->where('orders.created_at','<=',$current)
            ->orderBy('order_product.quantity','DESC')
            ->groupBy(['products.id'])
            ->limit($limit)
            ->get();
    }

}

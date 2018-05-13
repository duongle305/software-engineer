<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function total(){

        $currentDate = date('Y-m-d');

        $y = substr($currentDate,0,4);
        $m = substr($currentDate,5,2);
        $date = $y.'-'.$m.'-01';


        $v = Order::whereStatus('DELIVERED')->where('created_at', '>=',$date)->where('created_at', '<=',$currentDate)->sum('totals');
        return $v;
    }
}

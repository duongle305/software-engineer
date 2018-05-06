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
}

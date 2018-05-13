<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['first_name','last_name','phone','email','address'];

    public static function hotCustomers($limit)
    {
        return DB::table('customers')->selectRaw('customers.first_name, customers.last_name, customers.email, COUNT(orders.id) AS order_quantity, SUM(orders.totals) as order_total')
            ->join('orders','customers.id','=','orders.customer_id','left outer')
            ->groupBy('customers.id')
            ->orderBy('order_quantity','DESC')
            ->orderBy('order_total','DESC')
            ->limit($limit)
            ->get();
    }
}

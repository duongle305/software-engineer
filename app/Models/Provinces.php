<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'provinces';

    public function districts(){
        return $this->hasMany(District::class,'province_id');
    }
}

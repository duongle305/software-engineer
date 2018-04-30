<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeType extends Model
{
    protected $table = 'size_types';
    protected $fillable = ['title','slug'];


    public function sizes()
    {
        return $this->hasMany('App\Models\Size');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['display_name','name','description'];
    protected $hidden = ['updated_at'];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}

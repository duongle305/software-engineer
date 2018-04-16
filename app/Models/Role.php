<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['display_name','name','description'];

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function attachPermission(Permission $permission){
        return $this->permissions()->save($permission);
    }
}

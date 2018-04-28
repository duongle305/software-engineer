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

    public function detachPermission($per)
    {
        if(is_int($per)){
            $permission = $this->permissions()->find($per);
            if($permission) return $permission->pivot->delete();
        }
        if(is_string($per)) {
            $permission = $this->permissions()->whereName($per);
            if($permission) $permission->pivot->delete();
        }


    }
}

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'sex','photo','birthday','phone','email','password','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role){
        if(is_string($role)){
            return $this->roles->contains('name',$role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    public function hasPermission($permission){
        if(is_string($permission)){
            return $this->roles()->first();
        }
    }
    public function attachRole($role){
        if($this->detachRole()){
            if(is_string($role)){
                return $this->roles()->save(Role::whereName($role)->firstOrFail());
            }
            return $this->roles()->save($role);
        }
    }
    private function detachRole(){
        if($this->roles()->first()){
            return $this->roles()->first()->pivot->delete();
        }
        return true;
    }
}

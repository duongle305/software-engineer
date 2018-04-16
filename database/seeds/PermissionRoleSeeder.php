<?php

use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maps = ['c'=>'create','r'=>'read','u'=>'update','d'=>'delete'];
        $roles = [
            'administrator'=>[
                'users'=>'c,r,u,d',
                'acl'=>'c,r,u,d',
                'suppliers'=>'c,r,u,d',
                'customers'=>'r,u,d',
                'products'=>'c,r,u,d',
                'imports'=>'c,r,u,d',
                'orders'=>'c,r,u,d',
            ],
            'employee'=>[
                'products'=>'c,r,u',
                'suppliers'=>'c,r,u',
                'imports'=>'c,r,u',
                'orders'=>'c,r,u'
            ],
            'shipper'=>[
                'customers'=>'r',
                'orders'=>'r,u'
            ]
        ];

        foreach ($roles as $key => $role){
            $rol = \App\Models\Role::create(['display_name'=>ucwords($key),'name'=>str_slug($key)]);
            foreach ($role as $k => $items){
                $items = explode(',',$items);
                foreach($items as $item){
                    $per = \App\Models\Permission::whereName(str_slug($maps[$item].' '.$k))->first();
                    if(!$per){
                        $per = \App\Models\Permission::create(['display_name'=>ucwords($maps[$item].' '.$k),'name'=>str_slug($maps[$item].' '.$k)]);
                    }
                    $rol->attachPermission($per);
                }
            }
        }
    }
}

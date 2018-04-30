<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-acl')) abort(401,'Bạn không có quyền xem danh sách vai trò.');

        $roles = Role::paginate(10);
        return view('admin.roles.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create-acl')) abort(401,'Bạn không có quyền thêm mới vai trò.');
        $permissions = Permission::all();
        $permissions = collect($permissions);
        $permissions = $permissions->chunk(floor(count($permissions)/2));
        return view('admin.roles.create')->withPermissions($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermission('create-acl')) abort(401,'Bạn không có quyền thêm mới vai trò.');

        $all = $request->only(['display_name','name','description','permissions']);
        $validator = Validator::make($all,[
            'display_name'=>'required|string',
            'name'=>'required|string|unique:roles,name',
            'permissions'=>'required|array'
        ],[
            'display_name.required'=>'Vui lòng nhập tên hiển thị vai trò.',
            'name.required'=>'Vui lòng nhập tên vai trò.',
            'name.unique'=>'Tên vai trò không được trùng.',
            'permissions.required'=>'Vui lòng chọn quyền cho vai trò.',
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $role = Role::create($all);
        foreach ($request->permissions as $id){
            $permission = Permission::find($id);
            if($permission)
                $role->attachPermission($permission);
        }
        return redirect()->route('roles.show',$role->id)->withMessages(['create-role'=>'Thêm mới vai trò thành công.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermission('read-acl')) abort(401,'Bạn không có quyền xem vai trò này.');

        $role = Role::find($id);
        return view('admin.roles.show')->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermission('update-acl')) abort(401,'Bạn không có quyền cập nhật vai trò này.');
        $permissions = Permission::all();
        $permissions = collect($permissions);
        $permissions = $permissions->chunk(floor(count($permissions)/2));
        $role = Role::find($id);
        return view('admin.roles.edit')->withRole($role)->withPermissions($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermission('update-acl')) abort(401,'Bạn không có quyền cập nhật vai trò này.');
        $all = $request->only(['display_name','name','description','permissions']);
        $validator = Validator::make($all,[
            'display_name'=>'required|string',
            'name'=>'required|string',
            'permissions'=>'required|array'
        ],[
            'display_name.required'=>'Vui lòng nhập tên hiển thị vai trò.',
            'name.required'=>'Vui lòng nhập tên vai trò.',
            'permissions.required'=>'Vui lòng chọn quyền cho vai trò.',
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $role = Role::find($id);
        foreach ($request->permissions as $id){
            $permission = Permission::find($id);
            if($permission && !$role->permissions->contains($permission)) $role->attachPermission($permission);
        }
        foreach ($role->permissions as $permission){
            if(!collect($request->permissions)->contains($permission->id)){
                $role->detachPermission($permission->id);
            }
        }
        return redirect()->route('roles.show',$role->id)->withMessages(['create-role'=>'Cập nhật vai trò thành công.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermission('delete-acl')) abort(401,'Bạn không có quyền xóa quyền này.');
        $role = Role::find($id);
        if($role) {
            $role->delete();
            return response()->json(['message'=>'Xóa vai trò '.$role->display_name.' thành công.'],200);
        }
    }
}

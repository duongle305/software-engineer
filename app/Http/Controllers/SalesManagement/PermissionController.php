<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('admin.permissions.index')->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->permission_type === 'basic'){
            $msgs = [
                'display_name.required'=>'Vui lòng nhập tên hiển thị.',
                'name.required'=>'Vui lòng nhập tên (slug).',
                'name.unique'=>'Tên quyền đã tồn tại.'
            ];
            $validator = Validator::make($request->all(),[
                'display_name'=>'required',
                'name'=>'required|unique:permissions,name',
            ],$msgs);
            if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
            $all = $request->only(['display_name','name','description']);
            Permission::create($all);
            return redirect()->route('permissions.index')->withMessages(['create-permission'=>'Thêm mới quyền thành công.']);
        }
        if($request->permission_type === 'crud'){
            $msgs = [
                'resource.required'=>'Vui lòng nhập resource.',
                'resource.min'=>'Resource phải có ít nhất 3 ký tự',
                'resource.alpha'=>'Resource phải là ký tự chứ cái.'
            ];
            $validator = Validator::make($request->all(),[
                'resource'=>'required|min:3'
            ],$msgs);
            if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
            $cruds = explode(',',$request->crud_selected);
            $vn = ['create'=>'Thêm','read'=>'Xem','update'=>'Sửa','delete'=>'Xóa'];
            $vn = array_map('utf8_encode', $vn);
            $resource = $request->resource;
            if(count($cruds) > 0){
                foreach ($cruds as $crud){
                    $permission = new Permission();
                    $permission->name =  $crud.'-'.str_slug($request->resource);
                    $permission->display_name = utf8_decode($vn[$crud]).' '.$this->strToLowerUtf8($resource);
                    $permission->description = 'Cho phép người dùng '.$this->strToLowerUtf8($resource);
                    $permission->save();
                }
                return redirect()->route('permissions.index')->withMessages(['create-permission'=>'Thêm mới crud quyền thành công.']);
            }
        }
    }

    private function strToLowerUtf8($str){
        return strtolower(substr($str,0,1)).substr($str,1,strlen($str));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        if($permission)
            return view('admin.permissions.show')->withPermission($permission);
        return redirect()->back()->withErrors(['permission-not-found'=>'Quyền khồng tồn tại']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return response()->json($permission,200);
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
        $permission = Permission::find($id);
        if($permission){
            $all = $request->only(['name','display_name','description']);
            $validator = Validator::make($all,[
                'name'=>'required',
                'display_name'=>'required',
            ],['name.required'=>'Vui lòng nhập tên quyền.','display_name.required'=>'Vui lòng nhập tên hiển thị.']);
            if($validator->fails()) {
                return response()->json(['message'=>$validator->errors()->first()],400);
            }else{
                if($permission->update($all))
                    session()->flash('messages',['update-permission'=>'Cập nhật quyền thành công.']);
                return response()->json(['href'=>route('permissions.index')],200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

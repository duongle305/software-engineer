<?php

namespace App\Http\Controllers\SalesManagement;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('read-users')) abort(401, 'Bạn không được phép xem danh sách nhân viên.');
        $users = User::paginate(10);
        return view('admin.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create-users')) abort(401, 'Bạn không được phép thêm mới nhân viên.');
        $roles = Role::all();
        return view('admin.users.create')->withRoles($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermission('create-users')) abort(401, 'Bạn không được phép thêm mới nhân viên.');
        $all = $request->only(['first_name','last_name','birthday','sex','phone','email','password','role','photo','detail','ward','district','province']);
        $msgs = [
            'first_name.required'=>'Vui lòng nhập họ.',
            'last_name.required'=>'Vui lòng nhập tên.',
            'birthday.required'=>'Vui lòng nhập ngày sinh.',
            'sex.required'=>'Vui lòng chọn giới tính.',
            'photo.required'=>'Vui lòng chọn ảnh đại diện.',
            'photo.image'=>'Ảnh đại diện không đúng định dạng yêu cầu.',
            'photo.mimes'=>'Ảnh đại diện phải có định dạng jpg, jpeg, png.',
            'phone.required'=>'Vui lòng nhập số điện thoại.',
            'email.required'=>'Vui lòng nhập địa chỉ email.',
            'email.email'=>'Địa chỉ email không đúng.',
            'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự.',
            'role.required'=>'Vui lòng chọn vai trò.',
            'detail.required'=>'Vui lòng nhập số nhà, tên đường.',
            'ward.required'=>'Vui lòng chọn phường, xã.',
            'district.required'=>'Vui lòng chọn quận, huyện.',
            'province.required'=>'Vui lòng chọn tỉnh, thành phố.'
        ];
        $validator = Validator::make($all,[
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'birthday'=>'required|date_format:d-m-Y',
            'sex'=>'required|in:MALE,FEMALE',
            'photo'=>'required|image|mimes:jpg,jpeg,png',
            'phone'=>'required|regex:/(0)[0-9]{9,10}/',
            'email'=>'required|email',
            'role'=>'required',
            'password'=>'nullable|min:6',
            'detail'=>'required',
            'ward'=>'required',
            'district'=>'required',
            'province'=>'required'
        ],$msgs);
        if(!$validator->fails()){
            $image = $request->file('photo');
            $image_name = 'dl-'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads'),$image_name);
            $all['photo'] = 'uploads/'.$image_name;
            if(!empty($request->password)){
                $all['password'] = bcrypt('password');
            }else{
                $all['password'] = bcrypt($request->password);
            }
            $all['address'] = $request->detail.', '.$request->ward.', '.$request->district.', '.$request->province;
            $all['birthday'] = date('Y-m-d',strtotime($all['birthday']));
            $all = collect($all);
            $all = $all->except(['detail','ward','district','province','role']);
            $user = User::create($all->toArray());
            $role = Role::find($request->role);
            $user->attachRole($role);
            return redirect()->route('users.index')->withMessages(['create-user'=>'Thêm mới nhân viên thành công.']);
        }
        return redirect()->back()->withErrors($validator)->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermission('read-users')) abort(401,'Bạn không được phép xem thông tin nhân viên.');
        $user = User::find($id);
        if($user){
            return view('admin.users.show')->withUser($user);
        }
        return redirect()->back()->withErrors(['show-users'=>'Nhân viên không tồn tại.']);
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
        //
    }


    public function updateInfo(Request $request, $id){
        $msgs = [
            'first_name.required'=>'Vui lòng nhập họ.',
            'last_name.required'=>'Vui lòng nhập tên.',
            'birthday.required'=>'Vui lòng nhập ngày sinh.',
            'sex.required'=>'Vui lòng chọn giới tính.',
            'phone.required'=>'Vui lòng nhập số điện thoại.',
            'email.required'=>'Vui lòng nhập địa chỉ email.',
            'email.email'=>'Địa chỉ email không đúng.',
            'role.required'=>'Vui lòng chọn vai trò.',
        ];
        $rules = [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'birthday'=>'required|date_format:d-m-Y',
            'sex'=>'required|in:MALE,FEMALE',
            'phone'=>'required|regex:/(0)[0-9]{9,10}/',
            'email'=>'required|email',
            'role'=>'required',
        ];
        $user = User::find($id);
        if(!$user) return redirect()->back()->withErrors(['user-not-found'=>'Nhân viên không tồn tại.']);
        if(!isset($request->change_address) && empty($request->change_address)){
            $all = $request->only(['first_name','last_name','birthday','sex','email','phone','role']);
            $validator = Validator::make($all,$rules,$msgs);
            if(!$validator->fails()){
                $all['birthday'] = date('Y-m-d',strtotime($all['birthday']));
                $user->attachRole(Role::find($all['role']));
                $user->update($all);
                return redirect()->back()->withMessages(['update-info'=>'Cập nhật thông tin nhân viên thành công.']);
            }
            return redirect()->back()->withErrors($validator);
        }else{
            $all = $request->only(['first_name','last_name','birthday','sex','email','phone','role','detail','ward','district','province']);
            $msgs['detail.required'] = 'Vui lòng nhập số nhà, tên đường.';
            $msgs['ward.required'] = 'Vui lòng nhập phường, xã';
            $msgs['district.required'] = 'Vui lòng nhập quận, huyện.';
            $msgs['province.required'] = 'Vui lòng nhập tỉnh, thành phố';
            $rules['detail'] = 'required';
            $rules['ward'] = 'required';
            $rules['district'] = 'required';
            $rules['province'] = 'required';
            $validator = Validator::make($request->all(),$rules,$msgs);
            if(!$validator->fails()){
                $all['birthday'] = date('Y-m-d',strtotime($all['birthday']));
                $all['address'] = $request->detail.', '.$request->ward.', '.$request->district.', '.$request->province;
                $user->attachRole(Role::find($all['role']));
                $all = collect($all);
                $all = $all->except(['detail','ward','district','province','role']);
                $user->update($all->toArray());
                return redirect()->back()->withMessages(['update-info'=>'Cập nhật thông tin nhân viên thành công.']);
            }
            return redirect()->back()->withErrors($validator);
        }
    }

    public function updatePhoto(Request $request, $id){
        $all = $request->only(['photo']);
        $validator = Validator::make($all,
            [
            'photo'=>'required|image|mimes:jpg,jpeg,png'
            ],
            ['photo.required'=>'Vui lòng chọn ảnh đại diện.',
            'photo.image'=>'Ảnh đại diện không đúng định dạng yêu cầu.',
            'photo.mimes'=>'Ảnh đại diện phải có định dạng jpg, jpeg, png.',
            ]);
        $user = User::find($id);
        if(!$user) return redirect()->back()->withErrors(['user-not-found'=>'Nhân viên không tồn tại.']);
        if(!$validator->fails()){
            if(File::exists($user->photo)){
                File::delete($user->photo);
            }
            $image = $request->file('photo');
            $imageName = 'dl-'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads'),$imageName);
            $user->update(['photo'=>'uploads/'.$imageName]);
            return redirect()->route('users.index')->withMessages(['update-photo'=>'Cập nhật ảnh đại diện nhân viên thành công.']);
        }
        return redirect()->back()->withErrors($validator);
    }

    public function changePassword(Request $request, $id){
        $user  = User::find($id);
        if(!$user) return redirect()->back()->withErrors(['user-not-found'=>'Nhân viên không tồn tại.']);
        if(!isset($request->password) && empty($request->password)){
            $user->update(['password'=>bcrypt('password')]);
            return redirect()->back()->withMessages(['change-password'=>'Thay đổi mật khẩu thành công.']);
        }
        $all = $request->only(['password','password_confirmation']);
        $validator = Validator::make($all,[
            'password'=>'required|min:6',
            'password_confirmation'=>'required|confirmed|min:6'
        ],[
            'password.required'=>'Vui lòng nhập mật khẩu mới.',
            'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự.',
            'password_confirmation.required'=>'Vui lòng nhập lại mật khẩu.',
            'password_confirmation.confirmed'=>'Nhập lại mật khẩu không đúng.'
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator);
        $user->update(['password'=>bcrypt($all['password'])]);
        return redirect()->back()->withMessages(['change-password'=>'Thay đổi mật khẩu thành công.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermission('delete-users')) abort(403, 'Bạn không được phép xóa nhân viên');
        $user = User::find($id);
        if($user){
            if(File::exists($user->photo)){
                File::delete($user->photo);
            }
            $user->delete();
            return  response()->json(['message'=>'Xóa nhân viên '.$user->first_name.' '.$user->last_name.' thành công.'],200);
        }

    }
}

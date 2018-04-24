@extends('admin.layouts.app')

@section('title','Thông tin nhân viên '.$user->first_name.' '.$user->last_name)

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/dist/css/dropify.min.css') }}">
@endsection

@section('wrapper')
    <div class="row user-profile" id="app">
        <div class="col-lg-4 side-left align-items-stretch">
            <div class="card">
                <div class="card-body avatar">
                    <h4 class="card-title">Thông tin</h4>
                    <img src="{{ asset($user->photo) }}" alt="photo">
                    <p class="name">{{ $user->first_name }} {{ $user->last_name }}</p>
                    <p class="designation">-  {{ $user->roles()->first()->display_name }}  -</p>
                    <a class="d-block text-center text-dark" href="#">{{ $user->email }}</a>
                    <a class="d-block text-center text-dark" href="#">{{ $user->phone }}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8 side-right stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0">Chi tiết</h4>
                        <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true">Thông tin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar">Ảnh đại diện</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security">Đổi mật khẩu</a>
                            </li>
                        </ul>
                    </div>
                    <div class="wrapper">
                        <hr>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info">
                                <form action="{{ route('users.update.info', $user->id) }}" method="post">
                                    <div class="form-group">
                                        {{ csrf_field() }}
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" v-model="isChangeInfo">
                                                Cập nhật thông tin nhân viên
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="first_name">Họ</label>
                                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ (old('first_name'))?old('first_name'):$user->first_name }}" :disabled="!isChangeInfo">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="last_name">Tên</label>
                                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ (old('last_name'))?old('last_name'):$user->last_name }}" :disabled="!isChangeInfo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="birthday">Ngày sinh</label>
                                                <input class="form-control" data-inputmask="'alias': 'date','alias': 'dd-mm-yyyy'" name="birthday" id="birthday" value="{{ (old('birthday'))?old('birthday'):date('d-m-Y',strtotime($user->birthday)) }}" :disabled="!isChangeInfo">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="sex">Giới tính</label>
                                                <select name="sex" id="sex" class="form-control" :disabled="!isChangeInfo">
                                                    @php $sexs = ['MALE'=>'Nam','FEMALE'=>'Nữ'] @endphp
                                                    @foreach($sexs as $key => $sex)
                                                        <option value="{{ $key }}" {{ (old('sex'))?((old('sex')===$key)?'selected':''):(($user->sex===$key)?'selected':'') }}>{{ $sex }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" data-inputmask="'alias': 'email'" name="email" id="email" value="{{ (old('email'))?old('email'):$user->email }}" :disabled="!isChangeInfo">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="phone">Số điện thoại</label>
                                                <input type="text" class="form-control" name="phone" id="phone" value="{{ (old('phone'))?old('phone'):$user->phone }}" :disabled="!isChangeInfo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Vai trò</label>
                                        @php $roles = \App\Models\Role::all(); @endphp
                                        <select name="role" id="role" class="form-control" :disabled="!isChangeInfo">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ (old('role'))?((old('role')===$role->id)?'selected':''):(($user->roles()->first()->id===$role->id)?'selected':'') }}>{{ $role->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Địa chỉ</label>
                                        <input v-show="!isChangeAddress" class="form-control" id="address" value="{{ $user->address }}" disabled>
                                        <div class="form-check form-check-flat" v-show="isChangeInfo">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" v-model="isChangeAddress" @change="reset" name="change_address">
                                                Cập nhật địa chỉ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" v-show="isChangeAddress">
                                        <label for="detail">Số nhà, tên đường</label>
                                        <input type="text" class="form-control" name="detail" id="detail">
                                    </div>
                                    <div class="form-group" v-show="isChangeAddress">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="ward">Phường/Xã</label>
                                                <select name="ward" id="ward" class="form-control form-control-sm" :disabled="!isSelectedDistrict" v-model="isSelectedWard">
                                                    <option v-for="ward in wards" :value="ward.type+' '+ward.title">@{{ ward.type }} @{{ ward.title }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="district">Quận/Huyện</label>
                                                <select name="district" id="district" class="form-control form-control-sm" :disabled="!isSelectedProvince" @change="getWards" @blur="getWards" v-model="isSelectedDistrict">
                                                    <option v-for="district in districts" :value="district.type+' '+district.title" :data-id="district.id">@{{ district.type }} @{{ district.title }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="province">Tỉnh/TP</label>
                                                <select name="province" id="province" class="form-control form-control-sm" @change="getDistricts" @blur="getDistricts" v-model="isSelectedProvince">
                                                    <option v-for="province in provinces" :value="province.type+' '+province.title" :data-id="province.id">@{{ province.type }} @{{ province.title }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-5 text-right" v-show="isChangeInfo">
                                        <button type="submit" class="btn btn-success mr-2">Cập nhật</button>
                                    </div>
                                </form>
                            </div><!-- tab content ends -->
                            <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
                                <form action="{{ route('users.update.photo',$user->id) }}" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        @csrf
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" v-model="isChangePhoto">
                                                Cập nhật ảnh đại diện
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="dropify" data-max-file-size="5mb" data-default-file="{{ asset($user->photo) }}" :disabled="!isChangePhoto" name="photo">
                                    </div>
                                    <div class="form-group mt-5 text-right" v-show="isChangePhoto">
                                        <button type="submit" class="btn btn-success mr-2">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                <form action="{{ route('users.change.password', $user->id) }}" method="post">
                                    <div class="form-group">
                                        @csrf
                                    </div>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" v-model="defaultPassword">
                                            Sử dụng mật khẩu mặt định "password"
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật khẩu mới</label>
                                        <input type="password" class="form-control" id="password" name="password" :disabled="defaultPassword">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" :disabled="defaultPassword">
                                    </div>
                                    <div class="form-group mt-5 text-right">
                                        <button type="submit" class="btn btn-success mr-2">Xác nhận</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_js')
    <script src="{{ asset('assets/vendor/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/inputmask/dist/inputmask/bindings/inputmask.binding.js') }}"></script>
@endsection
@section('custom_js')
    <script>
        $(document).ready(function(){
            $('.dropify').dropify();
        });
        let app = new Vue({
            el: '#app',
            data:{
                defaultPassword:false,
                isChangeInfo:false,
                isChangePhoto: false,
                isChangeAddress: false,
                isSelectedProvince: false,
                isSelectedDistrict: false,
                isSelectedWard: false,
                isNull: true,
                provinces: [],
                districts:[],
                wards: [],
            },
            methods:{
                getProvinces(){
                    axios.get('/admin-dl/ajax/provinces').then(rs => {
                        this.provinces = rs.data;
                    });
                },
                getDistricts(e){
                    let selected = e.target.options[e.target.options.selectedIndex];
                    if(selected !== undefined){
                        let province_id = selected.dataset.id;
                        axios.get('/admin-dl/ajax/districts/'+province_id).then(rs => {
                            this.districts = rs.data;
                        }).catch(e =>{});
                    }
                },
                getWards(e){
                    let selected = e.target.options[e.target.options.selectedIndex];
                    if(selected !== undefined){
                        let district_id = selected.dataset.id;
                        axios.get('/admin-dl/ajax/wards/'+district_id).then(rs => {
                            this.wards = rs.data;
                        }).catch(e =>{});
                    }
                },
                reset(){
                    this.isSelectedProvince = undefined;
                    this.isSelectedDistrict = undefined;
                    this.isSelectedWard = undefined;
                    this.isNuLL = null;
                }
            },
            mounted(){
                this.getProvinces();
                this.reset();
            }
        });
    </script>
@endsection
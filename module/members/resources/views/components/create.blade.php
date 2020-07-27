@extends('nqadmin-dashboard::master')

@section('js-init')
    <script type="text/javascript" src="{{asset('adminux/js/ajax.js')}}"></script>
@endsection

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Thành viên</h3>
                    <p>Thêm thành viên mới</p>
                </div>
            </div>

            <form method="post">
                <input type="hidden" name="parent" value="{{$myuser->id}}">
                <input type="hidden" name="status" value="disable">
                <input type="hidden" name="affiliate" value="{{$myuser->code_name}}">

                @if (count($errors) > 0)
                    @foreach($errors->all() as $e)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <strong>Error!</strong> {{$e}}
                        </div>
                    @endforeach
                @endif
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Thêm thành viên mới

                                    @if ($permissions->contains('name','member_index'))
                                        <a href="{{route('nqadmin::members.index.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> Quay lại danh sách
                                        </a>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Email (Sử dụng để đăng nhập)</label>
                                    <input type="email"
                                           required
                                           class="form-control"
                                           autocomplete="off"
                                           name="email"
                                           value="{{old('email')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Mật khẩu</label>
                                    <input type="password"
                                           required
                                           class="form-control"
                                           autocomplete="off"
                                           data-parsley-minlength="6"
                                           name="password"
                                           id="password"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Xác nhận mật khẩu</label>
                                    <input data-parsley-equalto="#password"
                                           type="password"
                                           required
                                           class="form-control"
                                           id="re_password"
                                           autocomplete="off"
                                           data-parsley-minlength="6"
                                           name="re_password"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Họ và tên</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           data-parsley-pattern="[a-zA-Z0-9\s]+"
                                           name="fullname"
                                           value="{{old('fullname')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Số chứng minh thư / Hộ chiếu</label>
                                    <input type="text"
                                           class="form-control"
                                           name="passport"
                                           value="{{old('passport')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Địa chỉ</label>
                                    <input type="text"
                                           class="form-control"
                                           name="address"
                                           value="{{old('address')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Số điện thoại</label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{old('phone')}}"
                                           name="phone"
                                    >
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tùy chọn khác</h5>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label class="form-control-label">Giới tính</label>
                                    <select class="form-control" name="gender">
                                        <option value="male" {{ (old('gender') == 'male') ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ (old('gender') == 'female') ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ (old('gender') == 'other') ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <div class="flex-upload">
                                        <input type="text" name="thumbnail" class="form-control" id="ckfinder-input-1">
                                        <button type="button" id="ckfinder-popup-1">Upload</button>
                                    </div>
                                    <img src="" alt="" id="imgreview">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px">Lưu lại</button>

                                    @if ($permissions->contains('name','member_edit'))
                                        <button class="btn btn-secondary"
                                                type="submit"
                                                name="continue_create" value="1"
                                                style="margin-top: 20px"
                                        >
                                            Lưu và thêm mới
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

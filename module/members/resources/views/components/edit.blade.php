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
                    <p>Cập nhật thông tin thành viên</p>
                </div>
            </div>

            <form method="post">

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
                                <h5 class="card-title">Cập nhật thành viên

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
                                           value="{{$data->email}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Mật khẩu</label>
                                    <input type="password"
                                           class="form-control"
                                           autocomplete="off"
                                           name="password"
                                           id="password"
                                           placeholder="Nhập nếu muốn đổi mật khẩu"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Xác nhận mật khẩu</label>
                                    <input
                                           type="password"
                                           class="form-control"
                                           id="re_password"
                                           autocomplete="off"
                                           name="re_password"
                                           placeholder="Nhập nếu muốn đổi mật khẩu"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Họ và tên</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           data-parsley-pattern="[a-zA-Z0-9\s]+"
                                           name="fullname"
                                           value="{{$data->fullname}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Số chứng minh thư / Hộ chiếu</label>
                                    <input type="text"
                                           class="form-control"
                                           name="passport"
                                           value="{{$data->passport}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Địa chỉ</label>
                                    <input type="text"
                                           class="form-control"
                                           name="address"
                                           value="{{$data->address}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Số điện thoại</label>
                                    <input type="text"
                                           class="form-control"
                                           value="{{$data->phone}}"
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
                                    <img src="{{$data->thumbnail}}" alt="" id="imgreview">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px">Lưu lại</button>

                                    @if ($permissions->contains('name','member_edit'))
                                        <button class="btn btn-secondary"
                                                type="submit"
                                                name="continue_edit" value="1"
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

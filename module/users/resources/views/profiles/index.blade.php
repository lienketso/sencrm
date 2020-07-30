@extends('nqadmin-dashboard::master')

@section('content')

@inject('userMeta','Users\Repositories\UsersMetaRepository');

<div class="wrapper-content">
    <div class="row  align-items-end  customer-profile-cover">
        <figure class="background"> </figure>
        <div class="container mb-2">
            <div class="row  align-items-center p-2">
                <figure class="social-profile-pic"><img src="{{ ($userInfo->thumbnail=='') ? asset('adminux/img/advertise_maxartkiller_ui-ux.png') : $userInfo->thumbnail }}" alt=""></figure>
                <div class="col-sm-16 col-lg-4 col-xl-4  profile-name">
                    <h2>{{$userInfo->fullname}}</h2>
                    <p>{{$userInfo->address}}</p>
                </div>
                <div class="col-16 col-sm-16 col-lg-9 col-xl-9 text-right d-flex">
                    <div class="col col-sm-4 col-lg col-xl-4 ">
                        <h4>Sales</h4>
                        <h2>125</h2>
                    </div>
                    <div class="col col-sm-4 col-lg col-xl-4 ">
                        <h4>Orders</h4>
                        <h2>143</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-expanded="true">Thông tin cá nhân</a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#orders" role="tab" aria-expanded="false">Đơn hàng</a> </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="profile" role="tabpanel" aria-expanded="true">
                <div class="row">
                    <div class="col-sm-16">

                    </div>
                    <div class="col-sm-16">
                        <h3 class="mt-2">Thông tin cá nhân</h3>
                        <hr>
                        @if (count($errors) > 0)
                            @foreach($errors->all() as $e)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    <strong>Lỗi !</strong> {{$e}}
                                </div>
                            @endforeach
                        @endif
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                    <form class="col-sm-16" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-lg-8 col-md-8">
                                        <label>Họ và tên</label>
                                        <input type="text" class="form-control" name="fullname" value="{{$userInfo->fullname}}">
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" value="{{$userInfo->address}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 col-md-8">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$userInfo->email}}" disabled="disabled">
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone" value="{{$userInfo->phone}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 col-md-8">
                                        <label>Số CMT / Hộ chiếu</label>
                                        <input type="number" class="form-control" name="passport" value="{{$userInfo->passport}}" >
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <label>Ảnh đại diện</label>
                                        <div class="flex-upload">
                                            <input type="text" name="thumbnail" class="form-control" id="ckfinder-input-1" value="{{$userInfo->thumbnail}}">
                                            <button type="button" id="ckfinder-popup-1">Upload</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 col-md-8">
                                    <label>Giới tính</label>
                                    <div class="">
                                        <label class="custom-control custom-radio" for="rank1">
                                            <input type="radio" class="custom-control-input" name="gender" id="rank1" value="male" {{($userInfo->gender=='male') ? 'checked' : '' }} >
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Nam</span>
                                        </label>
                                        <label class="custom-control custom-radio" for="rank2">
                                            <input type="radio" class="custom-control-input" name="gender" id="rank2" value="female" {{($userInfo->gender=='female') ? 'checked' : '' }} >
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Nữ</span>
                                        </label>
                                        <label class="custom-control custom-radio" for="rank3">
                                            <input type="radio" class="custom-control-input" name="gender" id="rank3" value="other" {{($userInfo->gender=='other') ? 'checked' : '' }} >
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Không rõ</span>
                                        </label>
                                    </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <div class="form-group ">
                                            <label>Ngày sinh</label>
                                            <div class="input-group">
                                                <input type="text" name="birthday" value="{{$userInfo->birthday}}" class="form-control datepicker"  placeholder="15/07/1989">
                                                <button class="input-group-addon"><i class="fa fa-calendar"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 col-md-8">
                                        <label>Mật khẩu</label>
                                        <input type="email" class="form-control" name="password" value="" placeholder="Nhập nếu muốn đổi mật khẩu mới" >
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <label>Xác nhận mật khẩu</label>
                                        <input type="email" class="form-control" name="repassword" value="" >
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="card ">
                                    <div class="card-header ">Thông tin thanh toán</div>
                                    <div class="card-body ">
                                        <p><strong>Cập nhật các thông tin thanh toán ngân hàng của bạn để nhận hoa hồng tại Sen Đất Việt</strong></p>
                                        <div class="form-group">
                                            <label class="form-control-label">Chủ tài khoản</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="meta_card_name"
                                                   value="{{$userMeta->getMeta('meta_card_name',$userInfo->id)}}"
                                                   placeholder="Nguyễn Văn A"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Số tài khoản</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="meta_card_number"
                                                   value="{{$userMeta->getMeta('meta_card_number',$userInfo->id)}}"
                                                   placeholder="0451000390176"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Tên ngân hàng</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="meta_card_bank"
                                                   value="{{$userMeta->getMeta('meta_card_bank',$userInfo->id)}}"
                                                   placeholder="Vietcombank"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Chi nhánh ngân hàng</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="meta_card_brand"
                                                   value="{{$userMeta->getMeta('meta_card_brand',$userInfo->id)}}"
                                                   placeholder="Chi nhánh Hà Thành"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-lg-16">
                                <hr>
                                <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane" id="orders" role="tabpanel" aria-expanded="false">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <h4 class="alert-heading">Oopss!</h4>
                    <p>You have something missed, Please fillup required fields to procceed further. Read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content. </p>
                </div>
            </div>


        </div>
    </div>

</div>

@endsection
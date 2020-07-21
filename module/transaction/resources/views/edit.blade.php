@extends('nqadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/i18n/vi.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/ckeditor4.8/ckeditor.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/init.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/ckeditor4.8/init.js')}}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('adminux/vendor/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminux/vendor/select2/dist/css/select2-bootstrap.min.css')}}">
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
                    <h3><i class="fa fa-sitemap "></i> Xét duyệt đơn hàng</h3>
                    <p>Duyệt đơn hàng</p>
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
                <input type="hidden" value="{{$data->id}}" name="current_id">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Duyệt đơn hàng <strong>#DH{{$data->id}}</strong>

                                    @if ($permissions->contains('name','transaction_index'))
                                        <a href="{{route('nqadmin::transaction.index.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> Quay lại
                                        </a>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleSelect1">Tùy chọn trạng thái</label>
                                    <select class="form-control"name="status" id="exampleSelect1">
                                        <option value="fail" @if($data->status=='fail') selected="" @endif >Chưa xử lý</option>
                                        <option value="success" @if($data->status=='success') selected="" @endif>Đã xử lý</option>
                                        <option value="disable" @if($data->status=='disable') selected="" @endif>Hủy</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Xác nhận duyệt</h5>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px">Xác nhận</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
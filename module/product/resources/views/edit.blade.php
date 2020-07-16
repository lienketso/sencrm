@extends('nqadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/i18n/vi.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/js/jquery.mask.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/init.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#price').mask('000,000,000', {reverse:true});
            $('#disprice').mask('000,000,000', {reverse:true})
        });
    </script>
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
        $lang = Session::get('lang',config('app.locale'));
    @endphp

    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Quản lý sản phẩm</h3>
                    <p>Sửa sản phẩm</p>
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
                                <h5 class="card-title">Sửa sản phẩm {{$data->name}}
                                    @if ($permissions->contains('name','product_index'))
                                        <a href="{{route('nqadmin::product.index.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> Quay lại danh sách
                                        </a>
                                    @endif

                                    @if ($permissions->contains('name','product_create'))
                                        <a href="{{route('nqadmin::product.create.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm sản phẩm mới
                                        </a>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label class="form-control-label">Tên sản phẩm</label>
                                    <input type="text"
                                           class="form-control" parsley-trigger="change"
                                           id="input_name"
                                           autocomplete="off"
                                           name="name"
                                           value="{{$data->name}}" onkeyup="ChangeToSlug();"
                                           required
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Đường dẫn</label>
                                    <input type="text"
                                           class="form-control" parsley-trigger="change"
                                           autocomplete="off"
                                           name="slug" id="input_slug"
                                           value="{{$data->slug}}"
                                           required
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Mã sản phẩm</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="code_name"
                                           value="{{$data->code_name}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Giá niêm yết ( VNĐ ) </label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="price"
                                           id="price"
                                           value="{{number_format($data->price)}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Giá khuyến mại ( VNĐ )</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="discount"
                                           id="disprice"
                                           value="{{number_format($data->discount)}}"
                                    >
                                </div>
                                @foreach($listPackage as $row)
                                <div class="form-group">
                                    <input type="hidden" name="package_id[]" value="{{$row->id}}">
                                    <label class="form-control-label">Giá {{$row->name}} ( VNĐ )</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="package_price[]"
                                           id=""
                                           value="{{$row->getProduct->first()->pivot->package_price}}"
                                    >
                                </div>
                                @endforeach

                                <div class="form-group">
                                    <label class="form-control-label">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="ckeditors" name="excerpt" rows="4">{{$data->excerpt}}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tùy chọn</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Trọng lượng</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="weight"
                                           value="{{$data->weight}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Đơn vị tính</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="unit"
                                           value="{{$data->unit}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Trạng thái </label>
                                    <select class="form-control" name="status">
                                        <option value="active" {{ ($data->status == 'active') ? 'selected' : '' }}>Hiển thị</option>
                                        <option value="disable" {{ ($data->status == 'disable') ? 'selected' : '' }}>Tạm ẩn</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ảnh sản phẩm</label>
                                    <div class="flex-upload">
                                        <input type="text" name="thumbnail" value="{{$data->thumbnail}}" class="form-control" id="ckfinder-input-1">
                                        <button type="button" id="ckfinder-popup-1">Upload</button>
                                    </div>
                                    <img src="{{env('APP_URL').$data->thumbnail}}" alt="" id="imgreview">
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px">Lưu lại</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $('.rank_thumbnail img').on('click', function (e) {
            $('.rank_thumbnail img').removeClass('active');
            var _this = $(e.currentTarget);
            _this.addClass('active');
            var name = _this.attr('data-name');
            var thumbnail = _this.attr('src');
            $('input[name="rank_name"]').val(name);
            $('input[name="thumbnail"]').val(thumbnail);
        })
    </script>
@endpush

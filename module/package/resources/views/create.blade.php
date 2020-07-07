@extends('nqadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/i18n/vi.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/js/jquery.mask.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/ckeditor4.8/ckeditor.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('adminux/vendor/ckeditor4.8/init.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/init.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#price').mask('000,000,000', {reverse:true});
            $('#discount').mask('000,000,000', {reverse:true})
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
    @endphp

    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Gói sản phẩm</h3>
                    <p>Thêm gói mới</p>
                </div>
            </div>

            <form method="post" enctype="multipart/form-data">
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
                                <h5 class="card-title">Tạo gói mới
                                    @if ($permissions->contains('name','package_index'))
                                        <a href="{{route('nqadmin::package.index.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> Quay lại danh sách
                                        </a>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label class="form-control-label">Tên gói</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="name"
                                           value="{{old('name')}}"
                                           required
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Giá trị gói ( VNĐ )  </label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           placeholder="Giá trị tối thiểu để được triết khấu"
                                           name="price"
                                           id="price"
                                           value="{{old('price')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Giá sản phẩm ( VNĐ )  </label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           placeholder="Giá bán ra đã triết khấu theo gói"
                                           name="discount"
                                           id="discount"
                                           value="{{old('discount')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Thông tin gói sản phẩm</label>
                                    <textarea class="form-control" id="ckeditor" name="content" rows="4">{{old('content')}}</textarea>
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
                                    <label class="form-control-label">Thứ tự hiển thị</label>
                                    <input type="number"
                                           class="form-control"
                                           autocomplete="off"
                                           name="is_order"
                                           min="0"
                                           value="{{old('is_order')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Trạng thái </label>
                                    <select class="form-control" name="status">
                                        <option value="active" {{ (old('status') == 'active') ? 'selected' : '' }}>Hiển thị</option>
                                        <option value="disable" {{ (old('status') == 'disable') ? 'selected' : '' }}>Tạm ẩn</option>
                                    </select>
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

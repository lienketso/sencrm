@extends('nqadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/i18n/vi.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/ckeditor4.8/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/js/jquery.mask.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/init.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/ckeditor4.8/init.js')}}"></script>
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
                                    <label class="form-control-label">Danh mục</label>
                                    <select name="category" class="form-control">
                                        <option value="0">---Chọn danh mục---</option>
                                        @php
                                            optionCategory($category,0,$data->category);
                                        @endphp
                                    </select>
                                </div>
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
                                    <label class="form-control-label">Giá bán @if($lang=='vi') ( VNĐ ) @endif @if($lang=='en') ( USD ) @endif</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="price"
                                           id="price"
                                           value="{{number_format($data->price)}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Giá gốc @if($lang=='vi') ( VNĐ ) @endif @if($lang=='en') ( USD ) @endif</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="discount"
                                           id="disprice"
                                           value="{{number_format($data->discount)}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="ckeditors" name="excerpt" rows="4">{{$data->excerpt}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Chi tiết sản phẩm</label>
                                    <textarea id="ckeditor"
                                              class="form-control"
                                              name="content"
                                              required
                                              parsley-trigger="change"
                                    >{{$data->content}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Thẻ meta title</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="meta_title"
                                           id="input-seo-title"
                                           placeholder=""
                                           value="{{$data->meta_title}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Thẻ meta description</label>
                                    <textarea class="form-control" name="meta_description" rows="4">{{$data->meta_description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        @include('nqadmin-dashboard::components.thumbnail', ['data'=>$data])
                        @include('nqadmin-dashboard::components.gallery', ['data'=>$data->gallery])
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tùy chọn</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Trạng thái </label>
                                    <select class="custom-select form-control" name="status">
                                        <option value="active" {{ ($data->status == 'active') ? 'selected' : '' }}>Hiển thị</option>
                                        <option value="disable" {{ ($data->status == 'disable') ? 'selected' : '' }}>Tạm ẩn</option>
                                        <option value="hot" {{ ($data->status == 'hot') ? 'selected' : '' }}>Nổi bật</option>
                                        <option value="new" {{ ($data->status == 'new') ? 'selected' : '' }}>Mới nhất</option>
                                        <option value="sale" {{ ($data->status == 'sale') ? 'selected' : '' }}>Hot sale</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Sản phẩm ưa thích </label>
                                    <select class="custom-select form-control" name="label">
                                        <option value="no" {{ ($data->label == 'new') ? 'selected' : ''
                                        }}>Không</option>
                                        <option value="yes" {{ ($data->label == 'yes') ? 'selected' : '' }}>Có</option>
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

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
    @endphp

    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Quản lý sản phẩm</h3>
                    <p>Tạo mới sản phẩm</p>
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
                <input type="hidden" name="lang_code" value="{{$lang}}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tạo mới sản phẩm
                                    @if ($permissions->contains('name','product_index'))
                                        <a href="{{route('nqadmin::product.index.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> Quay lại danh sách
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
                                            MultiMenu($category);
                                        @endphp
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Tên sản phẩm</label>
                                    <input type="text" parsley-trigger="change"
                                           class="form-control"
                                           autocomplete="off"
                                           name="name"
                                           value="{{old('name')}}"
                                           id="input_name"
                                           onkeyup="ChangeToSlug();"
                                           required
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Đường dẫn</label>
                                    <input type="text" parsley-trigger="change"
                                           class="form-control"
                                           autocomplete="off"
                                           name="slug"
                                           value="{{old('slug')}}" id="input_slug" required
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Mã sản phẩm</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="code_name"
                                           value="{{old('code_name')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Giá bán @if($lang=='vi') ( VNĐ ) @endif @if($lang=='en') ( USD ) @endif </label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="price"
                                           id="price"
                                           value="{{old('price')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Giá gốc @if($lang=='vi') ( VNĐ ) @endif @if($lang=='en') ( USD ) @endif</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="discount"
                                           id="disprice"
                                           value="{{old('discount')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="ckeditors" name="excerpt" rows="4">{{old('excerpt')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Chi tiết sản phẩm</label>
                                    <textarea id="ckeditor"
                                              class="form-control"
                                              name="content"
                                              required
                                              parsley-trigger="change"
                                    >{{old('content')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Thẻ meta title</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="meta_title"
                                           id="input-seo-title"
                                           placeholder=""
                                           value="{{old('meta_title')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Thẻ meta description</label>
                                    <textarea class="form-control" name="meta_description" rows="4">{{old('meta_description')}}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        @include('nqadmin-dashboard::components.thumbnail')
                        @include('nqadmin-dashboard::components.gallery')
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tùy chọn</h5>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Trạng thái </label>
                                    <select class="custom-select form-control" name="status">
                                        <option value="active" {{ (old('status') == 'active') ? 'selected' : '' }}>Hiển thị</option>
                                        <option value="disable" {{ (old('status') == 'disable') ? 'selected' : '' }}>Tạm ẩn</option>
                                        <option value="hot" {{ (old('status') == 'hot') ? 'selected' : '' }}>Nổi bật</option>
                                        <option value="new" {{ (old('status') == 'new') ? 'selected' : '' }}>Mới nhất</option>
                                        <option value="sale" {{ (old('status') == 'sale') ? 'selected' : '' }}>Hot Sale</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Hiển thị </label>
                                    <select class="custom-select form-control" name="label">
                                        <option value="">Sản phẩm ưa thích</option>
                                        <option value="no" {{ (old('label') == 'no') ? 'selected' : '' }}>Không</option>
                                        <option value="yes" {{ (old('label') == 'yes') ? 'selected' : ''
                                        }}>Có</option>

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

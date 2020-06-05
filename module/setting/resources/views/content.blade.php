@extends('nqadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap-maxlength/src/bootstrap-maxlength.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap-tagsinput/src/bootstrap-tagsinput.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/i18n/vi.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap-maxlength/src/init.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap-tagsinput/src/init.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/init.js')}}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('adminux/vendor/bootstrap-tagsinput/src/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('adminux/vendor/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminux/vendor/select2/dist/css/select2-bootstrap.min.css')}}">
@endsection

@section('content')

    @inject('setting', 'Setting\Repositories\SettingRepository')
    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Cấu hình</h3>
                    <p>Cấu hình website</p>
                </div>
            </div>

            <form method="post" action="{{route('nqadmin::setting.site.post')}}">
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
                    @include('nqadmin-setting::sidebar')

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Cấu hình thông tin trang chủ
                                </h5>
                            </div>
                            <div class="card-body">

                                {!! \Base\Supports\FlashMessage::renderMessage('edit') !!}

                                <div class="form-group">
                                    <label class="form-control-label">Boxes #1 tiêu đề</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="boxes_1_title"
                                           value="{{$setting->getSettingMeta('boxes_1_title')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Boxes #1 Mô tả</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="boxes_1_link"
                                           value="{{$setting->getSettingMeta('boxes_1_link')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Boxes #2 tiêu đề</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="boxes_2_title"
                                           value="{{$setting->getSettingMeta('boxes_2_title')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Boxes #2 Mô tả</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="boxes_2_link"
                                           value="{{$setting->getSettingMeta('boxes_2_link')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Boxes #3 tiêu đề</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="boxes_3_title"
                                           value="{{$setting->getSettingMeta('boxes_3_title')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Boxes #3 mô tả</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="boxes_3_link"
                                           value="{{$setting->getSettingMeta('boxes_3_link')}}"
                                    >
                                </div>



                                <div class="form-group">
                                    <label class="form-control-label">Video trang chủ</label>
                                    <textarea type="text"
                                           class="form-control"
                                           name="home_about_content"
                                    >{{$setting->getSettingMeta('home_about_content')}}</textarea>
                                </div>


                                <div class="form-group">
                                    <label class="form-control-label">Footer about</label>
                                    <textarea type="text"
                                              class="form-control"
                                              name="footer_about"
                                    >{{$setting->getSettingMeta('footer_about')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Footer about link</label>
                                    <input type="text"
                                           class="form-control"
                                           name="footer_about_link"
                                           value="{{$setting->getSettingMeta('footer_about_link')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Copyright text</label>
                                    <textarea type="text"
                                              class="form-control"
                                              name="copyright_text"
                                    >{{$setting->getSettingMeta('copyright_text')}}</textarea>
                                </div>

                                <div class="form-group text-right">
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
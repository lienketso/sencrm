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
                    <p>Cấu hình tiếng anh</p>
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
                                <h5 class="card-title">Cấu hình tiếng anh cho trang chủ
                                </h5>
                            </div>
                            <div class="card-body">

                                {!! \Base\Supports\FlashMessage::renderMessage('edit') !!}

                                <div class="form-group">
                                    <label class="form-control-label">Box #1 title</label>
                                    <input type="text"
                                           class="form-control"
                                           name="funfact_number_1"
                                           value="{{$setting->getSettingMeta('funfact_number_1')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Box #1 Description</label>
                                    <input type="text"
                                           class="form-control"
                                           name="funfact_title_1"
                                           value="{{$setting->getSettingMeta('funfact_title_1')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Box #2 title</label>
                                    <input type="text"
                                           class="form-control"
                                           name="funfact_number_2"
                                           value="{{$setting->getSettingMeta('funfact_number_2')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Box #2 description</label>
                                    <input type="text"
                                           class="form-control"
                                           name="funfact_title_2"
                                           value="{{$setting->getSettingMeta('funfact_title_2')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Box #3 title</label>
                                    <input type="text"
                                           class="form-control"
                                           name="funfact_number_3"
                                           value="{{$setting->getSettingMeta('funfact_number_3')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Box #3 description</label>
                                    <input type="text"
                                           class="form-control"
                                           name="funfact_title_3"
                                           value="{{$setting->getSettingMeta('funfact_title_3')}}"
                                    >
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
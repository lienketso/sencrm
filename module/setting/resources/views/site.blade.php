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
                    <h3><i class="fa fa-sitemap "></i> Setting</h3>
                    <p>Global settings</p>
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
                    @include('nqadmin-setting::sidebar')

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Global setting for Website
                                </h5>
                            </div>
                            <div class="card-body">

                                {!! \Base\Supports\FlashMessage::renderMessage('edit') !!}

                                <div class="form-group">
                                    <div style="max-width: 300px">
                                        @include('nqadmin-dashboard::components.thumbnail', [
                                        'title' => 'Site Logo',
                                        'name' => 'logo',
                                        'image' => $setting->getSettingMeta('logo')
                                    ])
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Site Name</label>
                                    <input type="text"
                                           class="form-control input-max-length"
                                           autocomplete="off"
                                           name="site_name"
                                           value="{{$setting->getSettingMeta('site_name')}}"
                                           maxlength="80"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Site Title</label>
                                    <input type="text"
                                           class="form-control input-max-length"
                                           autocomplete="off"
                                           name="site_title"
                                           value="{{$setting->getSettingMeta('site_title')}}"
                                           maxlength="80"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Site Keywords</label>
                                    <small class="form-text text-muted">Each keyword is separated by a comma. Up to 5 keywords</small>
                                    <input type="text"
                                           class="form-control input-seo-keyword"
                                           autocomplete="off"
                                           name="site_keywords"
                                           value="{{$setting->getSettingMeta('site_keywords')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Site Description</label>
                                    <input type="text"
                                           class="form-control input-max-length"
                                           autocomplete="off"
                                           name="site_description"
                                           value="{{$setting->getSettingMeta('site_description')}}"
                                           maxlength="160"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Address</label>
                                    <input type="text"
                                           class="form-control"
                                           name="address"
                                           value="{{$setting->getSettingMeta('address')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Skype</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="skype"
                                           value="{{$setting->getSettingMeta('skype')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Link fanpage</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="facebook_fan"
                                           value="{{$setting->getSettingMeta('facebook_fan')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Facebook</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="facebook"
                                           value="{{$setting->getSettingMeta('facebook')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Google Plus</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="googleplus"
                                           value="{{$setting->getSettingMeta('googleplus')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Youtube</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="youtube"
                                           value="{{$setting->getSettingMeta('youtube')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Hotline</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="hotline"
                                           value="{{$setting->getSettingMeta('hotline')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Contact Email</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="email"
                                           value="{{$setting->getSettingMeta('email')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Code header</label>
                                    <textarea class="form-control" name="header_code" rows="4">{{$setting->getSettingMeta('header_code')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Code footer</label>
                                    <textarea class="form-control" name="footer_code" rows="4">{{$setting->getSettingMeta('footer_code')}}</textarea>
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
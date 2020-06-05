@extends('nqadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap-maxlength/src/bootstrap-maxlength.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap-tagsinput/src/bootstrap-tagsinput.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/i18n/vi.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/ckeditor4.8/ckeditor.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap-maxlength/src/init.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap-tagsinput/src/init.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/init.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/ckeditor4.8/init.js')}}"></script>
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
                                <h5 class="card-title">Setting payment
                                </h5>
                            </div>
                            <div class="card-body">

                                {!! \Base\Supports\FlashMessage::renderMessage('edit') !!}

                                <div class="form-group">
                                    <label class="form-control-label">Ngan Luong site ID</label>
                                    <input type="text"
                                           class="form-control"
                                           name="merchan_site_code"
                                           value="{{$setting->getSettingMeta('merchan_site_code')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Ngan Luong secure pass</label>
                                    <input type="text"
                                           class="form-control"
                                           name="secure_pass"
                                           value="{{$setting->getSettingMeta('secure_pass')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Transfer bank ( Thông tin chuyển khoản qua ngân hàng )</label>
                                    <textarea name="transfer_bank" class="form-control ckeditor">{{$setting->getSettingMeta('transfer_bank')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Paypal Mode</label>
                                    <select name="paypal_mode" class="form-control">
                                        <option value="sandbox" @if($setting->getSettingMeta('paypal_mode')=='sandbox') selected="" @endif >Sandbox</option>
                                        <option @if($setting->getSettingMeta('paypal_mode')=='live') selected="" @endif value="live">Live</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Client ID</label>
                                    <input type="text"
                                           class="form-control"
                                           name="paypal_client_id"
                                           value="{{$setting->getSettingMeta('paypal_client_id')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Secret key</label>
                                    <input type="text"
                                           class="form-control"
                                           name="paypal_secret"
                                           value="{{$setting->getSettingMeta('paypal_secret')}}"
                                    >
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
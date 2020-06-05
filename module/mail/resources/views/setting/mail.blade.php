@extends('nqadmin-dashboard::master')

@section('content')

    @inject('setting', 'Setting\Repositories\SettingRepository')
    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Setting</h3>
                    <p>Setting CSGO Boosting</p>
                </div>
            </div>

            {{csrf_field()}}

            <div class="row">
                @include('nqadmin-setting::sidebar')

                <div class="col-sm-12">
                    <div class="row">
                        <form method="post" action="{{route('nqadmin::setting.site.post')}}" class="col-sm-16">
                            {{csrf_field()}}
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Mail Setting
                                    </h5>
                                </div>
                                <div class="card-body">

                                    {!! \Base\Supports\FlashMessage::renderMessage('edit') !!}

                                    @if (count($errors) > 0)
                                        @foreach($errors->all() as $e)
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                <strong>Error!</strong> {{$e}}
                                            </div>
                                        @endforeach
                                    @endif

                                    @if (Session::has('flash_message'))
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                            <strong>Success!</strong> {{Session::get('flash_message')}}
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <h4>SMTP Mail Setting</h4>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Mail System Address</label>
                                        <input type="text"
                                               class="form-control"
                                               autocomplete="off"
                                               name="mail_system"
                                               value="{{$setting->getSettingMeta('mail_system')}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Mail Driver</label>
                                        <input type="text"
                                               class="form-control"
                                               autocomplete="off"
                                               name="mail_driver"
                                               value="{{$setting->getSettingMeta('mail_driver')}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Mail Host</label>
                                        <input type="text"
                                               class="form-control"
                                               autocomplete="off"
                                               name="mail_host"
                                               value="{{$setting->getSettingMeta('mail_host')}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Mail Port</label>
                                        <input type="text"
                                               class="form-control"
                                               autocomplete="off"
                                               name="mail_port"
                                               value="{{$setting->getSettingMeta('mail_port')}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Mail Username</label>
                                        <input type="text"
                                               class="form-control"
                                               autocomplete="off"
                                               name="mail_username"
                                               value="{{$setting->getSettingMeta('mail_username')}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Mail Password</label>
                                        <input type="password"
                                               class="form-control"
                                               autocomplete="off"
                                               name="mail_password"
                                               value="{{$setting->getSettingMeta('mail_password')}}"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Mail Encrypt</label>
                                        <select class="form-control" name="mail_encrypt">
                                            <option value="ssl" {{$setting->getSettingMeta('mail_encrypt') == 'ssl' ? 'selected' : ''}}>SSL</option>
                                            <option value="tls" {{$setting->getSettingMeta('mail_encrypt') == 'tls' ? 'selected' : ''}}>TLS</option>
                                        </select>
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form method="post" action="{{route('nqadmin::setting.mail.post')}}" class="col-sm-16">
                            {{csrf_field()}}
                            <div class="card">
                                <div class="card-body">


                                    <div class="form-group">
                                        <h4>Test Mail Config</h4>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Test mail address</label>
                                        <input type="text"
                                               class="form-control"
                                               autocomplete="off"
                                               name="test_mail_address"
                                               required
                                        >
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Send Test Mail</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
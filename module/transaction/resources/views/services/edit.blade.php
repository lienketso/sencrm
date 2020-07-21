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
                    <h3><i class="fa fa-sitemap "></i> Rank Services</h3>
                    <p>Edit rank services</p>
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
                                <h5 class="card-title">Edit Rank Service <b>{{$data->name}}</b>
                                    @if ($permissions->contains('name','rank_services_index'))
                                        <a href="{{route('transaction')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> List Rank Service
                                        </a>
                                    @endif

                                    @if ($permissions->contains('name','rank_services_create'))
                                        <a href="{{route('nqadmin::rank-services.create.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa plus" aria-hidden="true"></i> Add Rank Service
                                        </a>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Service Name</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="name"
                                           value="{{$data->name}}"
                                           required
                                           id="input_name"
                                           onkeyup="ChangeToSlug();"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Slug</label>
                                    <input type="text"
                                           required
                                           parsley-trigger="change"
                                           class="form-control"
                                           autocomplete="off"
                                           name="slug"
                                           value="{{$data->slug}}"
                                           id="input_slug"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Service Description</label>
                                    <textarea
                                            class="form-control"
                                            name="description"
                                            rows="3"
                                    >{{$data->description}}</textarea>
                                </div>

                                <label class="form-control-label">Select extra Options for this service </label>
                                <div class="form-group">
                                    @foreach ($extra as $ex)
                                        <label class="custom-control custom-checkbox">
                                            <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    value="{{$ex->id}}"
                                                    name="rank_extra[]"
                                                    {{(in_array($ex->id, $selected)) ? 'checked' : ''}}
                                            >
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">{{$ex->name}}</span>
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Action</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Status </label>
                                    <select class="custom-select form-control" name="status">
                                        <option value="active" {{ ($data->status == 'active') ? 'selected' : '' }}>Active</option>
                                        <option value="disable" {{ ($data->status == 'disable') ? 'selected' : '' }}>Disable</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Service type </label>
                                    <select class="custom-select form-control" name="type">
                                        <option value="rank" {{ ($data->type == 'rank') ? 'selected' : '' }}>Rank Boosting</option>
                                        <option value="win" {{ ($data->type == 'win') ? 'selected' : '' }}>Win Boosting</option>
                                        <option value="match" {{ ($data->type == 'match') ? 'selected' : '' }}>Placement Match</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px">Save</button>
                                </div>
                            </div>
                        </div>

                        @include('nqadmin-dashboard::components.thumbnail')
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
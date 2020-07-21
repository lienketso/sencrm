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
                    <h3><i class="fa fa-sitemap "></i> Rank System</h3>
                    <p>Create new Rank</p>
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
                                <h5 class="card-title">Create new Rank
                                    @if ($permissions->contains('name','rank_index'))
                                        <a href="{{route('transaction')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> List Rank
                                        </a>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Rank Title</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="name"
                                           value="{{old('name')}}"
                                           required
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Rank Level</label>
                                    <input type="number"
                                           class="form-control"
                                           autocomplete="off"
                                           name="level"
                                           value="{{old('level')}}"
                                           min="0"
                                           required
                                    >
                                    <small>This is the level of the rank, the rank level is a unique value</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Rank Value</label>
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon">$</div>
                                        <input
                                                type="number"
                                                class="form-control"
                                                value="{{old('value')}}"
                                                name="value"
                                                min="0"
                                                step="0.1"
                                        >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Difficult Point</label>
                                    <input type="number"
                                           class="form-control"
                                           autocomplete="off"
                                           name="hard_level"
                                           value="{{old('hard_level')}}"
                                           min="0"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Boosting per WINS Cost</label>
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon">$</div>
                                        <input
                                                type="number"
                                                class="form-control"
                                                value="{{old('per_win_cost')}}"
                                                name="per_win_cost"
                                                min="0"
                                                step="0.1"
                                        >
                                    </div>
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
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px">Save</button>

                                    @if ($permissions->contains('name','faqs_edit'))
                                        <button class="btn btn-secondary"
                                                type="submit"
                                                name="continue_edit" value="1"
                                                style="margin-top: 20px"
                                        >
                                            Save & Continue
                                        </button>
                                    @endif
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
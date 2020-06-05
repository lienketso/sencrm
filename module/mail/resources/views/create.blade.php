@extends('nqadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/i18n/vi.js')}}"></script>

    <script src="{{asset('adminux/vendor/codemirror/lib/codemirror.js')}}"></script>
    <script src="{{asset('adminux/vendor/codemirror/mode/javascript/javascript.js')}}"></script>
    <script src="{{asset('adminux/vendor/codemirror/addon/selection/active-line.js')}}"></script>
    <script src="{{asset('adminux/vendor/codemirror/addon/edit/matchbrackets.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('adminux/vendor/select2/dist/js/init.js')}}"></script>
    <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,
            theme: 'material'
        });
        var input = document.getElementById("select");
        function selectTheme() {
            var theme = input.options[input.selectedIndex].textContent;
            editor.setOption("theme", theme);
            location.hash = "#" + theme;
        }
        var choice = (location.hash && location.hash.slice(1)) ||
            (document.location.search &&
                decodeURIComponent(document.location.search.slice(1)));
        if (choice) {
            input.value = choice;
            editor.setOption("theme", choice);
        }
        CodeMirror.on(window, "hashchange", function() {
            var theme = location.hash.slice(1);
            if (theme) { input.value = theme; selectTheme(); }
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('adminux/vendor/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminux/vendor/select2/dist/css/select2-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminux/vendor/codemirror/lib/codemirror.css')}}">
    <link rel="stylesheet" href="{{asset('adminux/vendor/codemirror/theme/material.css')}}">
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
                    <h3><i class="fa fa-sitemap "></i> Mail Templates</h3>
                    <p>Create new mail template</p>
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
                                <h5 class="card-title">Create new mail template
                                    @if ($permissions->contains('name','mail_index'))
                                        <a href="{{route('nqadmin::mail.index.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> List mail template
                                        </a>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Template name</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="name"
                                           value="{{old('name')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Template Content</label>
                                    <textarea id="code" name="content"></textarea>
                                    <br>
                                    <div class="notes notes-success" role="alert">
                                        <strong>Tip!</strong> Use the following variables below to add to content<br>
                                        Order Owner: <b>@php echo '{{$owner}}' @endphp</b><br>
                                        Order Type: <b>@php echo '{{$type}}' @endphp</b><br>
                                        Order Rank Start: <b>@php echo '{{$start}}' @endphp</b><br>
                                        Order Rank Desire: <b>@php echo '{{$desire}}' @endphp</b><br>
                                        Order Match: <b>@php echo '{{$match}}' @endphp</b><br>
                                        Order Extra: <b>@php echo '{{$extra}}' @endphp</b><br>
                                        Order Coupon: <b>@php echo '{{$coupon}}' @endphp</b><br>
                                        Order Coupon Description: <b>@php echo '{{$coupon_description}}' @endphp</b><br>
                                        Order Price: <b>@php echo '{{$price}}' @endphp</b><br>
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
                                    <label class="form-control-label">Template Type </label>
                                    <select class="custom-select form-control" name="type">
                                        <option value="order_to_custommer" {{ (old('type') == 'order_to_custommer') ? 'selected' : '' }}>New Order email to Customer</option>
                                        <option value="order_to_admin" {{ (old('type') == 'order_to_admin') ? 'selected' : '' }}>New Order email to Admin</option>
                                        <option value="instructions" {{ (old('type') == 'instructions') ? 'selected' : '' }}>Instructions email</option>
                                        <option value="booster_to_admin" {{ (old('type') == 'booster_to_admin') ? 'selected' : '' }}>Booster Assigned Email to Admin</option>
                                        <option value="booster_to_custommer" {{ (old('type') == 'booster_to_custommer') ? 'selected' : '' }}>Booster Assigned Email to Customer</option>
                                        <option value="order_complete" {{ (old('type') == 'order_complete') ? 'selected' : '' }}>Order Completed</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px">Save</button>

                                    @if ($permissions->contains('name','mail_edit'))
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

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
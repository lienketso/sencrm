@extends('nqadmin-dashboard::master')

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
                    <h3><i class="fa fa-sitemap "></i> Extra Options</h3>
                    <p>Edit extra option</p>
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
                                <h5 class="card-title">Edit Extra Option <b>{{$data->name}}</b>
                                    @if ($permissions->contains('name','extra_create'))
                                        <a href="{{route('nqadmin::extra.create.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-plus" aria-hidden="true"></i>Create Extra Option
                                        </a>
                                    @endif

                                    @if ($permissions->contains('name','extra_index'))
                                        <a href="{{route('nqadmin::extra.index.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> Extra Option
                                        </a>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Extra option name</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="name"
                                           value="{{$data->name}}"
                                           required
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Extra option price type</label>
                                    <select name="price_type" class="form-control">
                                        <option value="percent" {{$data->price_type == 'percent'}}>Percent</option>
                                        <option value="fixed" {{$data->price_type == 'fixed'}}>Fixed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Extra option Value</label>
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon extra-option-currency">
                                            {{$data->price_type == 'percent' ? '%' : '$'}}
                                        </div>
                                        <input type="number" class="form-control" value="{{$data->value}}" name="value" min="0">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Extra option Description</label>
                                    <textarea class="form-control" rows="4" name="description">{{$data->description}}</textarea>
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
        $('select[name="price_type"]').on('click', function (e) {
            var _this = $(e.currentTarget);
            var value = _this.val();
            if (value == 'percent') {
                $('.extra-option-currency').html('%')
            } else {
                $('.extra-option-currency').html('$')
            }
        })
    </script>
@endpush
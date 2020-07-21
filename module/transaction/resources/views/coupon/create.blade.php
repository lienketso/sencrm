@extends('nqadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('adminux/vendor/moment/min/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/moment/min/moment-with-locales.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap4-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('adminux/vendor/bootstrap4-datetimepicker-master/build/js/init.js')}}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('adminux/vendor/bootstrap4-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css')}}">
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
                    <h3><i class="fa fa-sitemap "></i> Coupon</h3>
                    <p>Create new coupon</p>
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
                                <h5 class="card-title">Create new Coupon
                                    @if ($permissions->contains('name','coupon_index'))
                                        <a href="{{route('nqadmin::coupon.index.get')}}" class="btn btn-primary pull-right">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> Coupon
                                        </a>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-control-label">Coupon Code</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           minlength="6"
                                           name="name"
                                           value="{{old('name')}}"
                                           required
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Coupon value type</label>
                                    <select name="type" class="form-control">
                                        <option value="percent">Percent</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Coupon Value</label>
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon extra-option-currency">%</div>
                                        <input type="number" class="form-control" value="{{old('value')}}" name="value" min="0">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Coupon Amount</label>
                                    <input type="number" class="form-control" value="{{old('value')}}" name="amount" min="0">
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Coupon Description</label>
                                    <textarea class="form-control" rows="4" name="description">{{old('description')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Coupon End Date</label>
                                    <input type="text" class="form-control picker" value="{{old('end_date')}}" name="end_date">
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
                                        <option value="active" {{ (old('status') == 'active') ? 'selected' : '' }}>Active</option>
                                        <option value="disable" {{ (old('status') == 'disable') ? 'selected' : '' }}>Disable</option>
                                    </select>
                                </div>

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
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        $('select[name="type"]').on('click', function (e) {
            var _this = $(e.currentTarget);
            var value = _this.val();
            if (value == 'percent') {
                $('.extra-option-currency').html('%')
            } else {
                $('.extra-option-currency').html('$')
            }
        })

        $('.picker').datetimepicker({
            // 'autoclose': true
        });
    </script>
@endpush

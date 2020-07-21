@extends('nqadmin-dashboard::master')

@section('js')
    @include('nqadmin-dashboard::components.datatables.source')
@endsection

@section('js-init')
    @include('nqadmin-dashboard::components.datatables.init')
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
                    <h3><i class="fa fa-sitemap "></i> Đơn hàng</h3>
                    <p>Danh sách đơn hàng</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-16">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Đơn hàng

                            </h5>
                        </div>
                        <div class="card-body">
                            @if (count($errors) > 0)
                                @foreach($errors->all() as $e)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Error!</strong> {{$e}}
                                    </div>
                                @endforeach
                            @endif
                            {!! \Base\Supports\FlashMessage::renderMessage('create') !!}
                            {!! \Base\Supports\FlashMessage::renderMessage('delete') !!}
                            <table class="table" id="">
                                <thead>
                                <tr>
                                    <th width="100">Mã ĐH.</th>
                                    <th width="120">Ngày đặt</th>
                                    <th>Gói sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Tình trạng</th>
                                    <th>Xem đơn hàng</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $d)
                                    <tr class="{{ $loop->index % 2 == 0 ? 'odd' : 'even' }}">
                                        <td><a href="#" target="_blank">#DH{{$d->id}}</a></td>
                                        <td>
                                           {{datetoformat($d->created_at)}}
                                        </td>
                                        <td>{{$d->getPackage->name}}</td>
                                        <td>
                                            <span class="status success">{{number_format($d->amount)}} đ</span>
                                        </td>
                                        <td>
                                            @if($d->status=='disable')
                                            <span class="badge badge-danger">Đợi duyệt</span>
                                            @endif
                                            @if($d->status=='active')
                                                    <span class="badge badge-primary">Đã giao </span>
                                            @endif
                                                @if($d->status=='cancel')
                                                    <span class="status warning">Đã hủy </span>
                                                @endif
                                        </td>
                                        <td><a href="#">Xem ngay</a></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        const _token = $('meta[name=csrf-token]').attr("content");

        $('.editable').on('click', function (e) {
            var _this = $(e.currentTarget);
            var editor = _this.next();
            _this.addClass('d-none');
            editor.removeClass('d-none');
        })

        $('.editable-cancel').on('click', function (e) {
            var _this = $(e.currentTarget);
            var stats = _this.parent().prev();
            _this.parent().addClass('d-none');
            stats.removeClass('d-none');
        })

        $('.editable-save').on('click', function (e) {
            var _this = $(e.currentTarget);
            var input = _this.prev();
            var value = input.val();
            var id = input.attr('data-id');
            var url = input.attr('data-url')
            var stats = _this.parent().prev();
            input.attr('disabled', true);
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token, value, id
                },
            })
            .done(function(resp) {
                stats.html(resp + ' $');
            })
            .always(function(resp) {
                // console.log(resp);
                input.removeAttr('disabled')
                _this.parent().addClass('d-none');
                stats.removeClass('d-none');
            })
        })
    </script>
@endpush
@extends('nqadmin-dashboard::master')

@section('content')
    <div class="wrapper-content">
        <div class="container">
            <div class="row  align-items-center justify-content-between">
                <div class="col-11 col-sm-12 page-title">
                    <h3><i class="fa fa-sitemap "></i> Lịch sử</h3>
                    <p>Danh sách lịch sử hoạt động</p>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-16">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Danh sách lịch sử
                            </h5>
                        </div>
                        <div class="card-body">
                            @if (count($errors) > 0)
                                @foreach($errors->all() as $e)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Lỗi!</strong> {{$e}}
                                    </div>
                                @endforeach
                            @endif
                            {!! \Base\Supports\FlashMessage::renderMessage('create') !!}
                            {!! \Base\Supports\FlashMessage::renderMessage('delete') !!}
                            <table class="table" id="">
                                <thead>
                                <tr>
                                    <th>Hành động</th>
                                    <th>Đường dẫn</th>
                                    <th>Ngày thực hiện</th>
                                    <th>Người thực hiện</th>
                                    <th width="100">Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $d)
                                    <tr class="{{ $loop->index % 2 == 0 ? 'odd' : 'even' }}">
                                        <td>{{$d->request_name}}</td>
                                        <td>{{$d->request_uri}}</td>
                                        <td>{{ showdate_vn($d->created_at) }}</td>
                                        <td class="center">{{ $d->getUsers->fullname }}</td>
                                        <td class="center">
                                            <a href="{{ route('nqadmin::history.view.get',['id'=>$d->id]) }}">Xem thông tin</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            {{$data->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

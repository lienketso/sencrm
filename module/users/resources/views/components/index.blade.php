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
                    <h3><i class="fa fa-sitemap "></i> Thành viên</h3>
                    <p>Danh sách tất cả thành viên</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-16">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Danh sách thành viên
                                @if ($permissions->contains('name','user_create'))
                                <a href="{{route('nqadmin::users.create.get')}}" class="btn btn-primary pull-right">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới tài khoản
                                </a>
                                @endif
                            </h5>
                            <div class="timkiemdi">
                            <form method="get">
                                <input type="text" name="keyword" value="{{request()->get('keyword')}}" placeholder="Tên hoặc số điện thoại" >
                                <button type="submit" name="btntim">Tìm kiếm</button>
                                <a href="{{route('nqadmin::users.index.get')}}"><i class="fa fa-backward"></i> Quay lại</a>
                            </form>
                                <ul class="loc-user">
                                    <li><a title="click để xem" class="dkh" href="{{route('nqadmin::users.index.get',['keyword'=>'active'])}}">Đã kích hoạt ( {{$Uactive}} )</a></li>
                                    <li><a title="click để xem" class="ckh" href="{{route('nqadmin::users.index.get',['keyword'=>'disable'])}}">Chưa kích hoạt ( {{$Udisable}} )</a></li>
                                </ul>
                            </div>

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
                                    <th>Thành viên</th>
                                    <th>Mã giới thiệu</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Vai trò</th>
                                    <th>Trạng thái</th>
                                    <th width="100">Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $d)
                                    <tr class="{{ $loop->index % 2 == 0 ? 'odd' : 'even' }}">
                                        <td style="display: flex">
                                            @if ($d->thumbnail != null)
                                                <img src="{{ asset($d->thumbnail) }}" alt="{{ $d->fullname }}" class="gridpic">
                                            @else
                                                <img src="{{ asset('adminux/img/user-header.png') }}" alt="{{ $d->fullname }}" class="gridpic">
                                            @endif
                                            <p>{{$d->fullname}}</p>
                                        </td>
                                        <td>{{$d->code_name}}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->phone }}</td>
                                        <td class="center">{{ $d->getRole() }}</td>
                                        <td class="center">
                                            {!!  ($d->status=='active') ? '<span class="status success">Đã kích hoạt</span>' : '<span class="status danger">Chưa kích hoạt</span>' !!}
                                        </td>
                                        <td class="center">
                                            @if ($permissions->contains('name','user_edit'))
                                                <a href="{{route('nqadmin::users.edit.get', ['id' => $d->id])}}" class=" btn btn-link btn-sm "><i class="fa fa-edit"></i></a>
                                            @endif

                                            @if (Auth::id() != $d->id && $permissions->contains('name','user_delete'))
                                                <a href="" class="btn btn-link btn-sm" data-toggle="confirmation" data-url="{{route('nqadmin::users.delete.get', $d->id)}}">
                                                    <i class="fa fa-trash-o "></i>
                                                </a>
                                            @endif
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
@extends('nqadmin-dashboard::master')
@section('js')

    <script type="text/javascript" src="{{asset('assets/jorg-charts/jquery.jOrgChart.js')}}"></script>
    <link type="text/css" href="{{asset('assets/jorg-charts/tree.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('assets/jorg-charts/tree.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/jquery-kinetic/jquery.kinetic.js')}}"></script>

@endsection
@section('js-init')

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
                    <h3><i class="fa fa-sitemap "></i> Thành viên nhóm</h3>
                    <p>Danh sách thành viên trong nhóm</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-16">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Danh sách thành viên
                                @if ($permissions->contains('name','member_create'))
                                    <a href="{{route('nqadmin::members.create.get')}}" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới thành viên
                                    </a>
                                @endif
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
                                {!! \Base\Supports\FlashMessage::renderMessage('edit') !!}
                            {!! \Base\Supports\FlashMessage::renderMessage('delete') !!}
                            <table class="table" id="">
                                <thead>
                                <tr>
                                    <th>Thành viên</th>
                                    <th>Email</th>
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
                                        <td>{{ $d->email }}</td>
                                        <td class="center">{{ $d->getRole() }}</td>
                                        <td class="center">
                                            @if($d->status=='disable')
                                            <span class="status danger">Chưa kích hoạt</span>
                                            @else
                                                <span class="status success">Đang sử dụng</span>
                                                @endif
                                        </td>
                                        <td class="center">
                                            @if ($permissions->contains('name','member_edit'))
                                                <a href="{{route('nqadmin::members.edit.get', ['id' => $d->id])}}" class=" btn btn-link btn-sm "><i class="fa fa-edit"></i></a>
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
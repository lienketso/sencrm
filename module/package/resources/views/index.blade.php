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
                    <h3><i class="fa fa-sitemap "></i>Gói {{ ($type=='product') ? 'Sản phẩm' : 'Dịch vụ' }}</h3>
                    <p>Danh sách gói {{ ($type=='product') ? 'Sản phẩm' : 'Dịch vụ' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-16">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Danh sách gói
                                @if ($permissions->contains('name','package_create'))
                                    <a href="{{route('nqadmin::package.create.get')}}" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                                    </a>
                                @endif
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
                            @if(Session::has('message'))
                                <div class="alert alert-danger">
                                    <strong>{{Session::get('message')}}</strong>
                                </div>
                            @endif
                            <table class="table" id="">
                                <thead>
                                <tr>
                                    <th width="10">No.</th>
                                    <th>Tên gói</th>
                                    <th>Giá trị</th>
                                    <th>Nội dung</th>
                                    <th width="100">Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $d)
                                    <tr class="{{ $loop->index % 2 == 0 ? 'odd' : 'even' }}">
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$d->name}}</td>
                                        <td><span style="color: #cc0000">{{number_format($d->price)}}</span></td>
                                        <td><a href="#">Xem nội dung gói</a></td>
                                        <td class="center">
                                            @if ($permissions->contains('name','package_edit'))
                                                <a href="{{route('nqadmin::package.edit.get', ['id' => $d->id])}}" class=" btn btn-link btn-sm "><i class="fa fa-edit"></i></a>
                                            @endif

                                            @if ($permissions->contains('name','package_delete'))
                                                <a href="{{route('nqadmin::package.delete.get',['id'=>$d->id])}}" class="btn btn-link btn-sm" data-toggle="confirmation" data-url="{{route('nqadmin::package.delete.get', $d->id)}}">
                                                    <i class="fa fa-trash-o "></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="container ">

                                    {{$data->links()}}

                                </div>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
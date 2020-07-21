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
                    <h3><i class="fa fa-sitemap "></i> Rank Services</h3>
                    <p>List all rank services in system</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-16">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Rank
                                @if ($permissions->contains('name','rank_services_create'))
                                    <a href="{{route('nqadmin::rank-services.create.get')}}" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add new rank service
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
                            <table class="table" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th width="10">No.</th>
                                    <th width="120">Thumbnail</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th width="200">Extra Options</th>
                                    <th>Status</th>
                                    <th width="100">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $d)
                                    <tr class="{{ $loop->index % 2 == 0 ? 'odd' : 'even' }}">
                                        <td>{{$loop->index + 1}}</td>
                                        <td>
                                            @if (!empty($d->thumbnail))
                                                <img src="{{ asset($d->thumbnail) }}" alt="{{ $d->name }}" class="img-fluid">
                                            @else
                                                <img src="{{ asset('adminux/img/advertise_maxartkiller_ui-ux.png') }}" alt="{{ $d->email }}" class="img-fluid">
                                            @endif
                                        </td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{str_limit($d->description, 75, ' ..')}}</td>
                                        <td>
                                            @foreach ($d->getExtra as $ex)
                                                <label class="status danger">{{$ex->name}}</label>
                                            @endforeach
                                        </td>
                                        <td class="center">
                                            {!! conver_status($d->status) !!}
                                        </td>
                                        <td class="center">
                                            @if ($permissions->contains('name','rank_services_edit'))
                                                <a href="{{route('transaction', ['id' => $d->id])}}" class=" btn btn-link btn-sm "><i class="fa fa-edit"></i></a>
                                            @endif

                                            @if ($permissions->contains('name','rank_services_delete'))
                                                <a href="" class="btn btn-link btn-sm" data-toggle="confirmation" data-url="{{route('nqadmin::rank-services.delete.get', $d->id)}}">
                                                    <i class="fa fa-trash-o "></i>
                                                </a>
                                            @endif
                                        </td>
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
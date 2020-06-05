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
				<h3><i class="fa fa-sitemap "></i> Roles</h3>
				<p>List all roles in system</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-16">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Roles
							@if ($permissions->contains('name','role_create'))
							<a href="{{route('nqadmin::role.create.get')}}" class="btn btn-primary pull-right">
								<i class="fa fa-plus" aria-hidden="true"></i> Add new role
							</a>
							@endif
						</h5>
					</div>
					<div class="card-body">
						@if (count($errors) > 0)
							@foreach($errors->all() as $e)
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
									<strong>Error!</strong> {{$e}}
								</div>
							@endforeach
						@endif
						{!! \Base\Supports\FlashMessage::renderMessage('create') !!}
						{!! \Base\Supports\FlashMessage::renderMessage('delete') !!}
						<table class="table " id="dataTables-example">
							<thead>
								<tr>
									<th width="10">No.</th>
									<th>Role</th>
									<th>Slug</th>
									<th>Description</th>
									<th width="100">Action</th>
								</tr>
							</thead>
							<tbody>

								@foreach($data as $d)
									<tr class="{{ $loop->index % 2 == 0 ? 'odd' : 'even' }}">
										<td>{{$loop->index + 1}}</td>
										<td>{{ $d->display_name }}</td>
										<td>{{ $d->name }}</td>
										<td>{{ $d->description }}</td>
										<td class="center">
											@if ($permissions->contains('name','role_edit'))
											<a href="{{route('nqadmin::role.edit.get', ['id' => $d->id])}}" class=" btn btn-link btn-sm "><i class="fa fa-edit"></i></a>
											@endif

											@if ($roles->roles->first()->id != $d->id && $permissions->contains('name','role_delete'))
												<a href="" class="btn btn-link btn-sm" data-toggle="confirmation" data-url="{{route('nqadmin::role.delete.delete', $d->id)}}">
													<i class="fa fa-trash-o "></i>
												</a>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
@endsection
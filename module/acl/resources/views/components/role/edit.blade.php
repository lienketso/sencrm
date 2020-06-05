@extends('nqadmin-dashboard::master')

@php
	$user = Auth::user();
	$roles = $user->load('roles.perms');
	$permissions = $roles->roles->first()->perms;
@endphp

@section('content')
	<div class="wrapper-content">
		<div class="container">
			<div class="row  align-items-center justify-content-between">
				<div class="col-11 col-sm-12 page-title">
					<h3><i class="fa fa-sitemap "></i> Role</h3>
					<p>Edit role {{$data->display_name}}</p>
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
				
				{!! \Base\Supports\FlashMessage::renderMessage('edit') !!}
				{!! \Base\Supports\FlashMessage::renderMessage('create') !!}
				
				{{csrf_field()}}
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Edit Role

									@if ($permissions->contains('name','role_list'))
									<a href="{{route('nqadmin::role.index.get')}}" class="btn btn-primary pull-right">
										<i class="fa fa-list-ol" aria-hidden="true"></i> List all roles
									</a>
									@endif

									@if ($permissions->contains('name','role_create'))
									<a href="{{route('nqadmin::role.create.get')}}" class="btn btn-primary pull-right">
										<i class="fa fa-plus" aria-hidden="true"></i> Add new role
									</a>
									@endif
								</h5>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="form-group">
										<label class="form-control-label">Role</label>
										<input type="text"
										       required
										       parsley-trigger="change"
										       class="form-control"
										       autocomplete="off"
										       name="display_name"
										       value="{{$data->display_name}}"
										>
									</div>
								</div>
								
								<div class="form-group">
									<div class="form-group">
										<label class="form-control-label">Slug</label>
										<input type="text"
										       required
										       parsley-trigger="change"
										       class="form-control"
										       autocomplete="off"
										       name="name"
										       value="{{$data->name}}"
										       disabled
										>
										<small class="form-text text-muted">Do not use spaces and capitals. Slug will not change</small>
									</div>
								</div>
								
								<div class="form-group">
									<div class="form-group">
										<label class="form-control-label">Description</label>
										<input type="text"
										       class="form-control"
										       autocomplete="off"
										       name="description"
										       value="{{$data->description}}"
										>
									</div>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Set permissions for this role</h5>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover table-bordered">
									<thead>
									<tr>
										<th width="10">No.</th>
										<th>Permission</th>
										<th>Slug</th>
										<th>Description</th>
										<th>Module</th>
										<th width="30"></th>
									</tr>
									</thead>
									<tbody>
										@foreach($perms as $p)
											<tr class="{{ $loop->index % 2 == 0 ? 'odd' : 'even' }}">
												<td>{{$loop->index + 1}}</td>
												<td>{{ $p->display_name }}</td>
												<td>{{ $p->name }}</td>
												<td>{{ $p->description }}</td>
												<td><b>{{$p->module}}</b></td>
												<td class="center">
													<label class="custom-control custom-checkbox">
														<input
															type="checkbox"
															class="custom-control-input"
															name="permission[]"
															value="{!! $p->id !!}"
															{!! (in_array($p->id, $currentPermision)) ? 'checked' : '' !!}
														>
														<span class="custom-control-indicator"></span>
													</label>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="card" id="sticky-block">
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
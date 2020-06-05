@extends('nqadmin-dashboard::master')

@section('content')
	
	<div class="wrapper-content">
		<div class="container">
			<div class="row  align-items-center justify-content-between">
				<div class="col-11 col-sm-12 page-title">
					<h3><i class="fa fa-sitemap "></i> Permission</h3>
					<p>List all permissions in system</p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-16">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Permissions</h5>
						</div>
						<div class="card-body">
							<p>List permissions corresponding to each <b>module</b> in the system</p>
							<div class="table-responsive">
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th width="10">#ID</th>
											<th>Permission</th>
											<th>Description</th>
											<th>Module</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data as $d)
											<tr>
												<td>{{$d->id}}</td>
												<td>{{$d->name}}</td>
												<td>{{$d->description}}</td>
												<td><b>{{$d->module}}</b></td>
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
	</div>
	
@endsection
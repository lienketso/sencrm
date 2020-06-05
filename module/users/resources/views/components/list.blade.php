@extends('nqadmin-dashboard::master')
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
				<h3><i class="fa fa-sitemap "></i> Quản lý thành viên</h3>
				<p>Quản lý thêm, sửa, xóa, phân quyền thành viên, tạo các quyền module</p>
			</div>
		</div>
		<div class="row">
			@if ($permissions->contains('name','user_index'))
			<div class="col-md-8 col-lg-8 col-xl-4">
				<a class="activity-block success" href="{{route('nqadmin::users.index.get')}}">
					<div class="media">
						<div class="media-body">
							<h5>Thành Viên</h5>
						</div>
					</div>
					<br>
					<div class="media">
						<div class="media-body"><span class="progress-heading">Danh sách tất cả thành viên</span></div>
					</div>
					<i class="bg-icon text-center fa fa-users"></i>
				</a>
			</div>
			@endif

			@if ($permissions->contains('name','user_create'))
			<div class="col-md-8 col-lg-8 col-xl-4">
				<a class="activity-block success" href="{{route('nqadmin::users.create.get')}}">
					<div class="media">
						<div class="media-body">
							<h5>Thêm thành viên mới</h5>
						</div>
					</div>
					<br>
					<div class="media">
						<div class="media-body"><span class="progress-heading">Thêm thành viên mới vào hệ thống</span></div>
					</div>
					<i class="bg-icon text-center fa fa-users"></i>
				</a>
			</div>
			@endif

			@if ($permissions->contains('name','role_index'))
			<div class="col-md-8 col-lg-8 col-xl-4">
				<a class="activity-block warning" href="{{route('nqadmin::role.index.get')}}">
					<div class="media">
						<div class="media-body">
							<h5>Vai trò</h5>
						</div>
					</div>
					<br>
					<div class="media">
						<div class="media-body"><span class="progress-heading">Tạo các vai trò của tài khoản</span></div>
					</div>
					<i class="bg-icon text-center fa fa-empire"></i>
				</a>
			</div>
			@endif

			@if ($permissions->contains('name','role_create'))
			<div class="col-md-8 col-lg-8 col-xl-4">
				<a class="activity-block warning" href="{{route('nqadmin::role.create.get')}}">
					<div class="media">
						<div class="media-body">
							<h5>Thêm mới vai trò</h5>
						</div>
					</div>
					<br>
					<div class="media">
						<div class="media-body"><span class="progress-heading">Thêm các vai trò quản trị của tài khoản</span></div>
					</div>
					<i class="bg-icon text-center fa fa-empire"></i>
				</a>
			</div>
			@endif

			@if ($permissions->contains('name','permission_index'))
			<div class="col-md-8 col-lg-8 col-xl-4">
				<a class="activity-block primary" href="{{route('nqadmin::permission.index.get')}}">
					<div class="media">
						<div class="media-body">
							<h5>Quyền tài khoản</h5>
						</div>
					</div>
					<br>
					<div class="media">
						<div class="media-body"><span class="progress-heading">Danh sách các quyền module</span></div>
					</div>
					<i class="bg-icon text-center fa fa-key"></i>
				</a>
			</div>
			@endif
		</div>
	</div>
</div>

@endsection
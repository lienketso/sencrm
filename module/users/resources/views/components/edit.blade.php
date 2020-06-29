@extends('nqadmin-dashboard::master')

@section('js-init')
	<script type="text/javascript" src="{{asset('adminux/js/ajax.js')}}"></script>
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
				<p>Sửa {{$data->email}}</p>
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
							<h5 class="card-title">
								Sửa thông tin thành viên

								@if ($permissions->contains('name','user_index'))
								<a href="{{route('nqadmin::users.index.get')}}" class="btn btn-primary pull-right">
									<i class="fa fa-list-ol" aria-hidden="true"></i> Quay lại danh sách
								</a>
								@endif

								@if ($permissions->contains('name','user_create'))
								<a href="{{route('nqadmin::users.create.get')}}" class="btn btn-primary pull-right">
									<i class="fa fa-plus" aria-hidden="true"></i> Thêm thành viên mới
								</a>
								@endif

							</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label class="form-control-label">Mã người giới thiệu ( Nếu có )</label>
								<input type="text"
									   class="form-control"
									   autocomplete="off"
									   name="affiliate"
									   value="{{$data->affiliate}}"
								>
							</div>
							<div class="form-group">
								<label class="form-control-label">Thuộc nhánh</label>
								<input type="hidden" name="url_member" value="{{route('ajax.users.get')}}">
								<select id="parent" class="selectpicker form-control" name="parent" data-live-search="true">
									<option value="0">Nhánh chính</option>
									@if(!empty($parentCat))
									<option selected="selected" value="{{$parentCat->id}}">{{$parentCat->fullname}}</option>
										@endif
								</select>
							</div>
							<div class="form-group">
								<label class="form-control-label">Email (Sử dụng để đăng nhập)</label>
								<input type="email"
								       required
								       parsley-trigger="change"
								       class="form-control"
								       autocomplete="off"
								       name="email"
								       value="{{$data->email}}"
								       disabled
								>
							</div>
							
							<div class="form-group">
								<label class="form-control-label">Mật khẩu</label>
								<input type="password"
								       class="form-control"
								       autocomplete="off"
								       data-parsley-minlength="6"
								       name="password"
								       id="password"
								       placeholder="Nhập nếu muốn đổi mật khẩu"
								>
							</div>
							
							<div class="form-group">
								<label class="form-control-label">Xác nhận mật khẩu</label>
								<input data-parsley-equalto="#password"
								       type="password"
								       class="form-control"
								       id="re_password"
								       autocomplete="off"
								       data-parsley-minlength="6"
								       name="re_password"
								       placeholder="Nhập nếu muốn đổi mật khẩu"
								>
							</div>
							
							<div class="form-group">
								<label class="form-control-label">Họ và tên</label>
								<input type="text"
								       class="form-control"
								       required
								       data-parsley-pattern="[a-zA-Z0-9\s]+"
								       name="fullname"
								       value="{{$data->fullname}}"
								>
							</div>

							<div class="form-group">
								<label class="form-control-label">Số chứng minh thư / Hộ chiếu</label>
								<input type="text"
									   class="form-control"
									   name="passport"
									   value="{{$data->passport}}"
								>
							</div>
							
							<div class="form-group">
								<label class="form-control-label">Địa chỉ</label>
								<input type="text"
								       class="form-control"
								       name="address"
								       value="{{$data->address}}"
								>
							</div>
							
							<div class="form-group">
								<label class="form-control-label">số điện thoại</label>
								<input type="text"
								       class="form-control"
								       value="{{$data->phone}}"
								       name="phone"
								>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Tùy chọn khác</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
							<select class="form-control" name="status">
								<option value="active" {{ ($data->status == 'active') ? 'selected' : '' }}>Kích hoạt</option>
								<option value="disable" {{ ($data->status == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
							</select>
							</div>
							<div class="form-group">
								<label class="form-control-label">Giới tính</label>
								<select class="form-control" name="gender">
									<option value="male" {{ ($data->gender == 'male') ? 'selected' : '' }}>Male</option>
									<option value="female" {{ ($data->gender == 'female') ? 'selected' : '' }}>Female</option>
									<option value="other" {{ ($data->gender == 'other') ? 'selected' : '' }}>Other</option>
								</select>
							</div>
							@if (Auth::id() != $data->id)
								<div class="form-group">
									<label class="form-control-label">Loại tài khoản</label>
									<select class="form-control" name="role">
										@foreach($role as $r)
											<option value="{{$r->id}}" {{ ($data->roles()->first()->id == $r->id) ? 'selected' : '' }}>{{$r->display_name}}</option>
										@endforeach
									</select>
								</div>
							@else
								<input type="hidden" value="{{$data->roles()->first()->id}}" name="role">
							@endif
							<div class="form-group">
								<label>Ảnh đại diện</label>
								<div class="flex-upload">
								<input type="text" name="thumbnail" class="form-control" id="ckfinder-input-1">
								<button type="button" id="ckfinder-popup-1">Upload</button>
								</div>
								<img src="{{$data->thumbnail}}" alt="" id="imgreview">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary" style="margin-top: 20px">Lưu lại</button>
							</div>
						</div>
					</div>
					

				</div>
			</div>
		</form>
	</div>
</div>

@endsection

@php
	$listRoute = [
		'nqadmin::users.setting.get', 'nqadmin::users.index.get', 'nqadmin::users.create.get', 'nqadmin::users.edit.get',
		'nqadmin::role.index.get', 'nqadmin::role.create.get', 'nqadmin::role.edit.get', 'nqadmin::permission.index.get'
	];

@endphp

<li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
	<a href="{{route('nqadmin::users.setting.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
		<i class="fa fa-users" aria-hidden="true"></i> Quản lý thành viên
	</a>
</li>

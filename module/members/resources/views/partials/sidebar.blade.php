@php
    $listRoute = [
        'nqadmin::members.index.get', 'nqadmin::members.create.get', 'nqadmin::members.edit.get'
    ];

@endphp

<li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('nqadmin::members.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
        <i class="fa fa-users" aria-hidden="true"></i> Hệ thống thành viên
    </a>
</li>

@php
    $listRoute = [
        'nqadmin::package.index.get'
    ];

@endphp

<li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('nqadmin::package.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
        <i class="fa fa-cube" aria-hidden="true"></i> Quản lý gói sản phẩm
    </a>
</li>

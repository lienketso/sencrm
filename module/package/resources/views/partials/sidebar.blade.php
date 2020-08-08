@php
    $listRoute = [
        'nqadmin::package.index.get'
    ];

@endphp

<li class="nav-item"> <a href="javascript:void(0)" class="menudropdown nav-link">
        <i class="fa fa-cube"></i> Quản lý gói <i class="fa fa-angle-down "></i></a>
    <ul class="nav flex-column nav-second-level">
        <li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
            <a href="{{route('nqadmin::package.index.get',['type'=>'product'])}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
                <i class="fa fa-flag-checkered" aria-hidden="true"></i> Sản phẩm
            </a>
        </li>
        <li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
            <a href="{{route('nqadmin::package.index.get',['type'=>'service'])}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
                <i class="fa fa-flag-checkered" aria-hidden="true"></i> Dịch vụ
            </a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>

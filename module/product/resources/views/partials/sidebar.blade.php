@php
    $listRoute = [
        'nqadmin::product.index.get', 'nqadmin::product.create.get', 'nadmin::product.edit.get'
    ];
    $listCate = [
        'nqadmin::category.index.get', 'nqadmin::category.create.get', 'nqadmin::category.edit.get'
    ];

@endphp
<li class="nav-item"> <a href="javascript:void(0)" class="menudropdown nav-link">
        <i class="fa fa-book"></i> Sản phẩm <i class="fa fa-angle-down "></i></a>
    <ul class="nav flex-column nav-second-level">
        <li class="nav-item {{in_array(Route::currentRouteName(), $listCate) ? 'active' : '' }}">
            <a href="{{route('nqadmin::category.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listCate) ? 'active' : '' }}">
                <i class="fa fa-flag-checkered" aria-hidden="true"></i> Danh mục
            </a>
        </li>
        <li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
            <a href="{{route('nqadmin::product.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
                <i class="fa fa-flag-checkered" aria-hidden="true"></i> Sản phẩm
            </a>
        </li>

    </ul>
    <!-- /.nav-second-level -->
</li>


@php
    $listRoute = [
         'nqadmin::transaction.index.get', 'nqadmin::transaction.order.get'
    ];

@endphp
<li class="nav-item"> <a href="javascript:void(0)" class="menudropdown nav-link">
        <i class="fa fa-shopping-cart"></i> Đơn hàng <i class="fa fa-angle-down "></i></a>
    <ul class="nav flex-column nav-second-level">
        <li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
            <a href="{{route('nqadmin::transaction.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
                <i class="fa fa-flag-checkered" aria-hidden="true"></i> Danh sách đơn hàng
            </a>
        </li>


    </ul>
    <!-- /.nav-second-level -->
</li>


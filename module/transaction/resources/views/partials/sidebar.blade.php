@php
    $listRoute = [
        'nqadmin::transaction.index.get'
    ];

@endphp

<li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('nqadmin::transaction.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
        <i class="fa fa-file-text-o" aria-hidden="true"></i> Đơn hàng
    </a>
</li>

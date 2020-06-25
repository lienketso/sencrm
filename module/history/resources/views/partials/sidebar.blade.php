@php
    $listRoute = [
        'nqadmin::history.index.get'
    ];
@endphp

<li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('nqadmin::history.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
        <i class="fa fa-balance-scale" aria-hidden="true"></i> Lịch sử
    </a>
</li>

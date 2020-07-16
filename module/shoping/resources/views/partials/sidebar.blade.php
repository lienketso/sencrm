@php
    $listRoute = [
        'nqadmin::shoping.index.get'
    ];

@endphp

<li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('nqadmin::shoping.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Shoping
    </a>
</li>

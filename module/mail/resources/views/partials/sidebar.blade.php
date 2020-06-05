@php
    $listRoute = [
        'nqadmin::mail.index.get', 'nqadmin::mail.create.get', 'nqadmin::mail.edit.get'
    ];

@endphp
<li class="nav-item {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('nqadmin::mail.index.get')}}" class="nav-link {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
        <i class="fa fa-envelope-o" aria-hidden="true"></i> Mail Template
    </a>
</li>
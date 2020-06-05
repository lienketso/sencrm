@php
    $route = Route::currentRouteName();
@endphp
<div class="nav-item {{$route == 'nqadmin::setting.mail.get' ? 'status-success' : ''}}">
    <a class="nav-link" href="{{route('nqadmin::setting.mail.get')}}">Mail Setting </a>
</div>
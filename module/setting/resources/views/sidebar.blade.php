@php
    $route = Route::currentRouteName();
@endphp
<div class="col-sm-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Danh sách cấu hình</h5>
        </div>
        <div class="card-body">
            <nav class="nav flex-column ">
                <div class="nav-item {{$route == 'nqadmin::setting.site.get' ? 'status-success' : ''}}">
                    <a class="nav-link active" href="{{route('nqadmin::setting.site.get')}}">Cấu hình chung </a>
                </div>

                <div class="nav-item {{$route == 'nqadmin::setting.content.get' ? 'status-success' : ''}}">
                    <a class="nav-link active" href="{{route('nqadmin::setting.content.get')}}">Cấu hình tiếng việt </a>
                </div>

                <div class="nav-item {{$route == 'nqadmin::setting.funfact.get' ? 'status-success' : ''}}">
                    <a class="nav-link active" href="{{route('nqadmin::setting.funfact.get')}}">Cấu hình tiếng anh </a>
                </div>
                <div class="nav-item {{$route == 'nqadmin::setting.payment.get' ? 'status-success' : ''}}">
                    <a class="nav-link active" href="{{route('nqadmin::setting.payment.get')}}">Cấu hình thanh toán </a>
                </div>

                @php do_action('nqadmin-setting-register-menu') @endphp
            </nav>
        </div>
    </div>
</div>
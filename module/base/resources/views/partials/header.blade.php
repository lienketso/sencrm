<header class="navbar-fixed">
	<nav class="navbar navbar-toggleable-md navbar-inverse bg-faded">
		<div class="sidebar-left">
			<a class="navbar-brand imglogo" href="{{route('nqadmin::dashboard.index.get')}}"></a>
			<button class="btn btn-link icon-header mr-sm-2 pull-right menu-collapse" ><span class="fa fa-bars"></span></button>
		</div>
		<div class="d-flex mr-auto"> &nbsp;</div>

		
		@php
			$user = auth('nqadmin')->user();
			$userId = $user->id;
			$avatar = $user->thumbnail;
			$email = $user->email;
			$countCart = \Gloudemans\Shoppingcart\Facades\Cart::count();
		@endphp
		<div class="sidebar-right pull-right " >
			<ul class="navbar-nav  justify-content-end">
				<li class="align-self-center hidden-md-down"> <a href="#" class="btn btn-sm btn-primary mr-2"><span class="fa fa-shopping-basket "></span> Giỏ hàng ( <span id="tonghang">{{ $countCart }}</span> )</a> </li>
				<li class="nav-item">
					<button class="btn-link btn userprofile"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="userpic">
						@if (!empty($user->thumbnail))
							<img src="{{ asset($avatar) }}" alt="user pic">
						@else
							<img src="{{asset('adminux/img/user-header.png')}}" alt="">
						@endif
					</span> <span class="text">{{ $user->fullname }}</span></button>
					<div class="dropdown-menu"> <a class="dropdown-item" href="{{route('nqadmin::users.profile.get',$userId)}}"><i class="fa fa-cogs"></i> Cài đặt tài khoản</a> <a class="dropdown-item" href="#"><i class="fa fa-credit-card-alt"></i> Thông tin thanh toán</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#"><i class="fa fa-sign-out"></i> Thoát</a> </div>
				</li>
				<li><a href="{{ route('nqadmin::auth.logout.get') }}" class="btn btn-link icon-header" ><span class="fa fa-sign-out"></span></a></li>
			</ul>
		</div>
	</nav>
</header>
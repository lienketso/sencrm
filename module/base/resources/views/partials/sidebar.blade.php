<div class="sidebar-left">
	<ul class="nav in" id="side-menu">
		<li  class="nav-item">
			<a class="nav-link" href="{{route('nqadmin::dashboard.index.get')}}"><i class="fa-dashboard fa"></i> Dashboard</a>
		</li>
		@php do_action('nqadmin-register-menu') @endphp
	</ul>
</div>
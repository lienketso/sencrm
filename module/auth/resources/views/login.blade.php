<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Sendatviet Dashboard">
	<meta name="author" content="wiseman">
	<link rel="icon" href="{{ asset('adminux/favicon.ico') }}">
	<title>Sendatviet CRM Login</title>
	<!-- Fontawesome icon CSS -->
	<link rel="stylesheet" href="{{ asset('adminux/vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}" type="text/css">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('adminux/vendor/bootstrap4beta/css/bootstrap.css') }}" type="text/css">
	
	<!-- Adminux CSS -->
	<link rel="stylesheet" href="{{ asset('adminux/css/dark_blue_adminux.css') }}" type="text/css">
</head>
<body class="menuclose menuclose-right">
<figure class="background"> <img src="{{ asset('adminux/img/login_bg.jpg') }}" alt="Adminux- sign in "> </figure>
<!-- Page Loader -->
<div class="loader_wrapper inner align-items-center text-center">
	<div class="load7 load-wrapper">
		<div class="loading_img"></div>
		<div class="loader"> Loading... </div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- Page Loader Ends -->


<header class="navbar-fixed">
	<nav class="navbar navbar-toggleable-md sign-in-header">
		<div class="sidebar-left">  <a class="navbar-brand imglogo" href="index.html"></a> </div>
		<div class="col"></div>
	</nav>
</header>
<div class="wrapper-content-sign-in p-0">
	<div class="col-md-8 offset-md-8 text-left side_signing_full">
		<form class="form-signin1 full_side text-white" method="post">
			{{ csrf_field() }}
			<h2 class="tex-black mb-4">Đăng nhập</h2>
			@if (count($errors) > 0)
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
					<strong>Error !</strong>
					@foreach ($errors->all() as $e)
					<div>{{$e}}</div>
					@endforeach
				</div>
			@endif
			
			<label  class="sr-only">Email</label>
			<input type="text" class="form-control" placeholder="Email" name="email">
			<br>
			<label class="sr-only">Mật khẩu</label>
			<input type="password" class="form-control" placeholder="Password" name="password">
			<br>
			<button type="submit" class="btn btn-lg btn-primary btn-round">Đăng nhập</button> <br>
			<br>
		</form>
		<br>
	</div>
	<footer class="footer-content row  justify-content-between align-items-center">
		<div class="col-sm-8">Developed by <a href="mailto:thanhan.rubee@gmail.com" target="_blank" class="">Rubee</a></div>
	</footer>
</div>


<!-- jQuery first, then Tether, then Bootstrap JS. -->

<script src="{{ asset('adminux/js/jquery-2.1.1.min.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script src="{{ asset('adminux/vendor/bootstrap4beta/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--Cookie js for theme chooser and applying it -->
<script src="{{ asset('adminux/vendor/cookie/jquery.cookie.js') }}"  type="text/javascript"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> <script src="{{ asset('adminux/js/ie10-viewport-bug-workaround.js') }}"></script> <script>
	"use strict";
	$('input[type="checkbox"]').on('change', function(){
		$(this).parent().toggleClass("active")
		$(this).closest(".media").toggleClass("active");
	});
	$(window).on("load", function(){
		/* loading screen */
		$(".loader_wrapper").fadeOut("slow");
	});
</script>
</body>
</html>
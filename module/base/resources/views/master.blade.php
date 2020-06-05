<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="NQAdmin is a dashboard build for individual project">
	<meta name="author" content="lelong310590">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="icon" href="{{ asset('adminux/favicon.ico') }}">
	<title>Sendatviet CRM</title>
	<!-- Fontawesome icon CSS -->
	<link rel="stylesheet" href="{{ asset('adminux/vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}" type="text/css">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('adminux/vendor/bootstrap4beta/css/bootstrap.css') }}" type="text/css">
	
	<!-- DataTables Responsive CSS -->
	<link href="{{ asset('adminux/vendor/datatables/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
	<link href="{{ asset('adminux/vendor/datatables/css/responsive.dataTables.min.css') }}" rel="stylesheet">
	
	<!-- jvectormap CSS -->
	<link href="{{ asset('adminux/vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet">
	
	<!-- Adminux CSS -->
	<link rel="stylesheet" href="{{ asset('adminux/css/light_adminux.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('adminux/bootstrap-select/css/bootstrap-select.css') }}" type="text/css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
	
	@yield('css')
	@stack('css')
	
</head>

<body class="horizontal-menu">
<!-- Page Loader -->
{{--<div class="loader_wrapper align-items-center text-center">--}}
{{--	<div class="load7 load-wrapper">--}}
{{--		<img src="{{ asset('adminux/img/logo.png') }}" alt="" class="loading_img">--}}
{{--		<div class="loader"> Loading... </div>--}}
{{--		<div class="clearfix"></div>--}}
{{--		<br>--}}
{{--		<br>--}}
{{--		<h4 class="text-dark">Please wait a moment</h4>--}}
{{--		<p>The system is loading data ...</p>--}}
{{--	</div>--}}
{{--</div>--}}
<!-- Page Loader Ends -->

@include('nqadmin-dashboard::partials.header')

@include('nqadmin-dashboard::partials.sidebar')

@yield('content')

<!-- jQuery first, then Tether, then Bootstrap JS. -->
@yield('js-react')

<script src="{{ asset('adminux/js/jquery-2.1.1.min.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script src="{{ asset('adminux/vendor/bootstrap4beta/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--Cookie js for theme chooser and applying it -->
<script src="{{ asset('adminux/vendor/cookie/jquery.cookie.js') }}"  type="text/javascript"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('adminux/js/ie10-viewport-bug-workaround.js') }}"></script>

<!-- Circular chart progress js -->
<script src="{{ asset('adminux/vendor/cicular_progress/circle-progress.min.js') }}" type="text/javascript"></script>

<!--sparklines js-->
<script type="text/javascript" src="{{ asset('adminux/vendor/sparklines/jquery.sparkline.min.js') }}"></script>

<!-- spincremente js -->
<script src="{{ asset('adminux/vendor/spincrement/jquery.spincrement.min.js') }}" type="text/javascript"></script>

<!-- custome template js -->
<script src="{{ asset('adminux/js/adminux.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminux/bootstrap-select/js/bootstrap-select.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script src="{{ asset('adminux/bootstrap-confirmation/init.js') }}" type="text/javascript"></script>


@yield('js')
@yield('js-init')
@stack('js')
@stack('js-init')


<!-- parsley js -->
<script src="{{ asset('adminux/parsleyjs/parsley.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminux/parsleyjs/parsley-init.js') }}" type="text/javascript"></script>

<script>
    function check_all() {
        var fmobj = document.theForm;
        for (var i=0;i<fmobj.elements.length;i++) {
            var e = fmobj.elements[i];
            if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
                e.checked = fmobj.allbox.checked;
            }
        }
        return true;
    }
    function xacnhanDelete(){
        var total = 0;
        var fmobj = document.theForm;
        for (var i=0;i<fmobj.elements.length;i++) {
            var e = fmobj.elements[i];
            if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
                if (e.checked) total++;
            }
        }
        if (total==0){
            alert('Chưa có đối tượng nào được chọn!');
            return false;
        }
        if (confirm("Bạn có thực sự muốn xóa [OK]:Yes [Cancel]:No?")) {
            document.theForm.submit();
            return true;
        }
    }

</script>

</body>
</html>
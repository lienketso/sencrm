
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('adminux/favicon.ico') }}">
    <title>Đăng ký tài khoản</title>
    <!-- Fontawesome icon CSS -->
    <link rel="stylesheet" href="{{ asset('adminux/vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}" type="text/css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('adminux/vendor/bootstrap4beta/css/bootstrap.css') }}" type="text/css">

    <!-- Adminux CSS -->
    <link rel="stylesheet" href="{{ asset('adminux/css/dark_blue_adminux.css') }}" type="text/css">
</head>
<body class="menuclose menuclose-right">
<figure class="background_small"> <img src="{{ asset('adminux/img/login_bg.jpg') }}" alt="Adminux- sign in "> </figure>

<header class="navbar-fixed">
    <nav class="navbar navbar-toggleable-md sign-in-header">
        <div class="sidebar-left">  <a class="navbar-brand imglogo" href="index.html"></a> </div>
        <div class="col"></div>
        <div class="sidebar-right pull-right" >
            <ul class="navbar-nav  justify-content-end">
                <li><a href="#" class="btn btn-link text-white" >Hỗ trợ tài khoản ?</a></li>
                <li><a href="#" class="btn btn-primary " >Đăng nhập</a></li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper-content-sign-in ">
    <div class="container text-center">
        <h2 class="display-4 text-white">
            <img src="{{ asset('adminux/img/logosend.png') }}" alt="logo sen đất việt" style="width: 150px">
        </h2>

        <form class="form-signin1 white" method="post">
            {{ csrf_field() }}
            <h2 class="tex-black mb-4" style="color: #0c0c0c">Đăng ký tài khoản</h2>
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <strong>Error !</strong>
                    @foreach ($errors->all() as $e)
                        <div>{{$e}}</div>
                    @endforeach
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <label class="sr-only">Họ và tên</label>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" name="fullname" value="{{old('fullname')}}" class="form-control" placeholder="Họ và tên*">
            </div>
            <br>
            <label class="sr-only">Địa chỉ email ( Sử dụng để đăng nhập )</label>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Địa chỉ email*">
            </div>
            <br>
            <label class="sr-only">Số chứng minh thư / Hộ chiếu</label>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                <input type="text" name="passport" value="{{old('passport')}}" class="form-control" placeholder="Số chứng minh thư / Hộ chiếu">
            </div>
            <br>
            <label class="sr-only">Số điện thoại</label>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Số điện thoại">
            </div>
            <br>
            <label class="sr-only">Mật khẩu</label>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu*">
            </div>
            <br>
            <label class="sr-only">Nhập lại mật khẩu</label>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" name="repassword" class="form-control" placeholder="Nhập lại mật khẩu*">
            </div>
            <br>
            <div class="checkbox">
                <label class="form-check-label active">
                    <input type="checkbox" class="form-check-input">
                    <i class="fa fa-check"></i></label>
                Đồng ý với <a href="#" target="_blank">điều khoản ?</a> </div>
            <button type="submit" class="btn btn-lg btn-primary btn-round">Đăng ký</button><br>
            <a href="" class="btn btn-link mt-2">Quên mật khẩu ?</a>
        </form>
        <p class="mt-3">Bạn đã có tài khoản ? <a href="#" class="text-white">Đăng nhập ngay</a>!</p>
    </div>

</div>


<!-- jQuery first, then Tether, then Bootstrap JS. -->

<script src="{{ asset('adminux/js/jquery-2.1.1.min.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script src="{{ asset('adminux/vendor/bootstrap4beta/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!--Cookie js for theme chooser and applying it -->
<script src="{{ asset('adminux/vendor/cookie/jquery.cookie.js') }}"  type="text/javascript"></script>

<script src="{{ asset('adminux/js/ie10-viewport-bug-workaround.js') }}"></script> <script>
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
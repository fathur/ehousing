<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-HOUSING Back Office - Login</title>
    <link href="{{asset('img/favicon.png')}}" rel="shortcut icon">

    <link href="{{asset('vendor/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    {{--
    <link href="{{asset("/assets/css/plugins/slick/slick.css")}}" rel="stylesheet">
    <link href="{{asset("/assets/css/plugins/slick/slick-theme.css")}}" rel="stylesheet"> --}}

    <link href="{{asset('vendor/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    {{--

    <link href="{{asset("/assets/css/plugins/chartist/chartist.min.css")}}" rel="stylesheet"> --}}
</head>
<body class="gray-bg">
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name"><i class="fa fa-home"></i></h1>
        </div>
        <form class="m-t" role="form" action="{{route('front.auth.reset')}}" method="post">

            @if(Session::has('message'))
                <div class="alert alert-danger alert-dismissable" >
                    <button aria-hidden="true" data-dismiss="alert" class="close"  name="notif-warning" type="button">×</button>
                    {{ Session::get('message') }} <a class="alert-link" href="#"></a>
                </div>
            @endif

            <div class="form-group">
                <em style="font-size:small;color:#A4A4A4;">
                    Ketikkan email, dan kami akan mengirimkan email konfirmasi untuk mereset password.
                </em>
                <br/><br/>
                <input type="text" class="form-control" name="UserEmail" id="UserEmail" placeholder="Email" required="">
            </div>

            <input type="submit" class="btn btn-primary block full-width m-b" value="Kirim">

            <a href="{{ route('front.auth.login') }}"><small>Login</small></a>
        </form>
        <p class="m-t"> <small>E-Housing &copy; 2016</small> </p>
    </div>
</div>
<!-- Mainly scripts -->
<script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-HOUSING | {{ $title }}</title>

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

    @yield('styles')
    @yield('style')
</head>

<body>
<div id="wrapper">

    @include('sidebar')

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="POST" action="#">
                        <div class="form-group">
                            <input type="text" placeholder="Pencarian..." class="form-control" name="search_name" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">

                </ul>
            </nav>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight blog">
           @yield('content')
        </div>

    </div>

    <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    @yield('scripts')
    @yield('script')
</div>
</body>
</html>
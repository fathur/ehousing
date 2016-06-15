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
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap.css')}}">

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

        <div class="footer">
            <div class="pull-right">
                <strong>Copyright</strong> E-Housing Kemenpupra &copy; <?php echo date("Y");?>
            </div>
            <div class="text-navy">
                <strong>E-Housing</strong> :
                <a href="{{ url('/') }}" class='btn-link'>Nasional</a> &bull;
                <a href="{{ url('/') }}" class="btn-link">Aceh</a> &bull;
                <a href="{{ url('/') }}" class="btn-link">Bali</a>  &bull;
                <a href="{{ url('/') }}" class="btn-link">Banten</a>  &bull;
                <a href="{{ url('/') }}" class="btn-link">Bengkulu</a>  &bull;
                <a href="{{ url('/') }}" class="btn-link">DI Yogyakarta</a> &bull;
                <a href="#" class="btn-link" data-toggle="modal" data-target="#more_wilayah">More »</a>
            </div>
        </div>

    </div>


    <div class="modal inmodal" id="more_wilayah" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeInDown">
                <div class="modal-header">
                    <button type="button" class="close hidden" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-map-o modal-icon"></i>
                    <h4 class="modal-title">Daftar Wilayah</h4>
                    Dibawah adalah daftar wilayah yang telah terdaftar ke dalam e-Housing.
                </div>
                <div class="modal-body">
                    <span class="btn btn-primary btn-xs m-b-xs">A</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Aceh</a>
                    <span class="btn btn-primary btn-xs m-b-xs">B</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Bali</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Banten</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Bengkulu</a>
                    <span class="btn btn-primary btn-xs m-b-xs">D</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">DI Yogyakarta</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">DKI Jakarta</a>
                    <span class="btn btn-primary btn-xs m-b-xs">G</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Gorontalo</a>
                    <span class="btn btn-primary btn-xs m-b-xs">J</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Jambi</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Jawa Barat</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Jawa Tengah</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Jawa Timur</a>
                    <span class="btn btn-primary btn-xs m-b-xs">K</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Kalimantan Barat</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Kalimantan Selatan</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Kalimantan Tengah</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Kalimantan Timur</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Kalimantan Utara</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Kepulauan Bangka Belitung</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Kelupauan Riau</a>
                    <span class="btn btn-primary btn-xs m-b-xs">L</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Lampung</a>
                    <span class="btn btn-primary btn-xs m-b-xs">M</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Maluku</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Maluku Utara</a>
                    <span class="btn btn-primary btn-xs m-b-xs">N</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Nusa Tenggara Timur</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Nusa Tenggara Barat</a>
                    <span class="btn btn-primary btn-xs m-b-xs">P</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Papua</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Papua Barat</a>
                    <span class="btn btn-primary btn-xs m-b-xs">R</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Riau</a>
                    <span class="btn btn-primary btn-xs m-b-xs">S</span>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Sulawesi Barat</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Sulawesi Selatan</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Sulawesi Tengah</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Sulawesi Tenggara</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Sulawesi Barat</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Sumatera Barat</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Suamtera Selatan</a>
                    <a href="{{ url('/') }}" class="btn btn-white btn-xs m-b-xs">Sumatera Utara</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Mainly scripts -->
    <script src="{{asset('js/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('vendor/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('js/inspinia.js')}}"></script>
    <script src="{{asset('vendor/PACE/pace.js')}}"></script>

    <!-- Jquery Validate -->
    <script src="{{asset('vendor/jquery-validation/dist/jquery.validate.js')}}"></script>

    <script src="{{asset('vendor/classie/classie.js')}}"></script>
    <script src="{{asset('vendor/wow/dist/wow.js')}}"></script>

    <script src="{{asset('vendor/bootbox.js/bootbox.js')}}"></script>

    <script src="{{asset('vendor/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables/media/js/dataTables.bootstrap.js')}}"></script>


    <script>
        function datatablesDelete(dom) {
            $this = $(dom);

            var     _token  = $this.data('token'),
                    table   = $this.data('table'),
                    url     = $this.data('url'),
                    tableDt;

            if(table != undefined)
                tableDt = $('#' + table).DataTable();

            bootbox.confirm('Apakah Anda yakin ingin menghapus data ini?', function(answer){
                if (answer) {
                    $.post(url, {
                        _method: 'DELETE',
                        _token: _token
                    }, function(resp) {
                        if (resp == '1' ||  resp == 1 || resp == true)
                        {
                            if (table != undefined) {
                                tableDt.ajax.reload(null, false)
                            }
                        }
                    })
                }
            });

        }
    </script>

    @yield('scripts')
    @yield('script')
</div>
</body>
</html>
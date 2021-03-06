@extends('layout')

@section('content')
    <div class="ibox">
        <div class="ibox-content">

            <div class="row">
                <div class="col-md-12">
                    <div class="profile-image">
                        @if($provinsi->konfigurasi_situs->Logo == '')
                            <img src="{{ route('front.file.show', array('profile', 'no-home-image.png')) }}" class="img-circle circle-border m-b-md" alt="profile">
                        @else
                            <img src="{{ route('front.file.show', array('profile', $provinsi->konfigurasi_situs->Logo)) }}" class="img-circle circle-border m-b-md" alt="profile">
                        @endif
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">Provinsi {{{ $provinsi->NamaProvinsi }}}</h2>
                                <h4>{{{ $provinsi->NamaProvinsi }}}</h4>
                                <small>{{{ $provinsi->konfigurasi_situs->Deskripsi }}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="small">
                        <i class="fa fa-eye"> </i> {{{ $provinsi->konfigurasi_situs->JumlahVisit }}}  {{{ $provinsi->konfigurasi_situs->JumlahVisit < 2 ? 'view' : 'views' }}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pull-right">

                        <p><small>Share this article on :</small></p>

                        <button onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]={{ urlencode($title) }}&amp;p[url]={{{ urlencode(Request::url()) }}}', '{{ urlencode($title) }}', 'toolbar=0,status=0,width=550,height=400');" class="btn btn-success btn-outline btn-circle" type="button" title="Facebook"><i class="fa fa-facebook"></i></button>
                        <button onclick="window.open('https://twitter.com/share?url={{{ urlencode(Request::url()) }}}&amp;text={{ urlencode($title) }}&amp;hashtags=kemenpupera', '{{ urlencode($title) }}', 'toolbar=0,status=0,width=550,height=400')" class="btn btn-info btn-outline btn-circle" type="button" title="Twitter"><i class="fa fa-twitter"></i></button>
                        <button onclick="window.open('https://plus.google.com/share?url={{{ urlencode(Request::url()) }}}', '{{ urlencode($title) }}', 'toolbar=0,status=0,width=550,height=400')" class="btn btn-danger btn-outline btn-circle" type="button" title="Google+"><i class="fa fa-google-plus"></i></button>
                        <a href="mailto:?Subject={{ $title }}&amp;Body={{{ urlencode(Request::url()) }}}" class="btn btn-primary btn-outline btn-circle" type="button" title="envelope"><i class="fa fa-envelope"></i></a>

                    </div>
                </div>
            </div>
            <div class="row m-t-sm">
                <div class="col-lg-12">
                    <div class="panel blank-panel">
                        <div class="panel-heading">
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    @if(! is_null($provinsi->konfigurasi_situs->Website))
                                    <li class="active"><a href="#tab-1" data-toggle="tab">Website</a></li>
                                    @endif

                                    @if(! is_null($provinsi->konfigurasi_situs->pendataan))
                                        <li class=""><a href="#tab-2" data-toggle="tab">Pendataan</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="tab-content">


                                @if(! is_null($provinsi->konfigurasi_situs->Website))
                                <div class="tab-pane active" id="tab-1">
                                    <h2>Official Website </h2>
                                    <h3><small><a href="{{$provinsi->konfigurasi_situs->Website}}" target="_blank">{{$provinsi->konfigurasi_situs->Website}}</a></small></h3>

                                    <iframe style="border:0;width:100%;height:500px;margin:0;padding:0;overflow-x: hidden;" align="center" name="frame1" scrolling="auto" src="{{ $provinsi->konfigurasi_situs->Website }}"></iframe>
                                </div>
                                @endif

                                @if(! is_null($provinsi->konfigurasi_situs->pendataan))
                                    <div class="tab-pane active" id="tab-2">
                                        {{$provinsi->konfigurasi_situs->pendataan}}
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
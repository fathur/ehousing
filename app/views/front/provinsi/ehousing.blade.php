@extends('layout')

@section('content')
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-image">
                        @if($data->konfigurasi_situs->Logo == '')
                            <img src="{{ route('front.file.show', array('profile', 'no-home-image.png')) }}" class="img-circle circle-border m-b-md" alt="profile">
                        @else
                            <img src="{{ route('front.file.show', array('profile', $data->konfigurasi_situs->Logo)) }}" class="img-circle circle-border m-b-md" alt="profile">
                        @endif
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins"><i>e-Housing</i> {{{ $data->konfigurasi_situs->Nama }}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
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
                <div class="row m-t-sm">
                    <div class="col-lg-12">
                        <div class="panel blank-panel">
                            <div class="panel-heading">
                                <div class="panel-options">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-2" data-toggle="tab" aria-expanded="false">Struktur Organisasi</a></li>
                                        <li class=""><a href="#tab-4" data-toggle="tab" aria-expanded="false">Tentang Kami</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab-2">
                                        @if(!is_null($data->konfigurasi_situs->StrukturOrg) || $data->konfigurasi_situs->StrukturOrg != '')
                                        <img src="{{ route('front.file.show', ['profile', $data->konfigurasi_situs->StrukturOrg]) }}" alt="{{{$data->konfigurasi_situs->Nama}}}" class="img-responsive">
                                        @endif
                                    </div>

                                    <div class="tab-pane" id="tab-4">
                                        <p>{{{ $data->konfigurasi_situs->tentang_kami }}}</p>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
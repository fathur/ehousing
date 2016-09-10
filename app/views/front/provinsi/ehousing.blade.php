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
                                {{--<small>{{{ $data->konfigurasi_situs->Deskripsi }}}</small>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--
            <div class="row">
                <div class="col-lg-6">
                    <dl class="dl-horizontal">
                        <dt>{{{ number_format($data->profil[0]->TotalPenduduk) }}}</dt> <dd>Total Penduduk (Jiwa)</dd>
                        <dt>{{{ $data->profil[0]->PctPertumbuhanPenduduk }}}</dt> <dd>Pertumbuhan Penduduk per Tahun (%)</dd>
                        <dt>{{{ number_format($data->profil[0]->KepadatanPenduduk) }}}</dt> <dd> Tingkat Kepadatan Penduduk (Jiwa Km²)</dd>
                        <dt>{{{ number_format($data->profil[0]->TotalPendudukMiskinKota) }}}</dt> <dd> Jml Penduduk Miskin Kota</dd>
                        <dt>{{{ number_format($data->profil[0]->TotalPendudukMiskinDesa) }}}</dt> <dd> Jml Penduduk Miskin Desa</dd>
                    </dl>
                </div>
                <div class="col-lg-6" id="cluster_info">
                    <dl class="dl-horizontal" >

                        <dt>{{{ number_format($data->profil[0]->TotalAPBDProv) }}}</dt> <dd>Jml APBD Provinsi {{{ $data->profil[0]->TahunBerlaku }}} (Rp)</dd>
                        <dt>{{{ number_format($data->profil[0]->PajakDaerah) }}}</dt> <dd>Pajak Daerah</dd>
                        <dt>{{{ number_format($data->profil[0]->RetribusiDaerah) }}}</dt> <dd>Retribusi Daerah</dd>
                        <dt>{{{ number_format($data->profil[0]->KekayaanDaerahYgDipisah) }}}</dt> <dd>Pengelolaan Kekayaan Daerah yg Dipisahkan</dd>
                        <dt>{{{ number_format($data->profil[0]->LainLainPADYgSah) }}}</dt> <dd>Lain-lain PAD yg Sah</dd>
                        <dt>{{{ number_format($data->profil[0]->BacklogRumah) }}}</dt> <dd>Backlog Rumah Thn {{{ $data->profil[0]->TahunBerlaku }}} (Unit)</dd>

                    </dl>
                </div>
            </div>
            --}}

            <div class="row">
                <div class="col-lg-6">
                    {{--
                    <div class="small">
                        <i class="fa fa-eye"> </i> 0 view
                    </div>
                    --}}
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
                                        <li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="true">Visi-Misi</a></li>
                                        <li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="false">Struktur Organisasi</a></li>
                                        {{--<li class=""><a href="#tab-3" data-toggle="tab" aria-expanded="false">Mitra</a></li>--}}
                                        <li class=""><a href="#tab-4" data-toggle="tab" aria-expanded="false">Tentang Kami</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">

                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1">
                                        <p>{{ $data->konfigurasi_situs->VisiMisi }}</p>
                                    </div>
                                    <div class="tab-pane" id="tab-2">
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
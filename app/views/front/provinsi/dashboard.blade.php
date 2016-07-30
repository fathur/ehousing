@extends('layout')

@section('content')
    <div class="row m-b-sm m-t-lg">
        <div class="col-md-6">
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
                        <h4>{{{ $provinsi->konfigurasi_situs->Tagline }}}</h4>
                        <small>{{ Str::limit($provinsi->konfigurasi_situs->Deskripsi, 170, '...') }}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table small m-b-xs">
                <tbody>
                <tr>
                    <td>
                        <strong>{{{ number_format($provinsi->konfigurasi_situs->TotalLuas) }}}</strong> Luas Wilayah (Km²)
                    </td>
                    <td>
                        <strong>{{{ number_format($provinsi->profil[0]->TotalPenduduk) }}}</strong> Total Penduduk
                    </td>
                    <td>
                        <strong>{{{ $provinsi->profil[0]->PctPertumbuhanPenduduk }}} %</strong> Pertumbuhan Penduduk /Thn
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{{ number_format($provinsi->profil[0]->TotalPendudukMiskinKota) }}}</strong> Penduduk Miskin Kota
                    </td>
                    <td>
                        <strong>{{{ number_format($provinsi->profil[0]->PajakDaerah) }}}</strong> Pajak Daerah
                    </td>
                    <td>
                        <strong>{{{ number_format($provinsi->profil[0]->TotalPendudukMiskinDesa) }}}</strong> Penduduk Miskin Desa
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{{ number_format($provinsi->profil[0]->KepadatanPenduduk) }}}</strong> Kepadatan Penduduk (Jiwa Km²)
                    </td>
                    <td>
                        <strong>{{{ number_format($provinsi->profil[0]->BacklogRumah) }}}</strong> Backlog Rumah (Unit)
                    </td>
                    <td>
                        <a href="{{ route('front.provinsi.profile', array($provinsi->slug)) }}" class="btn btn-info btn-rounded btn-xs">More Detail</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row m-b-lg m-l-sm text-navy">
        <strong>Wilayah Lain</strong> :
        <a href="{{ url('/') }}" class='btn btn-white btn-xs'>Nasional</a>

        @for($i = 0; $i < 5; $i++)
            <a href="{{ url($allProvinsi[$i]->slug) }}" class="btn btn-white btn-xs">{{ $allProvinsi[$i]->NamaProvinsi }}</a>
        @endfor

        <a href="#" class="btn btn-white btn-xs" data-toggle="modal" data-target="#more_wilayah">More »</a>
    </div>

    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-md-9">

            <div class="jumbotron">
                <h1>e-Housing {{{ $provinsi->NamaProvinsi }}}</h1>
         {{--       <p>{{{  $provinsi->konfigurasi_situs->Deskripsi }}}</p>--}}
                <p>Dirjen Penyediaan Perumahan Kementerian PUPR</p>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <a href="{{ route('front.provinsi.berita.list', array($provinsi->slug)) }}" class="btn-link">
                                <h2><i class="fa fa-newspaper-o"></i> <span class="nav-label">Berita &amp; Aktivitas</span></h2>
                            </a>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                @if($news->count() > 0)
                                    @foreach($news as $item)
                                    <div class="col-sm-6 col-md-4">
                                        <a href="{{ route('front.provinsi.post.show', array($provinsi->slug, $item->slug)) }}" class="btn-link">
                                            <h3>{{{ $item->Judul }}}</h3>
                                        </a>
                                        <div class="small m-b-xs">
                                            <strong>{{{ $item->Nama }}}</strong>
                                            <span class="text-muted">
                                                <i class="fa fa-clock-o"></i> {{{ \Carbon\Carbon::parse($item->CreateDate) }}}
                                            </span>
                                        </div>

                                        <p>
                                            @if(!is_null($item->Foto) || ('' != $item->Foto))
                                                <img class="img-responsive" src="{{ route('front.file.show', array('post', $item->Foto)) }}" />
                                            @else
                                                {{{ Str::limit(strip_tags($item->IsiPost), 200) }}}
                                            @endif
                                        </p>

                                        <div class="small">
                                            <i class="fa fa-eye"> </i> {{{ $item->JumlahVisit > 0 ? $item->JumlahVisit : 0 }}} {{{ $item->JumlahVisit < 2 ? 'view' : 'views' }}}
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="col-sm-12">
                                        Tidak ditemukan data
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h2>
                                <a href="{{ route('front.provinsi.info.list', array($provinsi->slug)) }}" class="btn-link">
                                    <i class="fa fa-th-large"></i>
                                    <span class="nav-label">Teknologi Rancang Bangun</span>
                                </a>
                            </h2>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                @if($information->count() > 0)
                                    @foreach($information as $item)
                                        <div class="col-sm-6 col-md-4">
                                            <a href="{{ route('front.provinsi.post.show', array($provinsi->slug, $item->slug)) }}" class="btn-link">
                                                <h3>{{{ $item->Judul }}}</h3>
                                            </a>
                                            <div class="small m-b-xs">
                                                <strong>{{{ $item->Nama }}}</strong>
                                            <span class="text-muted">
                                                <i class="fa fa-clock-o"></i> {{{ \Carbon\Carbon::parse($item->CreateDate) }}}
                                            </span>
                                            </div>

                                            <p>
                                                @if(!is_null($item->Foto) || ('' != $item->Foto))
                                                    <img class="img-responsive" src="{{ route('front.file.show', array('post', $item->Foto)) }}" />
                                                @else
                                                    {{{ Str::limit(strip_tags($item->IsiPost), 200) }}}
                                                @endif
                                            </p>

                                            <div class="small">
                                                <i class="fa fa-eye"> </i> {{{ $item->JumlahVisit > 0 ? $item->JumlahVisit : 0 }}} {{{ $item->JumlahVisit < 2 ? 'view' : 'views' }}}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-sm-12">
                                        Tidak ditemukan data
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h2>
                                <a href="{{ route('front.provinsi.program.list', array($provinsi->slug)) }}" class="btn-link">
                                    <i class="fa fa-home"></i>
                                    <span class="nav-label">Bantuan &amp; Program Pemerintah</span>
                                </a>
                            </h2>
                            <small>Berikut beberapa bantuan yang telah pemerintah setempat berikan untuk masyarakat, diantaranya:</small>
                            <ul class="todo-list m-t small-list ui-sortable">
                                @foreach($programs as $item)
                                <li>
                                    <a href="{{ route('front.provinsi.post.show', array($provinsi->slug, $item->slug)) }}">
                                        <i class="fa fa-check-square md-icon"></i>
                                        <span class="m-l-xs">{{{ $item->Judul }}}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h2>
                                <a href="{{ route('front.provinsi.file', array($provinsi->slug)) }}" class="btn-link">
                                    <i class="fa fa-book"></i> <span class="nav-label"> Publikasi</span>
                                </a>
                            </h2>
                        </div>

                        <div class="ibox-content">
                            @foreach($files as $item)
                            <h3>
                                <a title="{{$item->Judul}}" href="{{ route('front.file.download', $item->url) }}" >{{{ Str::limit($item->Judul, 50, '...') }}}</a>
                            </h3>

                            <div class="hr-line-dashed"></div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h2><a href="#" class="btn-link"><i class="fa fa-rss"></i> <span class="nav-label">Hunian dalam Media Online</span> </a></h2>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                @foreach($feeds->get_items(0, 6) as $feed)
                                    <div class="col-sm-6 col-md-4">
                                        <a href="{{{ $feed->get_link() }}}" class="btn-link" target="_blank"><h3>{{{ $feed->get_title() }}}</h3></a>
                                        <div class="small m-b-xs">
                                            <strong>{{{ $feeds->get_channel_tags('','title')[0]['data'] }}}</strong>
                                            <span class="text-muted">
                                                <i class="fa fa-clock-o"></i> {{{ $feed->get_date() }}}
                                            </span>
                                        </div>
                                        <p>
                                            @if(\Repositories\Feeds\FeedReader::fileUrlExist($feeds->get_image_url()) || ! is_null($feeds->get_image_url()) || '' == $feeds->get_image_url())
                                            <img class='img-responsive' src='{{{ $feeds->get_image_url() }}}'>
                                            @else
                                                {{{ Str::limit($feed->get_description(), 200) }}}
                                            @endif
                                        </p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-12 col-md-3">

            <div class="list-group">
                <a href="http://ehousing.id/hunian" class="list-group-item active"><i class="fa fa-home"></i> Hunian</a>

                @if($hunian->count() > 0)
                    @foreach($hunian as $item)
                    <a href="#" class='list-group-item'>
                        <span class='pull-right'>
                            <small>{{{ $item->Deskripsi }}}</small>
                        </span> {{{ $item->NamaHunian }}}
                    </a>
                    @endforeach
                @else
                    <span class="list-group-item">Tidak ditemukan data.</span>
                @endif
            </div>

            <div class="list-group">
                <a href="http://ehousing.id/kontak/listkontak/developer" class="list-group-item active">
                    <i class="fa fa-connectdevelop"></i> Developer
                </a>
                @if($developers->count() > 0)
                    @foreach($developers as $item)
                        <a href='#' class='list-group-item'>
                            <span class='pull-right hidden'>
                                <small>{{{ $item->CreateUid }}}</small>
                            </span>{{{ $item->Nama }}}</a>
                    @endforeach
                @else
                    <span class="list-group-item">Tidak ditemukan data.</span>
                @endif
            </div>

            <div class="list-group">
                <a href="http://ehousing.id/kontak/listkontak/desain_arsitek" class="list-group-item active">
                    <i class="fa fa-object-group"></i> Desain &amp; Arsitek
                </a>
                @if($arsitek->count() > 0)
                    @foreach($arsitek as $item)
                        <a href='#' class='list-group-item'>
                            <span class='pull-right hidden'>
                                <small>{{{ $item->CreateUid }}}</small>
                            </span>{{{ $item->Nama }}}</a>
                    @endforeach
                @else
                    <span class="list-group-item">Tidak ditemukan data.</span>
                @endif
            </div>
            <div class="list-group">
                <a href="http://ehousing.id/kontak/listkontak/kontraktor" class="list-group-item active"><i class="fa fa-cogs"></i> Kontraktor</a>
                @if($kontraktor->count() > 0)
                    @foreach($kontraktor as $item)
                        <a href='#' class='list-group-item'>
                            <span class='pull-right hidden'>
                                <small>{{{ $item->CreateUid }}}</small>
                            </span>{{{ $item->Nama }}}</a>
                    @endforeach
                @else
                    <span class="list-group-item">Tidak ditemukan data.</span>
                @endif
            </div>
            <div class="list-group">
                <a href="http://ehousing.id/kontak/listkontak/tukang" class="list-group-item active"><i class="fa fa-user"></i> Tukang</a>
                @if($tukang->count() > 0)
                    @foreach($tukang as $item)
                        <a href='#' class='list-group-item'>
                            <span class='pull-right hidden'>
                                <small>{{{ $item->CreateUid }}}</small>
                            </span>{{{ $item->Nama }}}</a>
                    @endforeach
                @else
                    <span class="list-group-item">Tidak ditemukan data.</span>
                @endif
            </div>
            <div class="list-group">
                <a href="http://ehousing.id/kontak/listkontak/suplier" class="list-group-item active"> <i class="fa fa-support"></i> Suplier</a>
                @if($supplier->count() > 0)
                    @foreach($supplier as $item)
                        <a href='#' class='list-group-item'>
                            <span class='pull-right hidden'>
                                <small>{{{ $item->CreateUid }}}</small>
                            </span>{{{ $item->Nama }}}</a>
                    @endforeach
                @else
                    <span class="list-group-item">Tidak ditemukan data.</span>
                @endif
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <a href="http://ehousing.id/file" class="text-white"><i class="fa fa-download"></i> Unduh File</a>
                </div>
                <div class="panel-body list-group no-margins no-padding">
                    @foreach($files as $item)
                    <a title="{{{ $item->Judul }}}" href="{{ route('front.file.download', $item->url) }}" class="list-group-item">
                        <span class="pull-right">
                            <small>{{{ $item->downloadcounter }}} <i class="fa fa-download"></i></small>
                        </span>{{{ Str::limit($item->Judul, 15) }}}.{{{ $item->fileext }}}
                    </a>
                    @endforeach

            </div>

        </div>

    </div>
@stop
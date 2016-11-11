@extends('layout')

@section('content')

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

            <div class="row">
                <div class="col-xs-12">
                    <div class="pu-nasional-logo-slider ">


                        <div class="carousel slide" id="carousel1">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img alt="image" class="img-responsive" src="{{url('/img/slider/Pic0.jpg')}}">
                                </div>
                                <div class="item">
                                    <img alt="image"  class="img-responsive" src="{{url('/img/slider/Pic1.jpg')}}">
                                </div>
                                <div class="item ">
                                    <img alt="image" class="img-responsive" src="{{url('/img/slider/Pic2.jpg')}}">
                                </div>
                                <div class="item">
                                    <img alt="image" class="img-responsive" src="{{url('/img/slider/Pic3.jpg')}}">
                                </div>
                                <div class="item">
                                    <img alt="image"  class="img-responsive" src="{{url('/img/slider/Pic4.jpg')}}">
                                </div>
                                <div class="item">
                                    <img alt="image"  class="img-responsive" src="{{url('/img/slider/Pic5.jpg')}}">
                                </div>
                                <div class="item">
                                    <img alt="image"  class="img-responsive" src="{{url('/img/slider/Pic6.jpg')}}">
                                </div>
                                <div class="item">
                                    <img alt="image"  class="img-responsive" src="{{url('/img/slider/Pic8.jpg')}}">
                                </div>
                                <div class="item">
                                    <img alt="image"  class="img-responsive" src="{{url('/img/slider/Pic9.jpg')}}">
                                </div>
                                <div class="item">
                                    <img alt="image"  class="img-responsive" src="{{url('/img/slider/Pic10.jpg')}}">
                                </div>

                               

                            </div>
                            <div class="darken"></div>
                            <a data-slide="prev" href="#carousel1" class="left carousel-control">
                                <span class="icon-prev"></span>
                            </a>
                            <a data-slide="next" href="#carousel1" class="right carousel-control">
                                <span class="icon-next"></span>
                            </a>
                            <div class="clearfix"></div>

                        </div>
                        <div class="jumbotron pu-nasional-logo">
                            <div class="logo">
                                <img src="{{asset('img/logo-pupr-300.jpg')}}" alt="PUPR" style="height: 100px; height: 100px;">
                            </div>
                            <div class="text">
                                <h1>e-Housing</h1>
                                <p><strong>Direktorat Jenderal Penyediaan Perumahan</strong><br/>
                                    Kementerian Pekerjaan Umum dan Perumahan Rakyat</p>
                            </div>

                            <div class="clearfix"></div>

                        </div>


                        <div class="clearfix"></div>


                    </div>

                    <div class="clearfix"></div>

                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h2><a href="{{route('front.nasional.berita.list')}}" class="btn-link"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Informasi Publik</span> </a></h2>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                @if($news->count() > 0)
                                    @foreach($news as $item)
                                        <div class="col-sm-6 col-md-4">
                                            <a href="{{url('post/' . $item->slug)}}" class="btn-link">
                                                <h3>{{{ $item->Judul }}}</h3>
                                            </a>
                                            <div class="small m-b-xs">
                                                <strong>{{{ $item->Nama }}}</strong>
                                            <span class="text-muted">
                                                <i class="fa fa-clock-o"></i> {{{ \Carbon\Carbon::parse($item->CreateDate) }}}
                                            </span>
                                            </div>

                                            <p>
                                                @if('' != $item->Foto)
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
                                <a href="{{route('front.nasional.info.list')}}" class="btn-link">
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
                                            <a href="{{url('post/' . $item->slug)}}" class="btn-link">
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
                                <a href="{{route('front.nasional.program.list')}}" class="btn-link">
                                    <i class="fa fa-home"></i>
                                    <span class="nav-label">Program & Kegiatan</span>
                                </a>
                            </h2>
                            <small>Berikut beberapa bantuan yang telah pemerintah setempat berikan untuk masyarakat, diantaranya:</small>
                            <ul class="todo-list m-t small-list ui-sortable">
                                @foreach($programs as $item)
                                    <li>
                                        <a href="{{url('post/' . $item->slug)}}">
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
                                <a href="{{route('front.nasional.file.penelitian')}}" class="btn-link">
                                    <i class="fa fa-book"></i> <span class="nav-label"> Hasil Penelitian/Kajian</span>
                                </a>
                            </h2>
                        </div>

                        <div class="ibox-content">
                            @foreach($files as $item)
                                <h3>
                                    <a title="{{$item->Judul}}" href="{{ route('front.file.download', array($item->url)) }}">{{{ Str::limit($item->Judul, 50, '...') }}}</a>
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
                                        <a href="{{{ $feed->get_link() }}}" class="btn-link" target="_blank"><h3>{{ strip_tags(html_entity_decode($feed->get_title())) }}</h3></a>
                                        <div class="small m-b-xs">
                                            <strong>{{{ strip_tags($feeds->get_channel_tags('','title')[0]['data']) }}}</strong>
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


                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color: #1C84C6; color: #FFFFFF;">
                                <h5>Backlog</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{{ number_format($nasional->backlog) }}}</h1>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color: #1AB394; color: #FFFFFF;">
                                <h5>RTLH</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{{ number_format($nasional->rtlh) }}}</h1>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="background-color: #ED5565; color: #FFFFFF;">
                                <h5>Sejuta Rumah</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{{ number_format($nasional->sejuta_rumah) }}}</h1>

                            </div>
                        </div>
                    </div>

                </div>


            <div class="list-group">
                <a href="#" class="list-group-item active"><i class="fa fa-home"></i> Hunian Rusunawa</a>

                @if($hunianRusunSewa->count() > 0)
                    @foreach($hunianRusunSewa as $item)
                        <a href="{{route('front.nasional.hunian.show', $item->slug)}}" class='list-group-item'>
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
                <a href="#" class="list-group-item active"><i class="fa fa-home"></i> Hunian Rusunami</a>

                @if($hunianRusunami->count() > 0)
                    @foreach($hunianRusunami as $item)
                        <a href="{{route('front.nasional.hunian.show', $item->slug)}}" class='list-group-item'>
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
                <a href="#" class="list-group-item active"><i class="fa fa-home"></i> Hunian Rumah Khusus</a>

                @if($hunianRumahSubsidi->count() > 0)
                    @foreach($hunianRumahSubsidi as $item)
                        <a href="{{route('front.nasional.hunian.show', $item->slug)}}" class='list-group-item'>
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
                <a href="#" class="list-group-item active"><i class="fa fa-home"></i> Hunian Rumah Umum dan Komersial</a>

                @if($hunianRumahSubsidi->count() > 0)
                    @foreach($hunianRumahSubsidi as $item)
                        <a href="{{route('front.nasional.hunian.show', $item->slug)}}" class='list-group-item'>
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
                <a href="#" class="list-group-item active"><i class="fa fa-home"></i> Apartemen</a>

                @if($hunianApartemen->count() > 0)
                    @foreach($hunianApartemen as $item)
                        <a href="{{route('front.nasional.hunian.show', $item->slug)}}" class='list-group-item'>
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
                <a href="#" class="list-group-item " style="background-color: #1C84C6;
    border-color: #1ab394;
    color: #FFFFFF;
    z-index: 2;"><i class="fa fa-home"></i> Produk Hukum</a>

                @if($kebijakanFiles->count() > 0)
                    @foreach($kebijakanFiles as $item)
                        <a href="{{route('front.file.download', $item->url)}}" class='list-group-item'>
                            {{{ Str::limit($item->Judul, 50, '...') }}}
                        </a>
                    @endforeach
                @else
                    <span class="list-group-item">Tidak ditemukan data.</span>
                @endif
            </div>

        </div>
@stop
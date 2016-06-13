@extends('layout')

@section('content')
    <div class="row article">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="pull-right">
                        <button class="btn btn-white btn-xs" type="button">Info</button>
                        <button class="btn btn-white btn-xs" type="button">Publikasi</button>
                        <button class="btn btn-white btn-xs" type="button">Berita</button>
                    </div>
                    <div class="text-center article-title">
                        <span class="text-muted">
                            <i class="fa fa-clock-o"></i> {{{ $post->CreateDate }}}
                        </span>
                        <h1>{{{ $post->Judul }}}</h1>
                    </div>

                    @if($post->Foto != '')
                    <center>
                        <img class="img-responsive m-b-lg" src="{{ route('front.file.show', array('post', $post->Foto)) }}">
                    </center>
                    @endif

                    <p>{{ $post->IsiPost }}</p>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="small">
                                <h5>Stats:</h5>
                                <i class="fa fa-eye"> </i> {{{ ($post->JumlahVisit > 0) ? $post->JumlahVisit : 0 }}} {{{ ($post->JumlahVisit < 2) ? 'view' : 'views' }}}
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">

                            <p><small>Share this article on :</small></p>

                            <button onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]={{ urlencode($post->Judul) }}&amp;p[url]={{{ urlencode(Request::url()) }}}', '{{ urlencode($post->Judul) }}', 'toolbar=0,status=0,width=550,height=400');" class="btn btn-success btn-outline btn-circle" type="button" title="Facebook"><i class="fa fa-facebook"></i></button>
                            <button onclick="window.open('https://twitter.com/share?url={{{ urlencode(Request::url()) }}}&amp;text={{ urlencode($post->Judul) }}&amp;hashtags=kemenpupera', '{{ urlencode($post->Judul) }}', 'toolbar=0,status=0,width=550,height=400')" class="btn btn-info btn-outline btn-circle" type="button" title="Twitter"><i class="fa fa-twitter"></i></button>
                            <button onclick="window.open('https://plus.google.com/share?url={{{ urlencode(Request::url()) }}}', '{{ urlencode($post->Judul) }}', 'toolbar=0,status=0,width=550,height=400')" class="btn btn-danger btn-outline btn-circle" type="button" title="Google+"><i class="fa fa-google-plus"></i></button>
                            <a href="mailto:?Subject={{ $post->Judul }}&amp;Body={{{ urlencode(Request::url()) }}}" class="btn btn-primary btn-outline btn-circle" type="button" title="envelope"><i class="fa fa-envelope"></i></a>

                        </div>

                </div>
            </div>
        </div>
    </div>
@stop
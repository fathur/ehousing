@extends('layout')

@section('content')
    <div class="row white-bg" style="    margin-top: -20px;
    margin-left: -25px;
    margin-right: -25px;
    margin-bottom: 20px;">
        <div class="col-xs-12">
            <h2 style="font-weight: 100; padding: 2px 0 16px 0;">{{$postTitle}}</h2>
        </div>
    </div>
    <div class="row">

        @foreach($posts as $post)
        <div class="col-sm-6 col-md-4">
            <div class="ibox">
                <div class="ibox-content">

                    @if(isset($type) AND $type == 'nasional')
                        <a href="{{ route('front.nasional.post.show', array($post->slug)) }}" class="btn-link">
                            <h2>{{{ $post->Judul }}}</h2>
                        </a>
                    @else
                    <a href="{{ route('front.provinsi.post.show', array($provinsi->slug, $post->slug)) }}" class="btn-link">
                        <h2>{{{ $post->Judul }}}</h2>
                    </a>
                    @endif

                    <div class="small m-b-xs">
                        <strong>{{{ $post->user->Nama }}}</strong>
                        <span class="text-muted">
                            <i class="fa fa-clock-o"></i> {{{ $post->CreateDate }}}
                            <i class="fa fa-eye"></i> {{{ ($post->JumlahVisit > 0) ? $post->JumlahVisit : 0 }}} {{{ ($post->JumlahVisit < 2) ? 'view' : 'views' }}}
                        </span>
                    </div>

                    <p>
                        @if($post->Foto != null || $post->Foto != '')
                            <img class='img-responsive' src='{{ route('front.file.show', array('post', $post->Foto)) }}'>
                        @else
                            {{{ strip_tags(Str::limit($post->IsiPost, 250)) }}}
                        @endif
                    </p>

                </div>
            </div>
        </div>
        @endforeach

    </div>
@stop
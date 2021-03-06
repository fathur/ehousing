@extends('layout')

@section('content')
    <div class="col-md-4">
        <div class="ibox float-e-margins">

            <div class="ibox-content no-padding border-left-right">
                <img alt="image" class="img-responsive" src="{{ route('front.file.show', array('hunian', $hunian->picture)) }}">
            </div>

            <div class="ibox-content profile-content">
                <h4><strong>{{{ $hunian->Nama }}}</strong></h4>

                @if(!empty($hunian->Koordinat))
                <div id="map" style="width: 100%; height: 200px"></div>
                @endif

                <p class="m-t-sm text-center small">
                    <i class="fa fa-map-marker"></i> {{{ $hunian->Alamat }}}
                </p>
                <h5>About Us</h5>
                <p>
                    {{{ $hunian->referensi->Deskripsi }}}
                </p>
                <div class="user-button">
                    <div class="row">
                        <div class="col-md-6">
                            @if(!empty($hunian->Email) || !is_null($hunian->Email) || '' !== $hunian->Email)
                                <a type="button" class="btn btn-primary btn-sm btn-block" href="mailto:{{$hunian->Email}}">
                                    <i class="fa fa-envelope"></i> Kirim Pesan
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Profile Detail</h5>
            </div>

            <div class="ibox-content">
                <div class="m-b-md">
                    <h2>{{{ $hunian->NamaHunian ? $hunian->NamaHunian : '-' }}}</h2>
                </div>
                <dl class="dl-horizontal">
                    <dt>Jenis Hunian:</dt> <dd><span class="label label-primary">{{{ ($hunian->referensi->Deskripsi) ? $hunian->referensi->Deskripsi : '-' }}}</span></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Alamat :</dt> <dd> {{{ ($hunian->Alamat) ? $hunian->Alamat : '-' }}}</dd>
                    <dt>Website :</dt> <dd> {{{ ($hunian->Website) ? $hunian->Website : '-' }}}</dd>
                    <dt>Email :</dt> <dd> {{{ ($hunian->Email) ? $hunian->Email : '-' }}}</dd>
                    <dt>Nama Pengembang :</dt>
                    <dd>
                        @if(isset($hunian->nama_pengembang))
                            {{{ $hunian->nama_pengembang }}}
                        @else
                            -
                        @endif
                    </dd>
                </dl>
                <div class="row">
                    <div class="col-lg-5">
                        <dl class="dl-horizontal">
                            <dt>Jumlah Unit :</dt> <dd> {{{ ($hunian->JumlahUnit) ? $hunian->JumlahUnit : '-' }}}</dd>
                            <dt>Jumlah Lantai :</dt> <dd> {{{ ($hunian->JumlahLantai) ? $hunian->JumlahLantai : '-' }}}</dd>

                        </dl>
                    </div>
                    <div class="col-lg-7" id="cluster_info">
                        <dl class="dl-horizontal">
                        </dl>
                    </div>
                </div>

                <div class="row m-t-sm">
                    <div class="col-lg-12">
                        <div class="panel blank-panel">
                            <div class="panel-heading">
                                <div class="panel-options">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1" data-toggle="tab">Website</a></li>
                                        @if(!empty($hunian->Tab2))
                                            <li class=""><a href="#tab2" data-toggle="tab">{{{$hunian->Tab2}}}</a></li>
                                        @endif

                                        @if(!empty($hunian->Tab3))
                                            <li class=""><a href="#tab3" data-toggle="tab">{{{$hunian->Tab3}}}</a></li>
                                        @endif

                                        @if(!empty($hunian->Tab4))
                                            <li class=""><a href="#tab4" data-toggle="tab">{{{$hunian->Tab4}}}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        @if(!empty($hunian->Website))
                                            <h2>Official Website</h2>

                                            <iframe style="border:0;width:100%;height:500px;margin:0;padding:0;overflow-x: hidden;"
                                                    align="center"
                                                    name="frame1"
                                                    scrolling="auto"
                                                    src="{{{ $hunian->Website }}}"></iframe>
                                        @else
                                            <div class="alert alert-info">Tidak ditemukan data.</div>
                                        @endif
                                    </div>

                                    @if(!empty($hunian->LinkExternal2))
                                        <div class="tab-pane" id="tab2">
                                            {{ $hunian->LinkExternal2 }}

                                        </div>
                                    @endif

                                    @if(!empty($hunian->LinkExternal3))
                                        <div class="tab-pane" id="tab3">
                                           {{  $hunian->LinkExternal3 }}

                                        </div>
                                    @endif

                                    @if(!empty($hunian->LinkExternal4))

                                        <div class="tab-pane" id="tab4">
                                            {{   $hunian->LinkExternal4 }}

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?signed_in=false&callback=initMap"></script>
@stop

@section('script')
    <script>
        @if(!empty($hunian->Koordinat))
        function initMap() {
            var myLatLng = {
                lat: {{{ $latitude }}},
                lng: {{{ $longitude }}}
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: "{{{ $hunian->NamaHunian }}}"
            });
        }
        @endif
    </script>
@stop
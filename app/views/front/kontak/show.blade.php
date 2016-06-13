@extends('layout')

@section('content')
    <div class="col-md-3">
        <div class="ibox float-e-margins">
            <div class="ibox-content no-padding border-left-right">
                <img alt="image" class="img-responsive" src="http://ehousing.id/assets/img/no-pict_profile_big.jpg">
            </div>
            <div class="ibox-content profile-content text-center">
                <h4><strong>{{{ $kontak->Nama }}}</strong></h4>
                <p><i class="fa fa-map-marker"></i> {{{ $kontak->Alamat }}}</p>
                <div class="user-button">
                    @if(!empty($kontak->Email) || !is_null($kontak->Email) || '' !== $kontak->Email)
                        <a type="button" class="btn btn-primary btn-sm btn-block" href="mailto:{{$kontak->Email}}">
                            <i class="fa fa-envelope"></i> Kirim Pesan
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Profile Detail</h5>
            </div>

            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="m-b-md">
                            <h2>{{{ $kontak->Nama }}}</h2>
                        </div>
                        <dl class="dl-horizontal">
                            <dt>Tipe Kontak :</dt> <dd><span class="label label-primary">{{{ $kontak->JenisKontak }}} {{{ !empty($kontak->IsCorporate) ? 'Personal' : 'Corporate' }}}</span></dd>
                        </dl>
                    </div>
                </div>
                <dl class="dl-horizontal">
                    <dt>Status : </dt> <dd>
                        @if(!empty($kontak->TglVerifikasi))
                            <span class="label label-success">Terverifikasi</span>
                        @else
                            <span class="label label-danger">Belum Terverifikasi</span>
                        @endif
                    </dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Deskripsi :</dt> <dd>{{{ $kontak->Deskripsi ? $kontak->Deskripsi : '-' }}}</dd>
                    <dt>Kompetensi :</dt> <dd>{{{ $kontak->Kompetensi ? $kontak->Kompetensi : '-' }}}</dd>
                    <dt>Alamat :</dt> <dd>{{{ $kontak->Alamat ? $kontak->Alamat : '-' }}}</dd>
                </dl>
                <div class="row">
                    <div class="col-lg-6">
                        <dl class="dl-horizontal">
                            <dt>Telp :</dt> <dd>{{{ $kontak->Telp ? $kontak->Telp : '-' }}}</dd>
                            <dt>HP :</dt> <dd>{{{ $kontak->NoHP ? $kontak->NoHP : '-' }}}</dd>
                        </dl>
                    </div>
                    <div class="col-lg-6" id="cluster_info">
                        <dl class="dl-horizontal">
                            <dt>Email :</dt> <dd>{{{ $kontak->Email ? $kontak->Email : '-' }}}</dd>
                            <dt>Website :</dt>
                            <dd>
                                @if($kontak->Website)
                                <a href="{{$kontak->Website}}" target="_blank">{{$kontak->Website}}</a>
                                @else
                                    -
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <dl class="dl-horizontal">
                            <dt>Tgl Registrasi :</dt> <dd>{{{ $kontak->CreateDate ? $kontak->CreateDate  : '-' }}}</dd>
                        </dl>
                    </div>

                    @if(!empty($kontak->TglVerifikasi))
                    <div class="col-lg-6" id="cluster_info">
                        <dl class="dl-horizontal" >
                            <dt>Tgl Verifikasi :</dt> <dd> {{{ $kontak->TglVerifikasi ? $kontak->TglVerifikasi : '-' }}}</dd>
                        </dl>
                    </div>
                    @endif
                </div>
                <div class="row m-t-sm">
                    <div class="col-lg-12">
                        <div class="panel blank-panel">
                            <div class="panel-heading">
                                <div class="panel-options">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="false">Galeri</a></li>
                                        @if($kontak->JenisKontak == 'DEV')
                                        <li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="true">Daftar Pembangunan Hunian</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1">
                                        <div class="alert alert-info">Tidak ditemukan data.</div>
                                    </div>

                                    @if($kontak->JenisKontak == 'DEV')
                                    <div class="tab-pane" id="tab-2">
                                        <table class="table table-stripped" data-page-size="8">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Nama Hunian</th>
                                                <th>Jenis Hunian</th>
                                                <th>Nama Pengembang</th>
                                                <th>Website</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($kontak->hunian as $hunian)
                                            <tr>
                                                <td>
                                                    <div class="team-members">
                                                        @if(isset($type) && $type == 'nasional')
                                                            <a href="{{route('front.nasional.hunian.show', array($hunian->slug))}}">
                                                                <!--img src="http://ehousing.id/uploads/hunian/no-home-image.png" class="img-circle m-b-md" alt="no-image" -->
                                                                <img src="{{$hunian->picture}}" class="img-circle m-b-md" alt="{{$hunian->picture}}">
                                                            </a>
                                                        @else
                                                            <a href="{{route('front.provinsi.hunian.show', array($provinsi->slug, $hunian->slug))}}">
                                                                <!--img src="http://ehousing.id/uploads/hunian/no-home-image.png" class="img-circle m-b-md" alt="no-image" -->
                                                                <img src="{{$hunian->picture}}" class="img-circle m-b-md" alt="{{$hunian->picture}}">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if(isset($type) && $type == 'nasional')
                                                        <a href="{{route('front.nasional.hunian.show', array($hunian->slug))}}">{{{ $hunian->NamaHunian }}}</a>
                                                    @else
                                                        <a href="{{route('front.provinsi.hunian.show', array($provinsi->slug, $hunian->slug))}}">{{{ $hunian->NamaHunian }}}</a>
                                                    @endif
                                                    <small><br>{{{ $hunian->Alamat }}}</small>

                                                </td>
                                                <td>{{{ $hunian->JenisHunian }}}</td>
                                                <td>{{{ $kontak->Nama }}}</td>
                                                <td>
                                                    <small><br><a href="{{ $hunian->Website }}" target="_blank">{{ $hunian->Website }}</a></small>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
@extends('layout')

@section('styles')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{{ $dekonTitle }}} - Data Administratif</h5>
                </div>
                <div class="ibox-content">

                    <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th width="30px;">No</th>
                            <th>Rincian Data</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Sumber Data</th>
                        </tr>

                        @foreach($data['administratif'] as $administratif)
                        <tr>
                            <td>{{$administratif['no']}}.</td>
                            <td>{{$administratif['title']}}</td>
                            <td>{{$administratif['jumlah']}}</td>
                            <td>{{$administratif['satuan']}}</td>
                            <td>{{$administratif['sumber']}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{{ $dekonTitle }}} - Kelembagaan Perumahan dan Permukiman</h5>
                </div>
                <div class="ibox-content">

                    <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th width="30px;">No</th>
                            <th>Keterangan</th>
                            <th>Uraian</th>
                        </tr>

                        @foreach($data['kelembagaan'] as $kelembagaan)
                            <tr>
                                <td>{{$kelembagaan['no']}}.</td>
                                <td>{{$kelembagaan['keterangan']}}</td>
                                <td>{{$kelembagaan['uraian']}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{{ $dekonTitle }}} - Stakeholder Pembangunan perumahan dan permukiman</h5>
                </div>
                <div class="ibox-content">

                    <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th width="30px;">No</th>
                            <th>Asosiasi Perumahan</th>
                            <th>Jumlah pengembang/developer terdaftar</th>
                        </tr>

                        @foreach($data['stakeholder'] as $stakeholder)
                            <tr>
                                <td>{{$stakeholder['no']}}.</td>
                                <td>{{$stakeholder['asosiasi']}}</td>
                                <td>{{$stakeholder['jumlah']}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{{ $dekonTitle }}} - Alokasi APBD untuk urusan perumahan</h5>
                </div>
                <div class="ibox-content">

                    <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th>Uraian</th>
                            <th>2010 (Rp Juta)</th>
                            <th>2011 (Rp Juta)</th>
                            <th>2012 (Rp Juta)</th>
                            <th>2013 (Rp Juta)</th>
                            <th>2014 (Rp Juta)</th>
                            <th>2015 (Rp Juta)</th>
                            <th>2016 (Rp Juta)</th>
                        </tr>

                        <tr>
                            <td>Total APBD Provinsi</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    </table>

                    <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Jenis Kegiatan Urusan Perumahan</th>
                            <th colspan="2">TA. 2010</th>
                            <th colspan="2">2012 (Rp Juta)</th>
                            <th colspan="2">2013 (Rp Juta)</th>
                            <th colspan="2">2014 (Rp Juta)</th>
                            <th colspan="2">2015 (Rp Juta)</th>
                            <th colspan="2">2016 (Rp Juta)</th>
                        </tr>
                        <tr>
                            <th>Volume</th>
                            <th>Biaya</th>
                            <th>Volume</th>
                            <th>Biaya</th>
                            <th>Volume</th>
                            <th>Biaya</th>
                            <th>Volume</th>
                            <th>Biaya</th>
                            <th>Volume</th>
                            <th>Biaya</th>
                            <th>Volume</th>
                            <th>Biaya</th>
                        </tr>

                        <tr>
                            <td>Total APBD Provinsi</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    </table>

                    <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th>Uraian</th>
                            <th>2017 (Rp Juta)</th>
                            <th>2018 (Rp Juta)</th>
                            <th>2019 (Rp Juta)</th>
                        </tr>

                        <tr>
                            <td>Rencana Alokasi APBD Provinsi Urusan Perumahan</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{{ $dekonTitle }}} - Backlog Perumahan</h5>
                </div>
                <div class="ibox-content">

                    <h4>1. Jumlah rumah berdasarkan fungsinya</h4>

                    <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th>No</th>
                            <th>Fungsi Rumah</th>
                            <th>Jumlah</th>
                            <th>Sumber Data</th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>Rumah Tinggal</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Rumah Campuran</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    </table>

                    <h4>2. Jumlah rumah berdasarkan Status Kepemilikan Tempat Tinggal</h4>

                    <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th>No</th>
                            <th>Fungsi Rumah</th>
                            <th>Jumlah</th>
                            <th>Sumber Data</th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>Rumah Tinggal</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Rumah Campuran</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    </table>

                    <h4>3. Jenis Fisik Bangunan Rumah</h4>

                    <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th>No</th>
                            <th>Fungsi Rumah</th>
                            <th>Jumlah</th>
                            <th>Sumber Data</th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>Rumah Tinggal</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Rumah Campuran</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop

@section('script')
@stop
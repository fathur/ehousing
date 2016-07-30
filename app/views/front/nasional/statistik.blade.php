@extends('layout')

@section('content')


    <div class="row">
        <div class="col-lg-6">
            <div class="ibox">

                <div class="ibox-title">
                    <h5>10 Provinsi berdasarkan Backlog Terbanyak</h5>
                </div>

                <div class="ibox-content">
                    <div id="backlog-statistic"></div>



                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>10 Provinsi berdasarkan Anggaran Kemenpupera Tertinggi</h5>
                </div>
                <div class="ibox-content">
                    <div id="anggaran-statistic"></div>


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Data Nasional</h5>
                </div>
                <div class="ibox-content">
                    <div class="row m-b">
                        <div class="col-sm-8">
                            <form method="GET" action="{{route('front.nasional.statistik')}}">
                                {{ Form::select('kolom', $fields, Input::get('kolom','TotalPenduduk'), array('id'=>'kolom','class'=> 'form-control','style' => 'width:250px;float:left;margin-right:5px;')) }}
                                {{ Form::select('tahun', $years, Input::get('tahun'), array('id'=>'tahun','class'=> 'form-control','style' => 'width:250px;float:left;margin-right:5px;')) }}
                                <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                            </form>
                        </div>

                        <div class="col-sm-4">
                            <div class="pull-right">
                                <button id="show-table" type="button" class="btn btn-info"><i class="fa fa-table"></i></button>
                                <button id="show-chart" type="button" class="btn btn-danger"><i class="fa fa-signal"></i></button>
                            </div>
                        </div>

                    </div>


                    <div id="data-table" class="hidden">
                        <table class="table table-responsive table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Provinsi</th>
                                <th class="text-right">Jumlah</th>
                            </tr>
                            </thead>

                            <tbody>

                            @for($i = 0; $i < count($dataFilter); $i++)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{{ $dataFilter[$i]['name'] }}}</td>
                                    <td class="text-right">
                                        @if(is_null($dataFilter[$i]['y']))
                                            0
                                        @else
                                            {{{ number_format($dataFilter[$i]['y']) }}}
                                        @endif
                                    </td>

                                </tr>
                            @endfor

                            </tbody>
                        </table>
                    </div>
                    <div id="data-chart">
                        <div id="filter-statistic"></div>

                       
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop


@section('scripts')
    <script src="{{asset('vendor/highcharts/highcharts.js')}}"></script>
    <script src="{{asset('vendor/highcharts/themes/sand-signika.js')}}"></script>
@stop

@section('script')
    <script>
        $('#backlog-statistic').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: '10 Provinsi berdasarkan Backlog Terbanyak'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Provinsi'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                data: {{ $dataBacklog }}
            }],

            credits: {
                enabled: false
            },
        });

        $('#anggaran-statistic').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: '10 Provinsi berdasarkan Anggaran Kemenpupera Tertinggi'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Provinsi'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                data: {{ $dataAnggaran }}
            }],

            credits: {
                enabled: false
            },
        });

        $('#filter-statistic').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: '.'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Provinsi'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                data: {{ $filterStatistic }}
            }],

            credits: {
                enabled: false
            },
        });

        $("#show-chart").click(function(e) {
            $("#data-table").addClass("hidden");
            $("#data-chart").removeClass("hidden");
        });

        $("#show-table").click(function(e) {
            $("#data-table").removeClass("hidden");
            $("#data-chart").addClass("hidden");
        });

    </script>
@stop
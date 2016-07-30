<div class="row">

    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right hidden">Annual</span>
                <h5>Alokasi Anggaran Pusat</h5>
            </div>
            <div class="ibox-content">
                @if(! is_null($totalAnggaran))
                    <h1 class='no-margins'>
                        {{{ bytesConvert($totalAnggaran->jumlah) }}}
                    </h1>
                    <small>Rp. {{{ number_format($totalAnggaran->jumlah) }}}</small>
                @else
                    Tidak ada data
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right hidden">Monthly</span>
                <h5>Backlog Rumah</h5>
            </div>
            <div class="ibox-content">
                @if(! is_null($totalBackLog))
                    <h1 class='no-margins'>
                        {{{ bytesConvert($totalBackLog->jumlah) }}}
                    </h1>
                    <small>Rp. {{{ number_format($totalBackLog->jumlah) }}}</small>
                @else
                    Tidak ada data
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right hidden">Annual</span>
                <h5>Jumlah Rumah</h5>
            </div>
            <div class="ibox-content">
                @if(! is_null($totalJumlahRumah))
                    <h1 class='no-margins'>
                        {{{ bytesConvert($totalJumlahRumah->jumlah) }}}
                    </h1>
                    <small>Rp. {{{ number_format($totalJumlahRumah->jumlah) }}}</small>
                @else
                    Tidak ada data
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right hidden">Annual</span>
                <h5>APBD Provinsi</h5>
            </div>
            <div class="ibox-content">
                @if(! is_null($totalAPBD))
                    <h1 class='no-margins'>
                        {{{ bytesConvert($totalAPBD->jumlah) }}}
                    </h1>
                    <small>Rp. {{{ number_format($totalAPBD->jumlah) }}}</small>
                @else
                    Tidak ada data
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="ibox">

            <div class="ibox-title">
                <h5>Statistik Backlog per Tahun</h5>
            </div>

            <div class="ibox-content">
                <div id="backlog-statistic"></div>

                <div class="small">
                    Sumber:
                    <ul>
                        @foreach($statistikBackLogSrc as $src)
                            <li>{{$src}}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Statistik Anggaran Kemenpupera per Tahun</h5>
            </div>
            <div class="ibox-content">
                <div id="anggaran-statistic"></div>

                <div class="small">
                    Sumber:
                    <ul>
                        @foreach($statistikAnggaranSrc as $src)
                            <li>{{$src}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Statistik {{{ $fields[$kolom] }}} Provinsi {{{ ucwords(strtolower($provinsi->NamaProvinsi)) }}}</h5>
            </div>
            <div class="ibox-content">
                <div class="row m-b">
                    <div class="col-sm-8">
                        <form method="GET" action="{{route('front.provinsi.statistik', array($provinsi->slug))}}">
                            {{ Form::select('kolom', $fields, Input::get('kolom','TotalPenduduk'), array('id'=>'kolom','class'=> 'form-control','style' => 'width:250px;float:left;margin-right:5px;')) }}
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
                                <th>Tahun</th>
                                <th class="text-right">Jumlah</th>
                                <th>Last Update</th>
                            </tr>
                        </thead>

                        <tbody>

                            @for($i = 0; $i < count($filterStatistic->showResults()); $i++)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{{ $filterStatistic->showResults()[$i]->TahunBerlaku }}}</td>
                                <td class="text-right">
                                    @if(is_null($filterStatistic->showResults()[$i]->jumlah))
                                        0
                                    @else
                                    {{{ number_format($filterStatistic->showResults()[$i]->jumlah) }}}
                                    @endif
                                </td>
                                <td>
                                @if($filterStatistic->showResults()[$i]->last_update != '0000-00-00 00:00:00')
                                    {{{Carbon\Carbon::parse($filterStatistic->showResults()[$i]->last_update)->format('d M Y H:i:s')}}}
                                @endif
                                </td>
                            </tr>
                            @endfor

                        </tbody>
                    </table>
                </div>

                <div id="data-chart">
                    <div id="filter-statistic"></div>

                    <div class="small">
                        Sumber:
                        <ul>
                            @foreach($filterStatisticSrc as $src)
                                <li>{{$src}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{asset('vendor/highcharts/highcharts.js')}}"></script>
    <script src="{{asset('vendor/highcharts/themes/sand-signika.js')}}"></script>
@stop

@section('script')
    <script>
        $('#backlog-statistic').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Statistik Backlog per Tahun'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Tahun'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                data: {{ $statistikBackLog->toHighcharts() }}
            }]
        });

        $('#anggaran-statistic').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Statistik Anggaran Kemenpupera per Tahun'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Tahun'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                data: {{ $statistikAnggaran->toHighcharts() }}
            }]
        });

        $('#filter-statistic').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Statistik {{{ $fields[$kolom] }}} Provinsi {{{ ucwords(strtolower($provinsi->NamaProvinsi)) }}}'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Tahun'
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                data: {{ $filterStatistic->toHighcharts() }}
            }]
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
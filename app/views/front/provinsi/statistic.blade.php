<div class="row">
    <div class="col-lg-6">
        <div class="ibox">

            <div class="ibox-title">
                <h5>Statistik Backlog per Tahun</h5>
            </div>

            <div class="ibox-content">
                <div id="backlog-statistic"></div>
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
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Statistik Total APBD Provinsi {{{ ucwords(strtolower($provinsi->NamaProvinsi)) }}}</h5>
            </div>
            <div class="ibox-content">
                <div class="row m-b">
                    <div class="col-sm-8">
                        <form method="POST" action="http://ehousing.id/home/statistik/provinsi">
                            <select class="form-control hidden" name="Provinsi" id="Provinsi" style="width:200px;float:left;margin-right:5px;">
                                <option value="11">ACEH</option><option value="51">BALI</option><option value="36">BANTEN</option><option value="17">BENGKULU</option><option value="34">DI YOGYAKARTA</option><option value="31">DKI JAKARTA</option><option value="75">GORONTALO</option><option value="15">JAMBI</option><option value="32">JAWA BARAT</option><option value="33">JAWA TENGAH</option><option value="35">JAWA TIMUR</option><option value="61">KALIMANTAN BARAT</option><option value="63">KALIMANTAN SELATAN</option><option value="62">KALIMANTAN TENGAH</option><option value="64">KALIMANTAN TIMUR</option><option value="65">KALIMANTAN UTARA</option><option value="19">KEPULAUAN BANGKA BELITUNG</option><option value="21">KEPULAUAN RIAU</option><option value="18">LAMPUNG</option><option value="81">MALUKU</option><option value="82">MALUKU UTARA</option><option value="52">NUSA TENGGARA BARAT</option><option value="53">NUSA TENGGARA TIMUR</option><option value="94">PAPUA</option><option value="91">PAPUA BARAT</option><option value="14">RIAU</option><option value="76">SULAWESI BARAT</option><option value="73">SULAWESI SELATAN</option><option value="72">SULAWESI TENGAH</option><option value="74">SULAWESI TENGGARA</option><option value="71">SULAWESI UTARA</option><option value="13">SUMATERA BARAT</option><option value="16">SUMATERA SELATAN</option><option value="12">SUMATERA UTARA</option>							</select>
                            <select class="form-control" name="kolom" id="kolom" style="width:250px;float:left;margin-right:5px;">
                                <option value="TotalPenduduk">TotalPenduduk</option><option value="TotalPria">TotalPria</option><option value="TotalWanita">TotalWanita</option><option value="PctPertumbuhanPenduduk">PctPertumbuhanPenduduk</option><option value="KepadatanPenduduk">KepadatanPenduduk</option><option value="TotalPendudukMiskinKota">TotalPendudukMiskinKota</option><option value="TotalPendudukMiskinDesa">TotalPendudukMiskinDesa</option><option selected="selected" value="TotalAPBDProv">TotalAPBDProv</option><option value="TotalPADProv">TotalPADProv</option><option value="PajakDaerah">PajakDaerah</option><option value="RetribusiDaerah">RetribusiDaerah</option><option value="KekayaanDaerahYgDipisah">KekayaanDaerahYgDipisah</option><option value="LainLainPADYgSah">LainLainPADYgSah</option><option value="BacklogRumah">BacklogRumah</option><option value="JumlahRT">JumlahRT</option><option value="AnggaranKemenpera">AnggaranKemenpera</option>							</select>
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
                                <th class="text-right">Total APBD Prov</th>
                            </tr>
                        </thead>

                        <tbody>

                            @for($i = 0; $i < count($statistikAPBD->showResults()); $i++)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{{ $statistikAPBD->showResults()[$i]->TahunBerlaku }}}</td>
                                <td class="text-right">
                                    @if(is_null($statistikAPBD->showResults()[$i]->jumlah))
                                        0
                                    @else
                                    {{{ number_format($statistikAPBD->showResults()[$i]->jumlah) }}}
                                    @endif
                                </td>
                            </tr>
                            @endfor

                        </tbody>
                    </table>
                </div>

                <div id="data-chart">
                    <div id="apbd-statistic"></div>
                </div>
                <h6 class="no-margins">Sumber : <strong>BPS (Badan Pusat Statistik)</strong></h6>
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

        $('#apbd-statistic').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Statistik Total APBD Provinsi {{{ ucwords(strtolower($provinsi->NamaProvinsi)) }}}'
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
                data: {{ $statistikAPBD->toHighcharts() }}
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
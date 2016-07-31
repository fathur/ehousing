@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{{ $kontakTitle }}}</h5>
                </div>
                <div class="ibox-content">

                    @if(isset($listCities))
                        <div class="row m-b-sm">
                            <div class="col-xs-12">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label for="kota" style="font-weight: normal;">Kota / Kabupaten</label>
                                        {{ Form::select('filter-kota', $listCities, null, array('class' => "form-control", 'id' => "kota", 'onchange' => 'refreshDt()')) }}
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                            <table class="table table-hover table-striped" id="hunian-datatables">
                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Nama</th>
                                    <th>Jenis Kontak</th>
                                    <th>No. Telp</th>
                                    <th>Email</th>
                                    <th>Kompetensi</th>
                                    <th>Kota/Kabupaten</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('vendor/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables/media/js/dataTables.bootstrap.js')}}"></script>
@stop

@section('script')
    <script>
        $('#hunian-datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ $datatablesRoute }}",
                data: function(params) {

                    @if(isset($provinsi))
                    params.provinsi = '{{{ $provinsi->id }}}';
                    @endif

                    params.jenis = '{{{ $jenis }}}';

                    params.kota = $('#kota').val();

                }
            },
            columns: [
                {data:'KontakId',name:'KontakId'},
                {data:'Nama',name:'Nama'},
                {data:'JenisKontak',name:'JenisKontak'},
                {data:'NoTelp',name:'NoTelp'},
                {data:'Email',name:'Email'},
                {data:'Kompetensi',name:'Kompetensi'},
                {data:'NamaKota',name:'kota.NamaKota'},
                {data:'TglVerifikasi',name:'TglVerifikasi'}

            ]
        });

        function refreshDt()
        {
            $('#hunian-datatables').DataTable().ajax.reload();
        }
    </script>
@stop
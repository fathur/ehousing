@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{{ $fileTitle }}}</h5>
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
                            <table class="table table-hover table-striped" id="hunian-datatables">
                                <thead>
                                <tr>
                                    <th>Nama File</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Format File</th>
                                    <th>Size</th>
                                    <th>Kota/Kabupaten</th>
                                    <th>Banyak Unduh</th>
                                </tr>
                                </thead>
                            </table>
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

                    @if(isset($jenis))
                    params.jenis = '{{{ $jenis }}}';
                    @endif

                    params.kota = $('#kota').val();

                }
            },
            columns: [
                {data:'filename',name:'filename'},
                {data:'description',name:'description'},
                {data:'categoryfile',name:'categoryfile'},
                {data:'fileext',name:'fileext'},
                {data:'file_size',name:'file_size'},
                {data:'NamaKota',name:'kota.NamaKota'},
                {data:'downloadcounter',name:'downloadcounter'}

            ]
        });

        function refreshDt()
        {
            $('#hunian-datatables').DataTable().ajax.reload();
        }
    </script>
@stop
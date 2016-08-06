@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{{ $linkTitle }}}</h5>
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
                                    <th>Judul</th>
                                    <th>URL</th>
                                    <th>Group</th>
                                    <th>Kota/Kabupaten</th>

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

                    params.jenis = '{{{ $jenis }}}';
                    params.kota = $('#kota').val();

                }
            },
            columns: [
                {data:'Judul',name:'Judul'},
                {data:'LinkInfo',name:'LinkInfo'},
                {data:'GrupLinkInfo',name:'GrupLinkInfo'},
                {data:'NamaKota',name:'kota.NamaKota'}
            ]
        });

        function refreshDt()
        {
            $('#hunian-datatables').DataTable().ajax.reload();
        }
    </script>
@stop
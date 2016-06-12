@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Daftar Kontak</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover table-striped" id="hunian-datatables">
                        <thead>
                        <tr>
                            <th>Judul</th>
                            <th>URL</th>
                            <th>Group</th>
                        </tr>
                        </thead>
                    </table>
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
                url: "{{route('front.provinsi.link.data')}}",
                data: function(params) {
                    params.provinsi = '{{{ $provinsi->id }}}';
                    params.jenis = '{{{ $jenis }}}';
                }
            },
            columns: [
                {data:'Judul',name:'Judul'},
                {data:'LinkInfo',name:'LinkInfo'},
                {data:'GrupLinkInfo',name:'GrupLinkInfo'}

            ]
        });
    </script>
@stop
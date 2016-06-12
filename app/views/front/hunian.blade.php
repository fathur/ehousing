@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Daftar Hunian</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover table-striped" id="hunian-datatables">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Hunian</th>
                            <th>Jenis Hunian</th>
                            <th>Nama Pengembang</th>
                            <th>Hunian</th>
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
                url: "{{route('front.provinsi.hunian.data')}}",
                data: function(params) {
                    params.provinsi = '{{{ $provinsi->id }}}';
                    params.jenis = '';
                }
            },
            columns: [
                {data:'HunianId',name:'HunianId'},
                {data:'NamaHunian',name:'NamaHunian'},
                {data:'JenisHunian',name:'JenisHunian'},
                {data:'Nama',name:'kontak.Nama'},
                {data:'Website',name:'hunian.Website'}

            ]
        });
    </script>
@stop
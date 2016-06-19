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
                    <table class="table table-hover table-striped" id="{{$identifier}}-datatables">
                        <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Nama</th>
                            <th>Jenis Kontak</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Kompetensi</th>
                            <th>Status</th>
                            <th>Action</th>
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
        $('#{{$identifier}}-datatables').DataTable({
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
                }
            },
            columns: [
                {data:'KontakId',name:'KontakId'},
                {data:'Nama',name:'Nama'},
                {data:'JenisKontak',name:'JenisKontak'},
                {data:'NoTelp',name:'NoTelp'},
                {data:'Email',name:'Email'},
                {data:'Kompetensi',name:'Kompetensi'},
                {data:'TglVerifikasi',name:'TglVerifikasi'},
                {data:'action',name:'action',searchable:false,orderable:false}

            ]
        });
    </script>
@stop
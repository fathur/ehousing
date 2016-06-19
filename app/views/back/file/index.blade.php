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
                            <th>Nama File</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Format File</th>
                            <th>Size</th>
                            <th>Banyak Unduh</th>
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
                {data:'Judul',name:'Judul'},
                {data:'description',name:'description'},
                {data:'categoryfile',name:'categoryfile'},
                {data:'fileext',name:'fileext'},
                {data:'file_size',name:'file_size'},
                {data:'downloadcounter',name:'downloadcounter'},
                {data:'action',name:'action',searchable:false, orderable:false},

            ]
        });
    </script>
@stop
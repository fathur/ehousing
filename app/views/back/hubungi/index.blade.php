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
                    <table class="table table-hover table-striped" id="{{$identifier}}-datatables">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Alamat</th>
                            <th>Provinsi</th>
                            <th>Telp</th>
                            <th>Handphone</th>
                            <th>Email</th>
                            <th>Pesan</th>
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

                }
            },
            columns: [
                {data:'Nama',name:'Nama'},
                {data:'KlasifikasiPengajuan',name:'KlasifikasiPengajuan'},
                {data:'Alamat',name:'Alamat'},
                {data:'NamaProvinsi',name:'NamaProvinsi'},
                {data:'NoTelp',name:'NoTelp'},
                {data:'NoHP',name:'NoHP'},
                {data:'Email',name:'Email'},
                {data:'Deskripsi',name:'Deskripsi'},
                {data:'statusid',name:'statusid'},
                {data:'action',name:'action',searchable:false,orderable:false}

            ]
        });
    </script>
@stop
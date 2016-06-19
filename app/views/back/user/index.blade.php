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
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Provinsi</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
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
                {data:'UserName',name:'UserName'},
                {data:'Nama',name:'Nama'},
                {data:'Region',name:'Region'},
                {data:'NamaProvinsi',name:'NamaProvinsi'},
                {data:'UserStatus',name:'UserStatus'},
                {data:'action',name:'action',searchable:false,orderable:false}

            ]
        });
    </script>
@stop
@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Daftar Hunian</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover table-striped" id="{{{ $identifier }}}-datatables">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Diposting oleh</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#{{{ $identifier }}}-datatables').DataTable({
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
                {data:'KategoriId',name:'KategoriId', searchable:false},
                {data:'NamaKategori',name:'NamaKategori'},
                {data:'Judul',name:'Judul'},
                {data:'user_nama',name:'user.Nama'},
                {data:'action',name:'action',searchable:false,orderable:false},
            ]
        });
    </script>
@stop
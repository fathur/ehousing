@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="ibox">
                <div class="ibox-content">


                    @if(Session::has('status'))
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert alert-{{{ Session::get('class') }}}" role="alert">
                                {{{ Session::get('status') }}}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-4">
                            <h3>Ingin menghubungi kami?</h3>

                            <p>Silahkan isi formulir berikut ini</p>

                            <p class="text-center">
                                <i class="fa fa-sign-in big-icon"></i>
                            </p>
                        </div>

                        <div class="col-sm-8 b-l">
                            <form method="post" action="{{route('front.nasional.call.store')}}" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nama">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="Nama" class="form-control" id="nama">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="notelp" class="col-sm-2 control-label">NoTelp</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="NoTelp" class="form-control" id="notelp">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nohp" class="col-sm-2 control-label">NoHP</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="NoHP" class="form-control" id="nohp">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="Email" class="form-control" id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="provinsi" class="col-sm-2 control-label">Provinsi</label>
                                    <div class="col-sm-10">
                                        {{Form::select('KodeProvinsi', $provinces, null, array('class' => 'form-control m-b'))}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="Alamat" rows="3" id="alamat"></textarea >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="jenispesan">Klasifikasi</label>
                                    <div class="col-sm-10">
                                        {{ Form::select('KlasifikasiPengajuan', $jenis, null, array('class' => 'form-control m-b', 'id' => 'jenispesan')) }}

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="pesan">Pesan</label>
                                    <div class="col-sm-10">
                                        <textarea id="pesan" class="form-control" name="Deskripsi" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Attachment</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="attachment" placeholder="Select file to upload ..">
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
@stop

@section('script')
   <script>
    </script>
@stop
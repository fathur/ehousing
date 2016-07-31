@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Hubungi Kami <small></small></h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-xs-12">
                            @include('back.alert')
                        </div>
                    </div>

                    <div class="row">
                        {{Form::model($data, array(
                            'method' => 'PUT',
                            'route' => array('back-office.hubungi-kami.update', $data->id),
                            'id' => 'hunianForm',
                        ))}}

                        <div class="col-xs-3">
                            <label for="name">Nama</label>
                            <p class="form-control-static">{{{ $data->Nama }}}</p>
                        </div>

                        <div class="col-xs-3">
                            <label for="name">Alamat</label>
                            <p class="form-control-static">{{{ $data->Alamat }}}</p>
                        </div>
                        <div class="col-xs-3">
                            <label for="name">No. Telp</label>
                            <p class="form-control-static">{{{ $data->NoTelp }}}</p>
                        </div>
                        <div class="col-xs-3">
                            <label for="name">Handphone</label>
                            <p class="form-control-static">{{{ $data->NoHP }}}</p>
                        </div>
                        <div class="col-xs-12">
                            <label for="name">Email</label>
                            <p class="form-control-static"><a href="mailto:{{$data->Email}}">{{{ $data->Email }}}</a> <small>(Balas pertanyaan ini langsung melalui email)</small></p>
                        </div>
                        <div class="col-xs-12">
                            <label for="name">Pesan</label>
                            <div class="form-control-static">{{{ $data->Deskripsi }}}</div>
                        </div>
                        <div class="col-xs-12">
                            <label for="attachment">Attachment</label>
                            {{$data->url}}
                            <div class="form-control-static"><a href="{{ url(route('front.file.show', array('hubungi', $data->url))) }}">{{{ $data->filename }}}</a></div>
                        </div>

                        <div class="col-xs-12 m-b-lg">
                            <label for="name">Status</label>
                            {{Form::select('statusid', $statuses, $data->statusid, array('class' => 'form-control'))}}
                        </div>
                        <div class="col-xs-12">

                        <button type="submit" class="btn btn-success">Simpan</button>
</div>
                        {{Form::close()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('vendor/select2/dist/js/select2.js') }}"></script>
@stop

@section('script')

@stop
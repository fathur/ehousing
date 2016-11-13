@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profil Provinsi<small></small></h5>
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
                           'route' => array('back-office.provinsi.setting.update'),
                           'method' => 'PUT',
                           'files' => true
                        ))}}

                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                {{Form::text('Nama', null, array('class' => 'form-control', 'id' => 'Nama'))}}
                            </div>

                            <div class="form-group">
                                <label for="Deskripsi">Deskripsi</label>
                                {{Form::textarea('Deskripsi', null, array('class' => 'form-control', 'id' => 'Deskripsi', 'rows' => null))}}

                            </div>
                            <div class="form-group">
                                <label for="tentang_kami">Tentang Kami</label>
                                {{Form::textarea('tentang_kami', null, array('class' => 'form-control', 'id' => 'tentang_kami', 'rows' => null))}}

                            </div>


                            <div class="form-group">
                                <label for="KelembagaanPerkim">Kelembagaan Perkim</label>
                                {{Form::text('KelembagaanPerkim', null, array('class' => 'form-control', 'id' => 'KelembagaanPerkim'))}}

                            </div>

                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="userfile">Upload Logo</label>
                                <div class="row">
                                    <div class="col-xs-8">
                                        {{Form::file('userfile', array())}}
                                        <p class="help-block small">
                                            File : gif|jpg|jpeg|png
                                            <br>Ukuran file maksimal : 2MB
                                        </p>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="profile-image">
                                            @if(!is_null($data->Logo))
                                            <img src="{{ route('front.file.show', ['profile', $data->Logo]) }}" class="img-responsive" alt="{{$data->Logo}}">
                                                {{Form::hidden('Logo', null)}}
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Alamat1">Alamat 1</label>
                                {{Form::textarea('Alamat1', null, array('class' => 'form-control', 'id' => 'Alamat1', 'rows' => null))}}

                            </div>
                            <div class="form-group">
                                <label for="StrukturOrg">Struktur Organisasi</label>
                                <div class="row">
                                    <div class="col-xs-8">
                                        {{Form::file('StrukturOrg', array())}}
                                        <p class="help-block small">
                                            File : gif|jpg|jpeg|png
                                            <br>Ukuran file maksimal : 2MB
                                        </p>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="profile-image">
                                            @if(!is_null($data->StrukturOrg))
                                                <img src="{{ route('front.file.show', ['profile', $data->StrukturOrg]) }}" class="img-responsive" alt="{{$data->StrukturOrg}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="Email">Email</label>
                                {{Form::email('Email', null, array('class' => 'form-control', 'id' => 'Email'))}}

                            </div>

                            <div class="form-group">
                                <label for="Website">Website</label>
                                {{Form::text('Website', null, array('class' => 'form-control', 'id' => 'Website'))}}
                            </div>

                            <div class="form-group">
                                <label for="backlog">Backlog</label>
                                {{Form::text('backlog', null, array('class' => 'form-control', 'id' => 'backlog'))}}
                            </div>

                            <div class="form-group">
                                <label for="rtlh">RTLH</label>
                                {{Form::text('rtlh', null, array('class' => 'form-control', 'id' => 'rtlh'))}}
                            </div>

                            <div class="form-group">
                                <label for="sejuta_rumah">Sejuta Rumah</label>
                                {{Form::text('sejuta_rumah', null, array('class' => 'form-control', 'id' => 'sejuta_rumah'))}}
                            </div>

                        </div>

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="pendataan">Pendataan</label>
                                {{Form::textarea('pendataan', null, array('class' => 'form-control', 'id' => 'pendataan'))}}
                            </div>
                        </div>

                        <div class="col-xs-12">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>

                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/summernote/dist/summernote.css')}}">
    <link rel="stylesheet" href="{{asset('css/summernote-bs3.css')}}">
@stop


@section('scripts')
    <script src="{{asset('vendor/summernote/dist/summernote.js')}}"></script>
@stop


@section('script')
    <script>
        $('#pendataan').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null             // set maximum height of editor
        });
    </script>
@stop
@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Entry Data Kontak<small></small></h5>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-sm-12">
                            @include('back.alert')
                        </div>
                    </div>

                    <div class="row">

                        {{Form::model($data, array(
                            'route' => array('back-office.kontak.update', $data->id),
                            'method' => 'PUT',
                            'name'  => 'kontakForm',
                            'id' => 'kontakForm'
                        ))}}

                        <div class="col-md-3">

                            <div class="form-group">
                                <label for="Nama">Nama *)</label>
                                {{Form::text('Nama', null, array(
                                    'class' => "form-control",
                                    'id' => 'Nama'
                                ))}}
                            </div>

                            <div class="form-group">
                                <label for="JenisKontak">Jenis Kontak *)</label>
                                {{Form::select('JenisKontak', $jenisKontak, null, array(
                                    'class' => 'form-control m-b select2',
                                    'id' => 'JenisKontak',
                                    'placeholder' => '- Pilih Satu -'

                                ))}}
                            </div>

                            <div class="form-group">
                                <label for="Deskripsi">Deskripsi</label>
                                {{Form::textarea('Deskripsi', null, array(
                                    'class' => 'form-control',
                                    'id' => 'Deskripsi'
                                ))}}
                            </div>

                            <div class="form-group">
                                <label for="Alamat">Alamat *)</label>
                                {{Form::textarea('Alamat', null, array(
                                   'class' => 'form-control',
                                   'id' => 'Alamat'
                               ))}}
                            </div>
                        </div>

                        <div class="col-md-3">

                            @if($isNasional)
                            <div class="form-group">
                                <label for="KodeProvinsi">Provinsi *)</label>
                                <select name="KodeProvinsi" id="KodeProvinsi" class="form-control m-b">
                                    @if(isset($data->provinsi))
                                        <option value="{{$data->KodeProvinsi}}" selected>{{$data->provinsi->NamaProvinsi}}</option>
                                    @endif
                                </select>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="KodeKota">Kota / Kabupaten</label>
                                <select name="KodeKota" id="KodeKota" class="form-control m-b">
                                    @if(isset($data->kota))
                                        <option value="{{$data->KodeKota}}" selected>{{$data->kota->NamaKota}}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="KodeKecamatan">Kecamatan</label>
                                <select name="KodeKecamatan" id="KodeKecamatan" class="form-control m-b">
                                    @if(isset($data->kecamatan))
                                        <option value="{{$data->KodeKecamatan}}" selected>{{$data->kecamatan->NamaKecamatan}}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="NoTelp">No Telp</label>
                                {{Form::text('NoTelp', null, array(
                                   'class' => "form-control",
                                   'id' => 'NoTelp'
                                ))}}
                            </div>
                            <div class="form-group"><label for="email">Email</label>
                                {{Form::email('Email', null, array(
                                  'class' => "form-control",
                                  'id' => 'Email'
                               ))}}
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                {{Form::text('Website', null, array(
                                   'class' => "form-control",
                                   'id' => 'Website'
                                ))}}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" id="toastTypeGroup">
                                <label>Sebagai</label>
                                <div class="radio">
                                    <label>
                                        {{Form::radio('IsCorporate', '0', null)}} Personal
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        {{Form::radio('IsCorporate', '1', null)}} Corporate
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>

                        {{Form::close()}}

                        <div class="col-md-2">

                            <div class="profile-image">
                                <a href="http://ehousing.id/kontak/entry/edit">
                                    <img src="http://ehousing.id/uploads/profile/no-pict.jpeg" class="img-circle m-b-md" alt="no-image">
                                </a>
                            </div>

                            <div class="form-group">

                                <div class="col-sm-10">
                                    <input type="file" name="picture" id="picture" size="50" maxlength="100" style="width:500px;">
                                    <p class="help-block">
                                        Dimensi foto yang disarankan : 64px * 64px (foto standar).
                                        <br>Ukuran file foto maksimal : 160kb
                                    </p>
                                    <input type="hidden" name="FotoPost" value="">
                                </div>
                            </div>

                        </div>
                    </div> <!--end row-->

                    <!-- <div class="hr-line-dashed"></div> -->


                </div>
            </div> <!--end ibox float-e-margins-->
        </div> <!--end col-lg-12-->
    </div>
@stop

@section('scripts')
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
@stop


@section('script')
    <script>
        $('#jeniskontak').select2();

        $('#KodeProvinsi').select2({
            ajax: {
                url: '{{ route('back-office.provinsi.name') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },

            allowClear: true,
            placeholder: 'Provinsi',
            templateResult: function(data) {
                return data.NamaProvinsi || data.text;
            },
            templateSelection: function(data) {
                return data.NamaProvinsi || data.text;
            }
        });



        $('#KodeKota').select2({
            ajax: {
                url: '{{ route('back-office.kota.name') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page,
                        @if($isNasional)
                        provinsi: $('#provinsi').val()
                        @else
                        provinsi: {{Auth::user()->KodeProvinsi}}
                        @endif
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },

            allowClear: true,
            placeholder: 'Kota / Kabupaten',
            templateResult: function(data) {
                return data.NamaKota || data.text;
            },
            templateSelection: function(data) {
                return data.NamaKota || data.text;
            }
        });


        $('#KodeKecamatan').select2({
            ajax: {
                url: '{{ route('back-office.kecamatan.name') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page,
                        kota: $('#KodeKota').val()
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },

            allowClear: true,
            placeholder: 'Kecamatan',
            templateResult: function(data) {
                return data.NamaKecamatan || data.text;
            },
            templateSelection: function(data) {
                return data.NamaKecamatan || data.text;
            }
        });
    </script>
@stop
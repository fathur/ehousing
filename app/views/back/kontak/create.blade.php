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

                            {{Form::open(array(
                                'route' => 'back-office.kontak.store',
                                'name'  => 'kontakForm',
                                'id' => 'kontakForm',
                                'files' => true
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
                                    <select name="KodeProvinsi" id="KodeProvinsi" class="form-control m-b"></select>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="KodeKota">Kota / Kabupaten</label>
                                    <select name="KodeKota" id="KodeKota" class="form-control m-b"></select>

                                </div>
                                <div class="form-group">
                                    <label for="KodeKecamatan">Kecamatan</label>
                                    <select name="KodeKecamatan" id="KodeKecamatan" class="form-control m-b"></select>
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
                                            {{Form::radio('IsCorporate', '0', true)}} Personal
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            {{Form::radio('IsCorporate', '1', false)}} Corporate
                                        </label>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>

                            <div class="col-md-2">

                                <div class="form-group">
                                    <label for="userfile">Upload Image</label>
                                    <div class="row">
                                        <div class="col-xs-8">
                                            {{Form::file('userfile', array())}}
                                            <p class="help-block small">
                                                File : gif|jpg|jpeg|png
                                                <br>Ukuran file maksimal : 2MB
                                            </p>
                                        </div>


                                    </div>
                                </div>

                            </div>

                        {{Form::close()}}


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
                    provinsi: $('#provinsi').val(),
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
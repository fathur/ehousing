@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Data Chart <small></small></h5>
                    <div class="ibox-tools"></div>
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
                            'route' => array('back-office.chart.update', $jenis, $data->id),
                            'id' => 'chartForm',
                            'novalidate' => 'novalidate'
                        ))}}

                        <div class="col-sm-12">

                            <div class="form-group">
                                <label for="thn-berlaku">Tahun Berlaku</label>
                                {{Form::text('TahunBerlaku', null, array('class' => 'form-control', 'id' => 'thn-berlaku'))}}
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                {{Form::text('jumlah', null, array('class' => 'form-control'))}}
                            </div>
                            <div class="form-group">
                                <label for="sumber">Sumber</label>
                                {{Form::textarea('source['.$sourceColumn.']', null, array('class' => 'form-control'))}}

                            </div>

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
    <script>
        $('#jenishunian').select2({
            allowClear: true,
            placeholder: '- Jenis Hunian -'
        });

        $('#provinsi').select2({
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



        $('#kotakab').select2({
            ajax: {
                url: '{{ route('back-office.kota.name') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page,
                        provinsi: $('#provinsi').val()
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


        $('#kecamatan').select2({
            ajax: {
                url: '{{ route('back-office.kecamatan.name') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page,
                        kota: $('#kotakab').val()
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

        $('#kodepengembang').select2({
            ajax: {
                url: '{{ route('back-office.kontak.name') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page,
                        type: 'DEV'

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
            placeholder: 'Nama Pengembang',
            templateResult: function(data) {
                return data.Nama || data.text;
            },
            templateSelection: function(data) {
                return data.Nama || data.text;
            }
        });

    </script>
@stop
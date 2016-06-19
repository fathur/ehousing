@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Entry Data Hunian <small></small></h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">

                    {{Form::model($data, array(
                        'method' => 'PUT',
                        'route' => array('back-office.hunian.update', $data->id),
                        'id' => 'hunianForm',
                        'novalidate' => 'novalidate'
                    ))}}

                    <div class="row">

                        @if(Session::has('message'))
                            <div class="alert alert-{{Session::get('class')}} alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" name="notif-success" type="button">×</button>
                                {{Session::get('message')}} <a class="alert-link" href="#"></a>.
                            </div>
                        @endif

                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="namahunian">Nama Hunian *)</label>
                                {{Form::text('NamaHunian', null, array('class' => 'form-control', 'id' => 'namahunian'))}}
                            </div>

                            <div class="form-group">
                                <label for="jenishunian">Jenis Hunian *)</label>
                                {{Form::select('JenisHunian', $listHunian, null, array('id' => 'jenishunian', 'class' => "form-control m-b", 'placeholder' => '- Jenis Hunian -'))}}
                            </div>
                            <div class="form-group">
                                <label for="tahunpembangunan">Tahun Pembangunan</label>
                                {{Form::text('TahunPembangunan', null, array('class' => 'form-control'))}}
                            </div>
                            <div class="form-group">
                                <label for="jumlahunit">Jumlah Unit</label>
                                {{Form::text('JumlahUnit', null, array('class' => 'form-control'))}}

                            </div>
                            <div class="form-group">
                                <label for="jumlahlantai">Jumlah Lantai</label>
                                {{Form::text('JumlahLantai', null, array('class' => 'form-control'))}}

                            </div>
                            <div class="form-group">
                                <label for="luaslahan">Luas Lahan</label>
                                {{Form::text('LuasLahan', null, array('class' => 'form-control'))}}

                            </div>
                            <div class="form-group">
                                <label for="tingkathunian">Tingkat Hunian</label>
                                {{Form::text('TingkatHunian', null, array('class' => 'form-control'))}}
                            </div>

                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="alamat">Alamat Hunian *)</label>
                                {{Form::textarea('Alamat', null, array('class' => 'form-control', 'id' => 'alamat', 'rows' => null, 'cols' => null))}}
                            </div>

                            <div class="form-group">
                                <label for="provinsi">Provinsi *)</label>
                                <select class="form-control m-b" name="KodeProvinsi" id="provinsi">
                                    @if(isset($data->provinsi))
                                        <option value="{{$data->KodeProvinsi}}" selected>{{$data->provinsi->NamaProvinsi}}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kotakab">Kota / Kabupaten</label>
                                <select class="form-control m-b" name="KodeKota" id="kotakab">
                                    @if(isset($data->kota))
                                        <option value="{{$data->KodeKota}}" selected>{{$data->kota->NamaKota}}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control m-b" name="KodeKecamatan" id="kecamatan">
                                    @if(isset($data->kecamatan))
                                        <option value="{{$data->KodeKecamatan}}" selected>{{$data->kecamatan->NamaKecamatan}}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="koordinat">Koordinat</label>
                                {{Form::text('Koordinat', null, array('class' => 'form-control'))}}
                            </div>

                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="kodepengembang">Nama Pengembang</label>
                                <select class="form-control m-b" name="KodePengembang" id="kodepengembang">
                                    @if(isset($data->kontak))
                                        <option value="{{$data->KodePengembang}}" selected>{{$data->kontak->Nama}}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pengelola">Pengelola</label>
                                {{Form::text('Pengelola', null, array('class' => 'form-control'))}}

                            </div>
                            <div class="form-group">
                                <label for="notelp">No Telp</label>
                                {{Form::text('NoTelp', null, array('class' => 'form-control'))}}

                            </div>
                            <div class="form-group">
                                <label for="teleponPIC">No Telp PIC</label>
                                {{Form::text('NoHP_PIC', null, array('class' => 'form-control'))}}

                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                {{Form::text('Email', null, array('class' => 'form-control'))}}

                            </div>

                            <div class="form-group">
                                <label for="website">Website</label>
                                {{Form::text('Website', null, array('class' => 'form-control'))}}

                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
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
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
                    {{Form::open(array('route' => 'back-office.hunian.store', 'id' => 'hunianForm', 'novalidate' => 'novalidate'))}}
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
                                    <input type="text" name="NamaHunian" class="form-control" id="namahunian">
                                </div>

                                <div class="form-group">
                                    <label for="jenishunian">Jenis Hunian *)</label>
                                    {{Form::select('JenisHunian', $listHunian, null, array('id' => 'jenishunian', 'class' => "form-control m-b", 'placeholder' => '- Jenis Hunian -'))}}
                                    {{--
                                    <select class="form-control m-b" name="jenishunian" id="jenishunian">
                                        <option value="">- Jenis Hunian - </option>
                                        <option value="APT">
                                            Apartemen</option>
                                        <option value="CDT">
                                            Condotel</option>
                                        <option value="HTL" selected="">
                                            Hotel</option>
                                        <option value="PRM">
                                            Perumahan</option>
                                        <option value="RMS">
                                            Rumah Subsidi</option>
                                        <option value="RS">
                                            Rusun Sewa</option>
                                        <option value="RN">
                                            Rusunami</option>
                                        <option value="RNS">
                                            Rusunami Subsidi</option>
                                    </select>
--}}
                                </div>
                                <div class="form-group">
                                    <label for="tahunpembangunan">Tahun Pembangunan</label>
                                    <input type="text"  placeholder="" name="TahunPembangunan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="jumlahunit">Jumlah Unit</label>
                                    <input type="text" placeholder="" name="JumlahUnit" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="jumlahlantai">Jumlah Lantai</label>
                                    <input type="text" placeholder="" name="JumlahLantai" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="luaslahan">Luas Lahan</label>
                                    <input type="text" placeholder="m²" name="LuasLahan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tingkathunian">Tingkat Hunian</label>
                                    <input type="text" placeholder="" name="TingkatHunian" class="form-control">
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="alamat">Alamat Hunian *)</label>
                                    <textarea name="Alamat" class="form-control" id="alamat"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="provinsi">Provinsi *)</label>
                                    <select class="form-control m-b" name="KodeProvinsi" id="provinsi"></select>
                                </div>
                                <div class="form-group">
                                    <label for="kotakab">Kota / Kabupaten</label>
                                    <select class="form-control m-b" name="KodeKota" id="kotakab"></select>
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-control m-b" name="KodeKecamatan" id="kecamatan"></select>
                                </div>

                                <div class="form-group">
                                    <label for="koordinat">Koordinat</label>
                                    <input type="text" placeholder="Latitude, longtudr" name="Koordinat" class="form-control">
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="kodepengembang">Nama Pengembang</label>
                                    <select class="form-control m-b" name="KodePengembang" id="kodepengembang"></select>
                                </div>
                                <div class="form-group">
                                    <label for="pengelola">Pengelola</label>
                                    <input type="text" placeholder="" name="Pengelola" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="notelp">No Telp</label>
                                    <input type="text" placeholder="" name="NoTelp" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="teleponPIC">No Telp PIC</label>
                                    <input type="text"  placeholder="" name="NoHP_PIC" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" placeholder="Email" name="Email" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" placeholder="http://" name="Website" class="form-control">
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
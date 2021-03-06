@extends('layout')

@section('styles')

    <link rel="stylesheet" href="{{asset('vendor/summernote/dist/summernote.css')}}">
    <link rel="stylesheet" href="{{asset('css/summernote-bs3.css')}}">
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

                    <div class="row">
                        <div class="col-xs-12">
                            @include('back.alert')
                        </div>
                    </div>

                    {{Form::model($data, array(
                        'method' => 'PUT',
                        'route' => array('back-office.hunian.update', $data->id),
                        'id' => 'hunianForm',
                       'files' => true,
                        'novalidate' => 'novalidate'
                    ))}}

                    <div class="row">


                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="namahunian">Nama Hunian *)</label>
                                {{Form::text('NamaHunian', null, array('class' => 'form-control', 'id' => 'namahunian'))}}
                            </div>

                            <div class="form-group">
                                <label for="jenishunian">Jenis Hunian *)</label>
                                {{Form::select('JenisHunian', $listHunian, null, array('id' => 'jenishunian', 'class' => "form-control m-b"))}}
                            </div>

                            <div class="form-group">
                                <label for="jumlahunit">Jumlah Unit</label>
                                {{Form::text('JumlahUnit', null, array('class' => 'form-control'))}}

                            </div>
                            <div class="form-group">
                                <label for="jumlahlantai">Jumlah Lantai</label>
                                {{Form::text('JumlahLantai', null, array('class' => 'form-control'))}}

                            </div>


                        </div>

                        <div class="col-sm-4">
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
                                    <div class="col-xs-4">
                                        <div class="profile-image">
                                            @if(!is_null($data->picture))
                                                <img src="{{ route('front.file.show', ['hunian', $data->picture]) }}" class="img-responsive" alt="{{$data->picture}}">
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat Hunian *)</label>
                                {{Form::textarea('Alamat', null, array('class' => 'form-control', 'id' => 'alamat', 'rows' => null, 'cols' => null))}}
                            </div>

                            @if($isNasional)
                            <div class="form-group">
                                <label for="provinsi">Provinsi *)</label>
                                <select class="form-control m-b" name="KodeProvinsi" id="provinsi">
                                    @if(isset($data->provinsi))
                                        <option value="{{$data->KodeProvinsi}}" selected>{{$data->provinsi->NamaProvinsi}}</option>
                                    @endif
                                </select>
                            </div>
                            @endif

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
                                <label for="nama_pengembang">Nama Pengembang</label>
                                {{Form::text('nama_pengembang', null, array('class' => 'form-control'))}}

                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                {{Form::text('Email', null, array('class' => 'form-control'))}}

                            </div>

                            <div class="form-group">
                                <label for="website">Website</label>
                                {{Form::text('Website', null, array('class' => 'form-control'))}}

                            </div>


                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="tab2">Title Tab 2</label>
                                {{Form::text('Tab2', null, array('class' => 'form-control', 'id' => 'tab2'))}}

                            </div>

                            <div class="form-group">
                                <label for="tab2-content">Content Tab 2</label>
                                {{Form::textarea('LinkExternal2', null, array('class' => 'form-control', 'id' => 'tab2-content'))}}

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="tab3">Title Tab 3</label>
                                {{Form::text('Tab3', null, array('class' => 'form-control', 'id' => 'tab3'))}}

                            </div>

                            <div class="form-group">
                                <label for="tab3-content">Content Tab 3</label>
                                {{Form::textarea('LinkExternal3', null, array('class' => 'form-control', 'id' => 'tab3-content'))}}

                            </div>


                        </div>


                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="tab4">Title Tab 4</label>
                                {{Form::text('Tab4', null, array('class' => 'form-control', 'id' => 'tab4'))}}

                            </div>

                            <div class="form-group">
                                <label for="tab4-content">Content Tab 4</label>
                                {{Form::textarea('LinkExternal4', null, array('class' => 'form-control', 'id' => 'tab4-content'))}}

                            </div>

                            <button class="btn btn-primary btn-lg" type="submit">Simpan</button>

                        </div>


                    </div>

                    {{Form::close()}}

                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('vendor/summernote/dist/summernote.js')}}"></script>
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

       /* $('#kodepengembang').select2({
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
*/
        $('#tab2-content').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null             // set maximum height of editor
        });

        $('#tab3-content').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null             // set maximum height of editor
        });

        $('#tab4-content').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null             // set maximum height of editor
        });

    </script>
@stop
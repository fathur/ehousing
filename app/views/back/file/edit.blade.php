@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}">

@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Upload File</h5>

            </div>
            <div class="ibox-content">
                <!-- Search form -->

                    {{Form::model($data, array(
                        'route' => array('back-office.file.update', $data->id),
                        'method' => 'PUT',
                        'files' => true
                    ))}}

                    <div class="row">
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="Judul">Judul</label>
                                {{Form::text('Judul', null, array('class' => 'form-control', 'id' => 'Judul'))}}
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                {{Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description'))}}
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
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="filename">Upload Image</label>
                                <div class="row">
                                    <div class="col-xs-8">
                                        {{Form::file('filename', array())}}
                                        <p class="help-block small">
                                            File : gif|jpg|jpeg|png
                                            <br>Ukuran file maksimal : 2MB
                                        </p>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="profile-image">
                                            @if(!is_null($data->url))
                                                <img src="{{ route('front.file.show', ['file', $data->url]) }}" class="img-responsive" alt="{{$data->url}}">
                                                {{--{{Form::hidden('picture', null)}}--}}
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{--<div class="form-group">
                                <label for="userfile">File</label>
                                <input type="file" name="userfi.e" placeholder="Select file to upload ..">
                                <p class="help-block">
                                    File yang diizinkan di upload :
                                    <br>.doc, .xls, .ppt, .zip, jpg
                                    <br>Ukuran file maksimal : 2MB
                                </p>
                            </div>--}}
                            <div class="form-group">
                                <label for="categoryfile">Kategori</label>
                                {{Form::select('categoryfile', $categories, null, array('class' => 'form-control', 'id' =>'categoryfile'))}}
                               {{-- <select class="form-control m-b" name="categoryfile" >
                                    <option value="">- Jenis File - </option>
                                    <option value="HPK">
                                        Hasil Penelitian/Kajian</option>
                                    <option value="INF">
                                        Informasi</option>
                                    <option value="KPU">
                                        Kategori Publikasi</option>
                                    <option value="PK" selected="">
                                        Peraturan/Kebijakan</option>
                                    <option value="SHM">
                                        Standar Harga Material</option>
                                </select>--}}

                            </div>

                            <button type="submit" value="upload" class="btn btn-sm btn-primary"> Update</button>

                        </div>
                    </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

@stop

@section('script')
    <script>
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

    </script>
@stop
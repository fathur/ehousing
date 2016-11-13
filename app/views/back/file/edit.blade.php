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

                            <div class="form-group">
                                <label for="kotakab">Kota / Kabupaten</label>
                                <select class="form-control m-b" name="KodeKota" id="kotakab">
                                    @if(isset($data->kota))
                                        <option value="{{$data->KodeKota}}" selected>{{$data->kota->NamaKota}}</option>
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="filename">Upload Image</label>
                                <div class="row">
                                    <div class="col-xs-8">
                                        {{Form::file('filename', array())}}
                                        <p class="help-block small">
                                            <br>Ukuran file maksimal : 2MB
                                        </p>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="profile-image">

                                            @if($data->fileext == 'jpg' || $data->fileext == '.jpg' || $data->fileext == 'png' || $data->fileext == '.jpg')

                                                @if(!is_null($data->url))
                                                    <img src="{{ route('front.file.show', ['file', $data->url]) }}" class="img-responsive" alt="{{$data->url}}">
                                                @endif
                                            @elseif($data->fileext == 'pdf' || $data->fileext == '.pdf')
                                                <span style="font-size: 60px;">
                                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                </span>
                                            @elseif($data->fileext == 'doc' || $data->fileext == '.doc' || $data->fileext == 'docx' || $data->fileext == '.docx')
                                                <span style="font-size: 60px;">
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                </span>
                                            @elseif($data->fileext == 'xls' || $data->fileext == '.xls' || $data->fileext == 'xlsx' || $data->fileext == '.xlsx')
                                                <span style="font-size: 60px;">
                                                    <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                                </span>
                                            @elseif($data->fileext == 'ppt' || $data->fileext == '.ppt' || $data->fileext == 'pptx' || $data->fileext == '.pptx')
                                                <span style="font-size: 60px;">
                                                    <i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
                                                </span>

                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categoryfile">Kategori</label>
                                {{Form::select('categoryfile', $categories, null, array('class' => 'form-control', 'id' =>'categoryfile'))}}
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
    </script>
@stop
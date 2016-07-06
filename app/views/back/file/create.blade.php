@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Upload File</h5>

                </div>
                <div class="ibox-content">
                    <!-- Search form -->

                    {{Form::open(array(
                        'route' => 'back-office.file.store',
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
                                    <select class="form-control m-b" name="KodeProvinsi" id="provinsi"></select>
                                </div>
                            @endif

                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="filename">File</label>
                                {{Form::file('filename', array())}}
                                <p class="help-block">
                                    File yang diizinkan di upload :
                                    <br>.doc, .xls, .ppt, .zip, jpg
                                    <br>Ukuran file maksimal : 2MB
                                </p>
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
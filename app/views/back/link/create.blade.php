@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Entry Data Link<small></small></h5>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">

                        {{Form::open(array(
                            'route' => 'back-office.link.store',
                            'name'  => 'linkForm',
                            'class' => 'form-horizontal',
                        ))}}

                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="GrupLinkInfo" class="col-sm-2 control-label">Group</label>
                                <div class="col-sm-10">
                                    {{Form::select('GrupLinkInfo', $linkGroups, null, array('class'=>'form-control','id'=>'GrupLinkInfo'))}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Judul" class="col-sm-2 control-label">Judul *)</label>
                                <div class="col-sm-10">
                                    {{Form::text('Judul', null, array(
                                        'class' => "form-control",
                                        'id' => 'Judul'
                                    ))}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Deskripsi" class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    {{Form::textarea('Deskripsi', null, array(
                                        'class' => 'form-control',
                                        'id' => 'Deskripsi'
                                    ))}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="LinkInfo" class="col-sm-2 control-label">LinkInfo *)</label>
                                <div class="col-sm-10">
                                    {{Form::text('LinkInfo', null, array(
                                       'class' => 'form-control',
                                       'id' => 'LinkInfo'
                                   ))}}
                                </div>
                            </div>

                            @if($isNasional)

                            <div class="form-group">
                                <label for="KodeProvinsi" class="col-sm-2 control-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <select name="KodeProvinsi" id="KodeProvinsi" class="form-control m-b"></select>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div> <!--end row-->
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


    </script>
@stop
@extends('layout')

@section('content')
    <div class="row">
        <!-- form -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tambah User</h5>
                    </div><!-- end of ibox-title -->
                    <div class="ibox-content">
                        {{Form::open(array(
                            'route' => 'back-office.user.store',
                            'class' => "form-horizontal"
                        ))}}


                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="UserName">User Name *)</label>
                            <div class="col-sm-10">
                                {{Form::text('UserName', null, array('class' => 'form-control','id' => 'UserName'))}}

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="Nama">Nama Lengkap *)</label>
                            <div class="col-sm-10">
                                {{Form::text('Nama', null, array('class' => 'form-control','id' => 'Nama'))}}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="UserPassword">Password *)</label>
                            <div class="col-sm-10">
                                {{Form::password('UserPassword', array('class' => 'form-control','id' => 'UserPassword'))}}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="UserPasswordConfirm">Password confirm *)</label>
                            <div class="col-sm-10">
                                {{Form::password('UserPasswordConfirm', array('class' => 'form-control','id' => 'UserPasswordConfirm'))}}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="Email">Email *)</label>
                            <div class="col-sm-10">
                                {{Form::email('Email', null, array('class' => 'form-control','id' => 'Email'))}}
                            </div>
                        </div>



                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="Region">Region *)</label>
                            <div class="col-sm-10">
                                {{Form::select('Region', $regions, null, array('class' => 'form-control','id' => 'Region'))}}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="KodeProvinsi">Provinsi</label>
                            <div class="col-sm-10">
                                <select name="KodeProvinsi" id="KodeProvinsi" class="form-control m-b">
                                    @if(isset($data->provinsi))
                                        <option value="{{$data->KodeProvinsi}}" selected>{{$data->provinsi->NamaProvinsi}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="UserStatus">Status</label>
                            <div class="col-sm-10">
                                {{Form::select('UserStatus', $statuses, null, array('class' => 'form-control','id' => 'UserStatus'))}}

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div><!-- end of ibox-content -->
                </div><!-- end of ibox float-e-margins -->
            </div><!-- end of col-lg-12 -->
        </div><!-- end of row -->
    </div>
@stop

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
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

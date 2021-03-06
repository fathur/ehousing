@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/summernote/dist/summernote.css')}}">
    <link rel="stylesheet" href="{{asset('css/summernote-bs3.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Tambah/Edit Post</h5>
                </div><!-- end of ibox-title -->

                <div class="ibox-content">

                    <div class="row">
                        <div class="col-xs-12">
                            @include('back.alert')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">

                            {{Form::model($data, array(
                                'route' => array('back-office.post.update', $data->id),
                                'method' => 'PUT',
                                'files' => true,
                                'id' => 'postForm',
                                'class' => 'form-horizontal'
                            ))}}

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="Judul">Judul *)</label>
                                <div class="col-sm-10">
                                    {{Form::text('Judul', null, array('id' => "Judul", 'class' => "form-control"))}}
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Foto</label>
                                <div class="col-sm-10">
                                    <input type="file" name="userfile" id="Foto" size="50">
                                    <p class="help-block">
                                        Dimensi foto yang disarankan : 500px * 250px (postingan standar).
                                        <br/>Ukuran file foto maksimal : 2MB
                                    </p>
                                    @if(!is_null($data->Foto))
                                        <img src="{{route('front.file.show', array('post', $data->Foto))}}" alt="" class="img-responsive">
                                        {{Form::hidden('Foto', null)}}
                                    @endif
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="IsiPost">Isi</label>
                                <div class="col-sm-10">
                                    {{Form::textarea('IsiPost', null, array('id' => "IsiPost"))}}

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kategori *)</label>
                                <div class="col-sm-10">

                                    {{Form::select('KategoriId', $listCategories, null, array(
                                        'id' => 'KategoriId',
                                        'class' => 'form-control m-b'
                                    ))}}

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            {{-- If user has nasional role --}}

                            @if($isNasional)

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="Region">Region *)</label>
                                <div class="col-sm-10">
                                    {{Form::select('Region', $regions, null, array('class' => "form-control m-b" , 'id' => "Region"))}}

                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            @endif

                            @if($isNasional)

                            <div id="provinsi-wrapper">


                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="KodeProvinsi">Provinsi</label>
                                    <div class="col-sm-10">
                                        {{Form::select('KodeProvinsi', $listProvinces, null, array(
                                            'class' => "form-control m-b",
                                            'name' => "KodeProvinsi",
                                             'id' => "KodeProvinsi"
                                        ))}}

                                    </div>
                                </div>

                            </div>

                            <div class="hr-line-dashed"></div>
                            @endif


                            {{-- end if --}}

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="PostStatus">Publikasikan postingan?</label>
                                <div class="col-sm-10">
                                    {{Form::checkbox('PostStatus', 1, null, array('id' => "PostStatus" ))}}
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="PublishDate">Tanggal Publikasi</label>
                                <div class='col-sm-10'>
                                    {{Form::text('PublishDate', null, array('id' => "PublishDate", 'class' => "form-control" ))}}

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="IzinKomentar">Izinkan komentar?</label>
                                <div class="col-sm-10">
                                    {{Form::checkbox('IzinKomentar', 1, null, array('id' => "IzinKomentar" ))}}

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="ShareSocmed">Aktifkan share ke media sosial?</label>
                                <div class="col-sm-10">
                                    {{Form::checkbox('ShareSocmed', 1, null, array('id' => "ShareSocmed" ))}}

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div><!-- end of ibox-content -->
            </div><!-- end of ibox float-e-margins -->
        </div><!-- end of col-lg-12 -->
    </div>
@stop

@section('scripts')
    <script src="{{asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('vendor/summernote/dist/summernote.js')}}"></script>
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
@stop

@section('script')
    <script>
        $('#KategoriId, #KodeProvinsi').select2();

        $('#IsiPost').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null             // set maximum height of editor
        });

        $('#PublishDate').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true
        });

        var $region = $('#Region');

        showOrHideProvince($region);

        $region.change(function(e){
            var $this = $(this);
            showOrHideProvince($this);
        });

        function showOrHideProvince(region)
        {
            if(region.val() == 'Nasional') {
                $('#provinsi-wrapper').hide();
                $('#KodeProvinsi').select2('val', '0');
            }
            else {
                $('#provinsi-wrapper').show();

            }
        }
    </script>
@stop
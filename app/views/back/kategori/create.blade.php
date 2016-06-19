@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tambah/Edit Kategori Post</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div><!-- end of ibox-title -->
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-xs-12">
                            @include('back.alert')
                        </div>
                    </div>

                    <div class="row">
                        {{Form::open(array('route' => 'back-office.kategori.store', 'class' => "form-horizontal"))}}
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="NamaKategori">Nama Kategori *)</label>
                                <div class="col-sm-10">
                                    {{Form::text('NamaKategori', null, array('class' => 'form-control', 'id' => 'NamaKategori'))}}
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
                </div><!-- end of ibox-content -->
            </div><!-- end of ibox float-e-margins -->
        </div><!-- end of col-lg-12 -->
    </div>
@stop
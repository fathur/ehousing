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

                    {{Form::model($data, array(
                        'route' => array('back-office.file.update', $data->id),
                        'method' => 'PUT'
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

                        </div>

                        <div class="col-sm-3">
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
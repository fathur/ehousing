@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tambah Data {{$kinds[$jenis]['name']}}</h5>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-xs-12">
                            @include('back.alert')
                        </div>
                    </div>

                    <div class="row">
                        {{Form::open(array(
                            'route' => array('back-office.chart.store', $jenis),
                            'id' => 'chartForm'
                        ))}}

                        <div class="col-sm-12">

                            <div class="form-group">
                                <label for="thn-berlaku">Tahun Berlaku</label>
                                {{Form::text('TahunBerlaku', null, array('class' => 'form-control', 'id' => 'thn-berlaku'))}}
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                {{Form::text('jumlah', null, array('class' => 'form-control'))}}
                            </div>
                            <div class="form-group">
                                <label for="sumber">Sumber</label>
                                {{Form::textarea('source['.$sourceColumn.']', null, array('class' => 'form-control'))}}

                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>

                        </div>

                        {{Form::close()}}


                    </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('vendor/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables/media/js/dataTables.bootstrap.js')}}"></script>
@stop

@section('script')
    <script>

    </script>
@stop
@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Hasil Pencarian</h5>
                </div>
                <div class="ibox-content">




                    <div class="row">
                       <div class="col-sm-12">
                            @foreach($results as $key => $result)
                                <h3>{{$key}}</h3>

                                <ul>
                                    @foreach($result as $item)
                                        <li>
                                            <a href="{{$item['link']}}"><strong>{{$item['title']}}</strong></a>
                                            <p>{{ Str::limit(strip_tags($item['description']), 200)}}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

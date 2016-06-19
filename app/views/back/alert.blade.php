@if(Session::has('message'))
    <div class="alert alert-{{Session::get('class')}} alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" name="notif-success" type="button">×</button>
        {{Session::get('message')}} <a class="alert-link" href="#"></a>.
    </div>
@endif

@if($errors->has())
    <div class="alert alert-{{Session::get('class')}} alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" name="notif-success" type="button">×</button>
        <ol>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ol>

    </div>
@endif
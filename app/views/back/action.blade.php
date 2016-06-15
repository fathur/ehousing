<div class="btn-group">
    <a class="btn btn-warning btn-xs" href="{{$edit_action}}">
        <i class="fa fa-pencil"></i>
    </a>
    <button class="btn btn-danger btn-xs"
            id="trash"
            data-token="{{{csrf_token()}}}"
            data-table="{{{$table}}}"
            data-url="{{$url}}"
            onclick="datatablesDelete(this)">
        <i class="fa fa-trash"></i>
    </button>
</div>
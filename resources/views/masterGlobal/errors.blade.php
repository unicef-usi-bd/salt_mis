@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-block alert-danger">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
        <i class="ace-icon fa fa-check green"></i>
    </div>
@endif
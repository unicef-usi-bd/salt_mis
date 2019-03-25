@if (session()->has('success'))
    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <b>Success ! </b> {{ session()->get('success') }}
        <i class="ace-icon fa fa-check green"></i>
    </div>
@endif

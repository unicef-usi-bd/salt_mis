<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>

    {{--<div id="error" class="alert alert-block alert-danger" style="display: none;">--}}
    {{--<span id="errorMessage"></span>--}}
    {{--</div>--}}

    {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
    <form action="{{ url('') }}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Chemical Type</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess " class="chosen-select form-control" name="" data-placeholder="Select or search data">
                   <option value=""></option>
                    {{--@foreach($upazillas as $upazilla)--}}
                    {{--<option value="{{$upazilla->cost_center_id}}"> {{$upazilla->cost_center_name}}</option>--}}
                    {{--@endforeach--}}
                </select>
            </span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Salt Name</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess " class="chosen-select form-control" name="" data-placeholder="Select or search data">
                   <option value=""></option>
                    {{--@foreach($upazillas as $upazilla)--}}
                    {{--<option value="{{$upazilla->cost_center_id}}"> {{$upazilla->cost_center_name}}</option>--}}
                    {{--@endforeach--}}
                </select>
            </span>
            </div>
        </div>
        {{--@else--}}

        {{--<input type="hidden" name="upazilla_id" value="{{ Auth::user()->cost_center_id }}">--}}
        {{--@endif--}}
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess union_name" placeholder="Example: Amount per KG here" name="union_name" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>

    <!-- <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('union.active_status') }}</b></label>
                <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="active_status">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
                </div>
            </div> -->


        <hr>
        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn test">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'unions' }}">--}}
                <button type="submit" class="btn btn-primary">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>

@include('masterGlobal.chosenSelect')
{{--@include('masterGlobal.formValidation')--}}

{{--<script>--}}
{{--$(document).ready(function () {--}}
{{--$('#success').hide();--}}
{{--$('#error').hide();--}}
{{--$('.createAjax').on('submit', function(e)  {--}}
{{--e.preventDefault();--}}

{{--$.ajax({--}}
{{--url: "{{ route('unions.store') }}",--}}
{{--type: 'POST',--}}
{{--data: $(".createAjax").serialize(),--}}
{{--success: function (data) {--}}

{{--if(data.success){--}}
{{--$('#successMessage').html('<span>'+data.success+'</span>');--}}
{{--$('input[type=text]').val("");--}}
{{--$('#success').delay(1000).show().fadeOut('slow');--}}
{{--}else{--}}
{{--var errorText = data.errors;--}}

{{--errorText.map(function(error) {--}}
{{--$('#errorMessage').html(error);--}}
{{--$('input[type=text]').val("");--}}
{{--$('#error').delay(1000).show().fadeOut('slow');--}}
{{--//$('#error').show();--}}
{{--});--}}

{{--}--}}
{{--}--}}
{{--});--}}
{{--});--}}
{{--});--}}



{{--</script>--}}


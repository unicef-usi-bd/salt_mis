<div class="col-md-12">
    {{--<div id="success" class="alert alert-block alert-success" style="display: none;">--}}
        {{--<span id="successMessage"></span>--}}
        {{--<button type="button" class="close" data-dismiss="alert">--}}
            {{--<i class="ace-icon fa fa-times"></i>--}}
        {{--</button>--}}
    {{--</div>--}}
    <form action="{{ url('/lookup-groups') }}" method="post" class="form-horizontal" role="form">
    {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
        @csrf
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.group_name') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess group_name" placeholder="{{ trans('lookupGroupIndex.exp_group_name') }}" name="LOOKUPMST_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.user_define_id') }}</b><span style="color: red;"> *</span> </label>--}}
            {{--<div class="col-sm-8">--}}
                {{--<input type="number" id="inputSuccess user_define_sl" placeholder="{{ trans('lookupGroupIndex.exp_user_define_id') }}" name="UD_SL" class="form-control col-xs-10 col-sm-5" value=""/>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1" > <b>{{ trans('lookupGroupIndex.description') }}</b></label>
            <div class="col-sm-8">
                <textarea  class="form-control" rows="5" style="height:50%;" id="inputSuccess description form-field-8" name="DESCRIPTION" placeholder="{{ trans('lookupGroupIndex.description') }}"></textarea>
            </div>
        </div>
         <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
            </div>
        </div>
        <hr>
        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'lookup-groups' }}">--}}
                <button type="submit" class="btn btn-primary">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>


{{--@include('masterGlobal.formValidation')--}}
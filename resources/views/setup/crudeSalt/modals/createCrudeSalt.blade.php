<div class="col-md-12">
    {{--<div id="success" class="alert alert-block alert-success" style="display: none;">--}}
    {{--<span id="successMessage"></span>--}}
    {{--<button type="button" class="close" data-dismiss="alert">--}}
    {{--<i class="ace-icon fa fa-times"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    <form action="{{ url('/crude-salt-details') }}" method="post" class="form-horizontal" role="form">
        {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
        @csrf
        {{--<div class="form-group">--}}
            {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.group_name') }}</b><span style="color: red;"> *</span> </label>--}}
            {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Salt Type</b><span style="color: red;"> *</span> </label>--}}
            {{--<div class="col-sm-8">--}}
                {{--<input type="text" id="inputSuccess group_name" placeholder="{{ trans('lookupGroupIndex.exp_group_name') }}" name="LOOKUPMST_NAME" class="form-control col-xs-10 col-sm-5" value=""/>--}}
                {{--<input type="text" id="inputSuccess group_name" placeholder="Salt Type" name="LOOKUPMST_NAME" class="form-control col-xs-10 col-sm-5" value=""/>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Salt Type</b><span style="color: red;">* </span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG">
                    <option value="">Select One</option>
                    <option value="1" >Black</option>
                    <option value="0">Polythene</option>
                </select>
            </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Sodium chloride</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="number" id="inputSuccess user_define_sl" placeholder="Sodium chloride" name="UD_SL" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Moisturizer</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="number" id="inputSuccess user_define_sl" placeholder="Moisturizer" name="UD_SL" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Iodine content(PPM)</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="number" id="inputSuccess user_define_sl" placeholder="Iodine content(PPM)" name="UD_SL" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Iodine content(PPM)</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="number" id="inputSuccess user_define_sl" placeholder="Iodine content(PPM)" name="UD_SL" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>PH</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="number" id="inputSuccess user_define_sl" placeholder="PH" name="UD_SL" class="form-control col-xs-10 col-sm-5" value=""/>
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
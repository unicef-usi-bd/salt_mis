<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>

    <form action ="{{ 'user-group-levels' }}" class="form-horizontal" name="formData" method="POST">
        @csrf

        <input type="hidden" name="group_id" value="{{ $id }}">

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('module.group_level_name') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess group_level_name" placeholder="{{ trans('module.example_group_name_here') }}" name="group_level_name" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Position</b><span style="color: red;"></span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess POSITIONLEVEl" placeholder="Number" name="POSITIONLEVEl" class="form-control col-xs-10 col-sm-5" onkeypress="return numbersOnly(this, event)" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="active_status">
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
                    Reset
                </button>
                <button type="button" class="btn btn-success" onclick="formSubmit(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>

@include('masterGlobal.ajaxFormSubmit')

<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12" style="margin-top: 10px">
    <form action="{{ url('/modules/'.$editModule->MODULE_ID) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-12" style="padding: 0px;">
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <input autocomplete="off" type="text" id="inputSuccess module_name" name="module_name" placeholder="Example:Module Name Here" value="{{ $editModule->MODULE_NAME }}" class="width-100" />
            </span>

                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_icon') }}</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="module_icon" placeholder="Example:Module Icon Here" value="{{ $editModule->MODULE_ICON }}" id="inputSuccess module_icon" class="width-100"  />
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.sl_no') }}</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="sl_no" placeholder="Example:Module SL NO Here" value="{{ $editModule->SL_NO }}" id="inputSuccess sl_no" class="width-100"  />
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('union.active_status') }}</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" name="active_status">
                            <option value="">Select One</option>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </span>
                </div>
            </div>

        </div>

        <div class="clearfix">
            <div class="col-md-offset-5 col-md-7" style="margin-top: 20px;">
                <button type="reset" class="btn" disabled="disabled">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-info" id="formSubmit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.update') }}
                </button>
            </div>
        </div>
    </form>
</div>
@include('masterGlobal.formValidationEdit')
@include('masterGlobal.getBankBranchesEvent')

<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12" style="margin-top: 10px">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>
    {{--<form action="{{ url('/modules') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">--}}
    <form class="form-horizontal frmContent" name="formData" method="POST">
        @csrf

        <div class="col-md-12" style="padding: 0px;">
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <input autocomplete="off" type="text" id="inputSuccess module_name" name="module_name" placeholder="Example:Module Name Here" value="{{ old('module_name') }}" class="width-100" />
            </span>

                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_icon') }}</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="module_icon" value="{{ old('module_icon') }}" placeholder="Example:Module Icon Here" id="inputSuccess module_icon" class="width-100"  />
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.sl_no') }}</b><span style="color: red;"> *</span></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="sl_no" value="{{ old('sl_no') }}" placeholder="Example:Module SL NO Here" id="inputSuccess sl_no" class="width-100"  />
                    </span>
                </div>
            </div>

           <!--  <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Active Status</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" name="active_status">
                            <option value="">Select One</option>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </span>
                </div>
            </div> -->

        </div>

        <div class="clearfix">
            <div class="col-md-offset-5 col-md-7" style="margin-top: 20px;">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'modules' }}">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
{{--@include('masterGlobal.formValidation')--}}
@include('masterGlobal.getBankBranchesEvent')
{{--@include('masterGlobal.ajaxFormSubmit')--}}

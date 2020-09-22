<!-- PAGE CONTENT BEGINS -->
<style>
    .checkbox_style{
        height: 15px;
        width: 15px;
    }
</style>
<div class="col-md-12" style="margin-top: 10px">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>
    {{--<form action="{{ url('/module-links') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">--}}
    <form class="form-horizontal frmContent" name="formData" method="POST">
        @csrf

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('moduleLinks.module_link_create') }}</b><span style="color: red;"> *</span></label>
            <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select id="form-field-select-3 inputSuccess module_id" class="chosen-select form-control" name="module_id" data-placeholder="Select or search data">
                            <option value="">-Select-</option>
                            @foreach($modules as $module)
                                <option value="{{$module->MODULE_ID}}"> {{$module->MODULE_NAME}}</option>
                            @endforeach
                        </select>
                    </span>
            </div>
        </div>

        <div class="col-md-12" style="padding: 0px;">
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('moduleLinks.module_link') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" id="inputSuccess link_name" name="link_name" placeholder="Example:Module Link Name Here" value="{{ old('link_name') }}" class="width-100" />
                    </span>

                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('moduleLinks.link_url') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="link_url" value="{{ old('link_url') }}" placeholder="Example:Module Link URL Here" id="inputSuccess link_url" class="width-100"  />
                    </span>
                </div>
            </div>

            <!-- <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>SL No.</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="sl_no" value="{{ old('sl_no') }}" id="inputSuccess sl_no" class="width-100"  />
                    </span>
                </div>
            </div> -->

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('dashboard.action') }}</b><!-- <span style="color: red;"> *</span>  --></label>
                <div class="col-xs-12 col-sm-9">
                    <span class="checkbox">
                        <label><input type="checkbox" name="create" value="1" class="checkbox_style">{{ trans('moduleLinks.view') }}</label>
                        <label style="margin-left: 7px;"><input type="checkbox" name="view" value="1" class="checkbox_style">{{ trans('moduleLinks.create') }}</label>
                        <label style="margin-left: 7px;"><input type="checkbox" name="update" value="1" class="checkbox_style">{{ trans('moduleLinks.edit') }}</label>
                        <label style="margin-left: 7px;"><input type="checkbox" name="delete" value="1" class="checkbox_style">{{ trans('moduleLinks.delete') }}</label>
                        <label style="margin-left: 7px;"><input type="checkbox" name="status" value="1" class="checkbox_style">{{ trans('moduleLinks.status') }}</label>
                    </span>

                </div>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-offset-4 col-md-7" style="margin-top: 20px;">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'module-links' }}">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
{{--@include('masterGlobal.formValidation')--}}
@include('masterGlobal.getBankBranchesEvent')
@include('masterGlobal.chosenSelect')
{{--@include('masterGlobal.ajaxFormSubmit')--}}

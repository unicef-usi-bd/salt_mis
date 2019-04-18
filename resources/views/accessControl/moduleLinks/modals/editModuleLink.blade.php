<!-- PAGE CONTENT BEGINS -->
<style>
    .checkbox_style{
        height: 15px;
        width: 15px;
    }
</style>
<div class="col-md-12" style="margin-top: 10px">
    <form action="{{ url('/module-links/'.$editData->LINK_ID) }}" method="post" class="form-horizontal checkValidation" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('moduleLinks.module_link_create') }}</b><span style="color: red;"> *</span></label>
            <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select id="form-field-select-3 inputSuccess module_id" class="chosen-select form-control" name="module_id" data-placeholder="Select or search data">
                            <option value="">Select One</option>
                            @foreach($modules as $module)
                                <option value="{{$module->MODULE_ID}}" @if($module->MODULE_ID==$editData->MODULE_ID) selected @endif> {{$module->MODULE_NAME}}</option>
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
                        <input type="text" id="inputSuccess link_name" placeholder="Example:Module Link Name Here" name="link_name" value="{{ $editData->LINK_NAME }}" class="width-100" />
                    </span>

                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('moduleLinks.link_url') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="link_url" placeholder="Example:Module SL NO Here" value="{{ $editData->LINK_URI }}" id="inputSuccess link_url" class="width-100"  />
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('moduleLinks.sl_no') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="sl_no" value="{{ $editData->SL_NO }}" id="inputSuccess sl_no" class="width-100"  />
                    </span>
                </div>
            </div>


            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('dashboard.action') }}</b><!-- <span style="color: red;"> *</span> --> </label>
                <div class="col-xs-12 col-sm-9">
                    <span class="checkbox">
                        <label><input type="checkbox" name="create" value="1" @if($editData->CREATE==1) checked @endif  class="checkbox_style">{{ trans('moduleLinks.view') }}</label>
                        <label style="margin-left: 7px;"><input type="checkbox" name="view" value="1" @if($editData->READ==1) checked @endif class="checkbox_style">{{ trans('moduleLinks.create') }}</label>
                        <label style="margin-left: 7px;"><input type="checkbox" name="update" value="1" @if($editData->UPDATE==1) checked @endif  class="checkbox_style">{{ trans('moduleLinks.update') }}</label>
                        <label style="margin-left: 7px;"><input type="checkbox" name="delete" value="1" @if($editData->DELETE==1) checked @endif  class="checkbox_style">{{ trans('moduleLinks.delete') }}</label>
                        <label style="margin-left: 7px;"><input type="checkbox" name="status" value="1" @if($editData->STATUS==1) checked @endif  class="checkbox_style">{{ trans('moduleLinks.status') }}</label>
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
                <button type="submit" class="btn btn-info" id="formSubmit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{trans('dashboard.update')}}
                </button>
            </div>
        </div>
    </form>
</div>
@include('masterGlobal.formValidationEdit')
@include('masterGlobal.getBankBranchesEvent')
@include('masterGlobal.chosenSelect')
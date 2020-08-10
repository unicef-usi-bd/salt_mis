<div class="col-md-12">

    <form action="{{ url('/user-group-levels/'.$editUserGroupLevel->UG_LEVEL_ID) }}" class="form-horizontal" name="formData" method="POST">
        @csrf
        @method('PUT')
        {{--<input type="hidden" name="group_id" value="{{ $id }}">--}}

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('module.group_level_name') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess group_level_name" placeholder="{{ trans('module.example_group_name_here') }}" name="group_level_name" class="form-control col-xs-10 col-sm-5" value="{{ $editUserGroupLevel->UGLEVE_NAME }}"/>
            </div>
        </div>
       <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="active_status">
                    <option value="">Select One</option>
                    <option value="1" @if($editUserGroupLevel->IS_ACTIVE==1) selected @endif>Active</option>
                    <option value="0" @if($editUserGroupLevel->IS_ACTIVE==0) selected @endif>Inactive</option>
                </select>
            </span>
            </div>
        </div>
        <hr>
        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn" disabled="disabled">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-info" onclick="formSubmit(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.update') }}
                </button>
            </div>
        </div>
    </form>
</div>

@include('masterGlobal.ajaxFormSubmit')

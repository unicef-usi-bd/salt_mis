<div class="col-md-12">
    <form action="{{ url('/lookup-groups-data/'.$lookupGroupData->lookup_group_data_id) }}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.group_data_name') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess group-data-name" placeholder="Example:- Group Data name here" name="group_data_name" class="form-control" value="{{ $lookupGroupData->group_data_name }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.abbreviation') }}</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess group_data_abbr" placeholder="Example:- Group Data Abbreviation here" name="group_data_abbr" class="form-control col-xs-10 col-sm-5" value="{{ $lookupGroupData->group_data_abbr }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.user_define_id') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input type="number" id="inputSuccess user_define_id" placeholder="Example:- User Define Serial  here" name="user_define_id" class="form-control col-xs-10 col-sm-5" value="{{ $lookupGroupData->user_define_id }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.description') }}</b></label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="5" style="height:50%;" id="inputSuccess description form-field-8" name="description" placeholder="Description">{{ $lookupGroupData->description }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
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
        <div style="text-align: center;" class="form-group">
            <button type="reset" class="btn" disabled>
                <i class="ace-icon fa fa-undo bigger-110"></i>
                {{ trans('dashboard.reset') }}
            </button>
            <button type="submit" class="btn btn-info">
                <i class="ace-icon fa fa-check bigger-110"></i>
                {{ trans('dashboard.update') }}
            </button>
        </div>

    </form>
</div>

{{--@include('masterGlobal.formValidation')--}}
@include('masterGlobal.formValidationEdit')
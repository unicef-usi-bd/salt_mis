<div class="col-md-12">
    <form action="{{ url('/lookup-groups-data/'.$lookupGroupData->LOOKUPCHD_ID) }}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.group_data_name') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess LOOKUPCHD_NAME" placeholder="Example:- Group Data name here" name="LOOKUPCHD_NAME" class="form-control" value="{{ $lookupGroupData->LOOKUPCHD_NAME }}"/>
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.user_define_id') }}</b><span style="color: red;"> *</span> </label>--}}
            {{--<div class="col-sm-8">--}}
                {{--<input type="number" id="inputSuccess UD_ID" placeholder="Example:- User Define Serial  here" name="UD_ID" class="form-control col-xs-10 col-sm-5" value="{{ $lookupGroupData->UD_ID }}"/>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.description') }}</b></label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="5" style="height:50%;" id="inputSuccess DESCRIPTION form-field-8" name="DESCRIPTION" placeholder="Description">{{ $lookupGroupData->DESCRIPTION }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess ACTIVE_FLG" class="form-control" name="ACTIVE_FLG">
                    <option value="">Select One</option>
                    <option value="1" @if($lookupGroupData->ACTIVE_FLG == 1) selected @endif>Active</option>
                    <option value="0" @if($lookupGroupData->ACTIVE_FLG == 0) selected @endif>Inactive</option>
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
{{--@include('masterGlobal.formValidationEdit')--}}
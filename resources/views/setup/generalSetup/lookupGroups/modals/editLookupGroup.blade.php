<div class="col-md-12">
    <form action="{{ url('/lookup-groups/'.$lookupGroup->LOOKUPMST_ID) }}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.group_name') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess group-name" placeholder="Example:- Group name here" name="LOOKUPMST_NAME" class="form-control" value="{{ $lookupGroup->LOOKUPMST_NAME }}"/>
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.user_define_id') }}</b><span style="color: red;"> *</span> </label>--}}
            {{--<div class="col-sm-8">--}}
                {{--<input type="number" id="inputSuccess user_define_sl" placeholder="Example:- User Define Serial Number Here" name="UD_SL" class="form-control col-xs-10 col-sm-5" value="{{ $lookupGroup->UD_SL }}"/>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.description') }}</b></label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="5" style="height:50%;" id="inputSuccess description form-field-8" name="DESCRIPTION" placeholder="Description">{{ $lookupGroup->DESCRIPTION }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG">
                    <option value="">-Select-</option>
                    <option value="1" @if($lookupGroup->ACTIVE_FLG == 1) selected @endif>Active</option>
                    <option value="0" @if($lookupGroup->ACTIVE_FLG == 0) selected @endif>Inactive</option>
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

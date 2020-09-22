<div class="col-md-12">
    <form action="{{ url('/certificate') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>Certificate Issuer</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <select class="form-control chosen-select CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID"  >
                    <option value="">Select</option>
                    @foreach($certificates as $row)
                        <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Issuer Name</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 ISSUR_ID inputSuccess" class="form-control ISSUR_ID" name="ISSUR_ID" >
                    <option value="">-Select-</option>
                    @foreach($issuers as $row)
                        <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>
        <div class="form-group" style="padding-left: 0 !important;">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right" style="padding-left: 0 !important;"><b>Mill Type </b><!-- <span style="color: red;"> *</span>  --></label>
            <div class="col-xs-12 col-sm-9" style="padding-left: 0 !important;">
                <span class="checkbox">
                    @foreach($millTypes as $key=>$millType)
                        <label style="margin-right: 10px;"><input type="radio" name="mill_type_id" value="{{ $millType->LOOKUPCHD_ID }}" @if($key==0) checked @endif class="checkbox_style"> {{ $millType->LOOKUPCHD_NAME }}</label>
                    @endforeach
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Certificate Type</b><!-- <span style="color: red;"> *</span>  --></label>
            <div class="col-xs-12 col-sm-9">
                <span class="checkbox">
                    <label style="margin-left: 7px;"><input type="checkbox" name="CERTIFICATE_TYPE" id="CERTIFICATE_TYPE" value="1" class="checkbox_style">Mandatory</label>
                    {{--<label style="margin-left: 7px;"><input type="checkbox" name="CERTIFICATE_TYPE" id="CERTIFICATE_TYPE" value="0" class="checkbox_style">Not Mandatory</label>--}}
                </span>
            </div>

        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Expirable Status</b><!-- <span style="color: red;"> *</span>  --></label>
            <div class="col-xs-12 col-sm-9">
                <span class="checkbox">
                    <label style="margin-left: 7px;"><input type="checkbox"  name="IS_EXPIRE" id="IS_EXPIRE" value="1" class="checkbox_style">Expirable</label>
                    {{--<label style="margin-left: 7px;"><input type="checkbox" name="expire" id="expire" value="0" class="checkbox_style">Not Expirable</label>--}}
                </span>

            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG" id="ACTIVE_FLG">
                    <option value="">-Select-</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
            </div>
        </div>

        <hr>
        <div class="clearfix">
            <div class="col-md-12 center">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>

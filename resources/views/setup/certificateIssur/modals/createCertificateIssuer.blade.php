<style>
    .my-error-class {
        color:red;
    }
    .my-valid-class {
        color:green;
    }
</style>
<div class="col-md-12">
    <form id="myform" action="{{ url('/certificate') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>Certificate Name</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <input type="text" id="CERTIFICATE_NAME" name="CERTIFICATE_NAME"  class="form-control CERTIFICATE_NAME" value=""/>
                    </span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Issuer Name</b><span style="color: red;"> </span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 ISSUR_ID inputSuccess" class="form-control ISSUR_ID" name="ISSUR_ID" >
                    <option>Select One</option>
                    @foreach($issuerId as $row)
                        <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Certificate Type</b></label>--}}
            {{--<div class="col-sm-8">--}}
                {{--<input type="checkbox" name="CERTIFICATE_TYPE" id="CERTIFICATE_TYPE" value="1">Mandatory--}}
            {{--<span class="block input-icon input-icon-right">--}}
                {{--<select id="inputSuccess CERTIFICATE_TYPE" class="form-control" name="CERTIFICATE_TYPE" id="CERTIFICATE_TYPE">--}}
                    {{--<option value="">Select One</option>--}}
                    {{--<option value="1">Mandatory</option>--}}
                    {{--<option value="0">Not Mandatory</option>--}}
                {{--</select>--}}
            {{--</span>--}}
            {{--</div>--}}
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
                        <label style="margin-left: 7px;"><input type="checkbox" name="IS_EXPIRE" id="IS_EXPIRE" value="1" class="checkbox_style">Expirable</label>
                        {{--<label style="margin-left: 7px;"><input type="checkbox" name="expire" id="expire" value="0" class="checkbox_style">Not Expirable</label>--}}
                    </span>

            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG" id="ACTIVE_FLG">
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
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    $('#myform').validate({ // initialize the plugin
        errorClass: "my-error-class",
        //validClass: "my-valid-class",
        rules: {
            ITEM_TYPE:{
                required:true,
            },
            ITEM_NAME:{
                required:true,
            }

        }
    });
</script>

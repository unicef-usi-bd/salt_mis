<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>
        <form class="form-horizontal frmContent" name="formData" method="POST">
        @csrf
        <input type="hidden" id="inputSuccess lookup_group_id"  name="lookup_group_id" value="{{ $id }}" />
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.group_data_name') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess group_data_name" placeholder="Example:- Group Data name here" name="group_data_name" class="form-control col-xs-10 col-sm-5" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.abbreviation') }}</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess group_data_abbr" placeholder="Example:- Group Data Abbreviation here" name="group_data_abbr" class="form-control col-xs-10 col-sm-5" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.user_define_id') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input type="number" id="inputSuccess user_define_id" placeholder="Example:- User Define Serial here" name="user_define_id" class="form-control col-xs-10 col-sm-5" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.description') }}</b></label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="5" style="height:50%;" id="inputSuccess description form-field-8" name="description" placeholder="Description"></textarea>
            </div>
        </div>
        <!-- <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="active_status">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
            </div>
        </div> -->
        <hr>
        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'lookup-groups-data' }}">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>

{{--@include('masterGlobal.ajaxFormSubmit')--}}

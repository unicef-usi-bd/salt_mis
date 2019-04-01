<div class="col-md-12">
    <!-- PAGE CONTENT BEGINS -->
    <form action="{{ url('/association-setup') }}" method="post" class="form-horizontal checkValidation" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> {{ trans('lookupGroupIndex.name') }}</b> <span style="color: red;"> *</span></label>
            <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" id="inputSuccess" name="ASSOCIATION_NAME" value="{{ old('ASSOCIATION_NAME') }}" placeholder="Enter Lavel Name" class="width-100" />
                <input type="hidden" id="inputSuccess" name="PARENT_ID" value="{{ $pr_id }}" class="width-100" />
            </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> {{ trans('cigGroup.active_status') }}</b></label>
            <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <select class="form-control" name="ACTIVE_FLG">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-info" id="formSubmit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
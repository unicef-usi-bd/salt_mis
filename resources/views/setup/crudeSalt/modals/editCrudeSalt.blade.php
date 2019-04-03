<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12" style="margin-top: 10px">
    <form action="{{ url('/crude-salt-details/'.$editCrudSaltDetail->CRUDSALTDETAIL_ID) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>CRUD Salt Type</b><span style="color: red;">* </span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess" class="form-control" name="CRUDSALT_TYPE_ID">
                    <option value="">Select One</option>
                    @foreach($crudSaltTypes as $crudSaltType)
                        <option value="{{ $crudSaltType->ITEM_NO }}" @if($editCrudSaltDetail->CRUDSALT_TYPE_ID == $crudSaltType->ITEM_NO) selected @endif>{{ $crudSaltType->ITEM_NAME  }}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Sodium chloride</b><span style="color: red;"> </span> </label>
            <span class="col-sm-7">
                <input type="text" id="inputSuccess user_define_sl" placeholder="Example:- Sodium chloride Here" name="SODIUM_CHLORIDE" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudSaltDetail->SODIUM_CHLORIDE }}"/>
            </span>
            <span class="col-sm-1">
                <span class="group-addon percentageSize">
                    <i class="ace-icon fa fa-percent"></i>
                </span>
            </span>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Moisturizer</b><span style="color: red;"> </span> </label>
            <span class="col-sm-7">
                <input type="text" id="inputSuccess user_define_sl" placeholder="Example:- Moisturizer Here" name="MOISTURIZER" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudSaltDetail->MOISTURIZER }}"/>
            </span>
            <span class="col-sm-1">
                <span class="group-addon percentageSize">
                    <i class="ace-icon fa fa-percent"></i>
                </span>
            </span>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Iodine content(PPM)</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess user_define_sl" placeholder="Example:- Iodine content(PPM) Here" name="PPM" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudSaltDetail->PPM }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>PH</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess user_define_sl" placeholder="Example:- PH Here" name="PH" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudSaltDetail->PH }}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG">
                    <option value="">Select One</option>
                    <option value="1" @if($editCrudSaltDetail->ACTIVE_FLG == 1) selected @endif>Active</option>
                    <option value="0" @if($editCrudSaltDetail->ACTIVE_FLG == 0) selected @endif>Inactive</option>
                </select>
            </span>
            </div>
        </div>
        <hr>
        <div class="clearfix">
            <div class="col-md-offset-5 col-md-7" style="margin-top: 20px;">
                <button type="reset" class="btn" disabled="disabled">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-info" id="formSubmit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.update') }}
                </button>
            </div>
        </div>
    </form>
</div>

<div class="col-md-12">

    <form action="{{ url('/require-chemical-chd') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <input type="hidden" id="inputSuccess RMALLOMST_ID"  name="RMALLOMST_ID" value="{{ $id }}" />
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Item List</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess ITEM_ID" class="chosen-select form-control" name="ITEM_ID" data-placeholder="Select or search data">
                       <option value="">Select Chemical Type</option>
                        @foreach($chemicleType as $chemical)
                            <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Salt Amount</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess WAST_PER" placeholder="Example: Wastage Amount here" name="CRUDE_SALT" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Chemical Amount</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess USE_QTY" placeholder="Example: Chemical Amount here" name="USE_QTY" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess ACTIVE_FLG" class="form-control" name="ACTIVE_FLG">
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

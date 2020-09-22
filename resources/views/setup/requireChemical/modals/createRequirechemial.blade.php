<div class="col-md-12">
    <form action="{{ url('/require-chemical-per-kg') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Salt Amount</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess union_name" placeholder="Salt Amount here" name="SALT_AMOUNT" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Chemical Type</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess " class="chosen-select form-control" name="ITEM_NO" data-placeholder="Select or search data">
                       <option value=""></option>
                        @foreach($chemicalTypes as $chemicalType)
                            <option value="{{$chemicalType->ITEM_NO}}"> {{$chemicalType->ITEM_NAME}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Chemical Amount</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess union_name" placeholder="Example: Chemical Amount here" name="CHEMICAL_AMOUNT" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Wastage Amount</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess union_name" placeholder="Example: Wastage Amount here" name="WASTAGE_AMOUNT" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG">
                    <option value="">-Select-</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
            </div>
        </div>


        <hr>
        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn test">
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

@include('masterGlobal.chosenSelect')

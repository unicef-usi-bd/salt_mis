<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>

    <form action="{{ url('/require-chemical-per-kg/'.$editRequiredPerkg->REQUIRE_CHEMICAL_ID) }}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Salt Amount</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess union_name" placeholder="Example: Salt Amount here" name="SALT_AMOUNT" class="form-control col-xs-10 col-sm-5" value="{{ $editRequiredPerkg->SALT_AMOUNT }}"/>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Chemical Type</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess " class="chosen-select form-control" name="ITEM_NO" data-placeholder="Select or search data">
                       <option value=""></option>
                        @foreach($chemicalTypes as $chemicalType)
                            <option value="{{$chemicalType->ITEM_NO}}" @if($editRequiredPerkg->ITEM_NO == $chemicalType->ITEM_NO) selected @endif> {{$chemicalType->ITEM_NAME}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Chemical Amount</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess union_name" placeholder="Example: Chemical Amount here" name="CHEMICAL_AMOUNT" class="form-control col-xs-10 col-sm-5" value="{{ $editRequiredPerkg->CHEMICAL_AMOUNT }}"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Wastage Amount</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess union_name" placeholder="Example: Wastage Amount here" name="WASTAGE_AMOUNT" class="form-control col-xs-10 col-sm-5" value="{{ $editRequiredPerkg->WASTAGE_AMOUNT }}"/>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG">
                    <option value="">Select One</option>
                    <option value="1" @if($editRequiredPerkg->ACTIVE_FLG == 1) selected @endif>Active</option>
                    <option value="0" @if($editRequiredPerkg->ACTIVE_FLG == 0) selected @endif>Inactive</option>
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

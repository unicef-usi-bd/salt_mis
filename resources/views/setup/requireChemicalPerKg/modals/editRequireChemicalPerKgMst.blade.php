<div class="col-md-12">

    <form action="{{ url('/require-chemical-mst/'.$editRequireChemicalPerKg->RMALLOMST_ID) }}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Item Type</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess PRODUCT_ID" class="chosen-select form-control" name="PRODUCT_ID" data-placeholder="Select or search data">
                       <option value=""></option>
                        @foreach($productionTypes as $productionType)
                            <option value="{{$productionType->ITEM_NO}}" @if($productionType->ITEM_NO == $editRequireChemicalPerKg->ITEM_NO) selected @endif> {{$productionType->ITEM_NAME}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('cigGroup.active_status') }}</b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="ACTIVE_FLG" class="form-control" name="ACTIVE_FLG">
                    <option value="">Select One</option>
                    <option value="1" @if($editRequireChemicalPerKg->ACTIVE_FLG==1) selected @endif>Active</option>
                    <option value="0" @if($editRequireChemicalPerKg->ACTIVE_FLG==0) selected @endif>Inactive</option>
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

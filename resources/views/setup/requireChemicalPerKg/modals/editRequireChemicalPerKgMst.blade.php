<div class="col-md-12">
    {{--<div id="success" class="alert alert-block alert-success" style="display: none;">--}}
    {{--<span id="successMessage"></span>--}}
    {{--<button type="button" class="close" data-dismiss="alert">--}}
    {{--<i class="ace-icon fa fa-times"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    <form action="{{ url('/require-chemical-mst/'.$editRequireChemicalPerKg->RMALLOMST_ID) }}" method="post" class="form-horizontal" role="form">
        {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Item Type</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess PRODUCT_ID" class="chosen-select form-control" name="PRODUCT_ID" data-placeholder="Select or search data">
                       <option value=""></option>
                        @foreach($itemTypes as $item)
                            <option value="{{$item->LOOKUPCHD_ID}}"@if($item->LOOKUPCHD_ID==$editRequireChemicalPerKg->PRODUCT_ID) selected @endif>{{ $item->LOOKUPCHD_NAME }}</option>
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
                {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'lookup-groups' }}">--}}
                <button type="submit" class="btn btn-primary">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>


{{--@include('masterGlobal.formValidation')--}}
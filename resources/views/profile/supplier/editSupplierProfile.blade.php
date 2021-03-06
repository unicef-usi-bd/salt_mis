<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12">
    <form action="{{ url('/supplier-profile/'.$editData->SUPP_ID_AUTO) }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <div class="form-group">
                <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Supplier ID</b></label>
                <div class="col-xs-8">
                    <input style="width: 335px; margin-left: 2px;" readonly type="text" id="inputSuccess" placeholder="Supplier ID" name="SUPPLIER_ID" class="form-control col-xs-10 col-sm-5" value="{{ $editData->SUPPLIER_ID }}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Supplier Type</b><span style="color: red">*</span></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select id="SUPPLIER_TYPE_ID" class="form-control chosen-select" name="SUPPLIER_TYPE_ID" data-placeholder="Select or search data">
                            <option value=""></option>
                            @foreach($getSupplierType as $supplier)
                                <option value="{{$supplier->LOOKUPCHD_ID}}" @if ($supplier->LOOKUPCHD_ID==$editData->SUPPLIER_TYPE_ID) selected @endif>{{ $supplier->LOOKUPCHD_NAME }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Trading Name</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" id="inputSuccess org_name" name="TRADING_NAME" value="{{ $editData->TRADING_NAME }}" class="width-100" />
                    </span>

                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Trader Name</b><span style="color: red;">* </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="TRADER_NAME" value="{{ $editData->TRADER_NAME }}" id="inputSuccess ogr_address" class="width-100"  />
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Trade Licence No.</b><span style="color: red;"> </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="LICENCE_NO" id="inputSuccess org_slogan" value="{{ $editData->LICENCE_NO }}" class="width-100"  />
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Email</b><span style="color: red;"> </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="EMAIL" id="inputSuccess fax" value="{{ $editData->EMAIL }}" class="width-100" />
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Mobile No. </b><span style="color: red">*</span></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="PHONE" id="inputSuccess website" value="{{ $editData->PHONE }}" class="width-100"  />
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Division</b><span style="color: red">*</span></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control  chosen-select division" name="DIVISION_ID">
                            <option value="">{{ trans('organization.select_one') }}</option>
                            @foreach($getDivision as $row)
                                <option value="{{ $row->DIVISION_ID }}" @if($editData->DIVISION_ID==$row->DIVISION_ID) selected @endif>{{ $row->DIVISION_NAME }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>District</b><span style="color: red">*</span></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control district chosen-select" name="DISTRICT_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editData->DISTRICT_ID }}">{{ $editData->DISTRICT_NAME }}</option>
                        </select>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Thana/Upazila</b><span style="color: red">*</span></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control chosen-select upazila" name="UPAZILA_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editData->UPAZILA_ID }}">{{ $editData->UPAZILA_NAME }}</option>
                        </select>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Bazar</b></label>
                <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <input autocomplete="off" type="text"  name="BAZAR_NAME" id="inputSuccess email_address" value="{{ $editData->BAZAR_NAME }}" class="width-100"  />
             </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Remarks</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <textarea class="form-control" rows="6" name="REMARKS" placeholder="Remarks here">{{ $editData->REMARKS }}</textarea>
                    </span>
                </div>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-12 center">
                <button type="reset" class="btn" disabled>
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-info" onclick="formSubmit(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.update') }}
                </button>
            </div>
        </div>

    </form>
</div>
@include('masterGlobal.chosenSelect')

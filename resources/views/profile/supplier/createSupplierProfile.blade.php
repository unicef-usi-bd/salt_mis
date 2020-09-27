<div class="col-md-12">
    <form action="{{ url('/supplier-profile') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Supplier ID</b></label>
                        <div class="col-xs-8">
                            <input style="width: 365px; margin-left: 5px;" readonly type="text" id="inputSuccess" placeholder="Supplier ID" name="SUPPLIER_ID" class="insertIdContainer form-control col-xs-10 col-sm-5" value="{{ $supplierId }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Supplier Type</b><span style="color: red">*</span></label>
                        <div class="col-xs-8">
                    <span class="block input-icon input-icon-right" style="width: 365px; margin-left: 5px;">
                        <select id="SUPPLIER_TYPE_ID" class="form-control chosen-select " name="SUPPLIER_TYPE_ID" data-placeholder=" -Select-">
                            <option value=""></option>
                            @foreach($getSupplierType as $supplier)
                                <option value="{{$supplier->LOOKUPCHD_ID}}"> {{$supplier->LOOKUPCHD_NAME}}</option>
                            @endforeach
                        </select>
                    </span>
                        </div>
                    </div>
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Trading Name</b><span style="color: red">*</span></label>
                    <div class="col-xs-8">
                        <input autocomplete="off" type="text" id="inputSuccess TRADING_NAME" placeholder="Example:- Trading Name Here" name="TRADING_NAME" class="form-control col-xs-10 col-sm-5 TRADING_NAME" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Trader Name</b><span style="color: red">*</span></label>
                    <div class="col-xs-8">
                        <input autocomplete="off" type="text" id="inputSuccess TRADER_NAME" placeholder="Example:- Trader Name Here" name="TRADER_NAME" class="form-control col-xs-10 col-sm-5 TRADER_NAME" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Trade licence No.</b><span style="color: red"></span> </label>
                    <div class="col-xs-8">
                        <input autocomplete="off" type="text" id="inputSuccess LICENCE_NO" placeholder="Example:- Trade Licence No." name="LICENCE_NO" class="form-control col-xs-10 col-sm-5 LICENCE_NO" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Email</b></label>
                    <div class="col-xs-8">
                        <input autocomplete="off" type="text" id="inputSuccess EMAIL" placeholder="Example:- Email Here" name="EMAIL" class="form-control col-xs-10 col-sm-5 EMAIL" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Mobile No.</b><span style="color: red"> *</span> </label>
                    <div class="col-xs-8">
                        <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- Mobile No. Here" name="PHONE" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b><span style="color: red">*</span></label>
                    <div class="col-xs-8">
                    <span class="block input-icon input-icon-right">
                        <select id="DIVISION_ID" class="form-control chosen-select division" name="DIVISION_ID" data-placeholder=" -Select-">
                            <option value="">-Select-</option>
                            @foreach($getDivision as $row)
                                <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                            @endforeach
                        </select>
                    </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b><span style="color: red">*</span></label>
                    <div class="col-xs-8">
                    <span class="block input-icon input-icon-right">
                        <select id="DISTRICT_ID" class="form-control chosen-select district" name="DISTRICT_ID" data-placeholder=" -Select-">
                            <option value="">-Select-</option>
                        </select>
                    </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Thana/Upazila</b><span style="color: red">*</span></label>
                    <div class="col-xs-8">
                    <span class="block input-icon input-icon-right">
                        <select id="THANA_ID" class="form-control chosen-select upazila" name="UPAZILA_ID" data-placeholder=" -Select-">
                            <option value="">-Select-</option>
                         </select>
                    </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Bazar</b> </label>
                    <div class="col-xs-8">
                        <input autocomplete="off" type="text" name="BAZAR_NAME" class="form-control col-xs-10 col-sm-5" value="" placeholder="Example:- Bazar Name Here"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b></label>
                    <div class="col-xs-8">
                        <textarea class="form-control"  rows="5" name="REMARKS" placeholder="Example:- Remarks here"></textarea>

                    </div>
                </div>

            </div>
            <hr>
            <div class="clearfix">
                <div class="col-md-12 center">
                    <button type="reset" class="btn">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        {{ trans('dashboard.reset') }}
                    </button>
                    <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        {{ trans('dashboard.submit') }}
                    </button>
                </div>
            </div>
        </div>


    </form>
</div>

@include('masterGlobal.chosenSelect')

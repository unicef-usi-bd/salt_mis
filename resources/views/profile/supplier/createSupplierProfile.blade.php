<div class="col-md-12">
    <form action="{{ url('/supplier-profile') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="col-md-12">

            <div class="col-md-6">

                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Trading Name</b><span style="color: red">*</span></label>
                    <div class="col-xs-8">
                        <input type="text" id="inputSuccess" placeholder="Trading Name Here" name="TRADING_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Trade licence No</b><span style="color: red">*</span> </label>
                    <div class="col-xs-8">
                        <input type="text" id="inputSuccess" placeholder="licence No Here" name="LICENCE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>
                    <div class="col-xs-8">
                    <span class="block input-icon input-icon-right">
                        <select id="DIVISION_ID" class="form-control chosen-select" name="DIVISION_ID" data-placeholder="Select or search data">
                            <option value="">Select Division</option>
                            @foreach($getDivision as $row)
                            <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                            @endforeach
                        </select>
                    </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b></label>
                    <div class="col-xs-8">
                    <span class="block input-icon input-icon-right">
                        <select id="DISTRICT_ID" class="form-control chosen-select district" name="DISTRICT_ID" data-placeholder="Select or search data">
                            <option value="">Select District</option>
                        </select>
                    </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Thana/Upazila</b></label>
                    <div class="col-xs-8">
                    <span class="block input-icon input-icon-right">
                        <select id="UPAZILA_ID" class="form-control chosen-select upazila" name="UPAZILA_ID" data-placeholder="Select or search data">
                            <option value="">Select Upazila/Thana</option>
                         </select>
                    </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Union</b></label>
                    <div class="col-xs-8">
                    <span class="block input-icon input-icon-right">
                        <select id="UNION_ID" class="form-control chosen-select union" name="UNION_ID" data-placeholder="Select or search data">
                            <option value="">Select Union</option>
                        </select>
                    </span>
                    </div>
                </div>


            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Trader Name</b><span style="color: red">*</span></label>
                    <div class="col-xs-8">
                        <input type="text" id="inputSuccess" placeholder="Trader Name Here" name="TRADER_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Supplier ID</b></label>
                    <div class="col-xs-8">
                        <input readonly type="text" id="inputSuccess" placeholder="Supplier ID" name="SUPPLIER_ID" class="form-control col-xs-10 col-sm-5" value="{{ $supplierId }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Phone Number</b></label>
                    <div class="col-xs-8">
                        <input type="text" id="inputSuccess" placeholder="Phone Number Here" name="PHONE" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Bazar</b> </label>
                    <div class="col-xs-8">
                        <input type="text" name="BAZAR_NAME" class="form-control col-xs-10 col-sm-5" value="" placeholder="Bazar Name Here"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Email</b></label>
                    <div class="col-xs-8">
                        <input type="text" id="inputSuccess" placeholder="Email Here" name="EMAIL" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b></label>
                    <div class="col-xs-8">
                        <textarea class="form-control" rows="5" name="REMARKS" placeholder="Remarks here"></textarea>

                    </div>
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
        </div>


    </form>
</div>
@include('masterGlobal.chosenSelect')
@include('masterGlobal.getDistrict')
@include('masterGlobal.getUpazila')
@include('masterGlobal.getUnion')
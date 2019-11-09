<div class="col-md-12">
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>
    <form id="myform" action="{{ url('/supplier-profile') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="col-md-12">

            <div class="col-md-6" style="margin-top: 75px;">

                <div class="form-group">
                    <div class="form-group">
                        <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Supplier ID</b></label>
                        <div class="col-xs-8">
                            <input style="width: 365px; margin-left: 5px;" readonly type="text" id="inputSuccess" placeholder="Supplier ID" name="SUPPLIER_ID" class="form-control col-xs-10 col-sm-5" value="{{ $supplierId }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Supplier Type</b></label>
                        <div class="col-xs-8">
                    <span class="block input-icon input-icon-right" style="width: 365px; margin-left: 5px;">
                        <select id="SUPPLIER_TYPE_ID" class="form-control chosen-select " name="SUPPLIER_TYPE_ID" data-placeholder="Select or search data">
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
                        <input type="text" id="inputSuccess TRADING_NAME" placeholder="Trading Name Here" name="TRADING_NAME" class="form-control col-xs-10 col-sm-5 TRADING_NAME" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Trader Name</b><span style="color: red">*</span></label>
                    <div class="col-xs-8">
                        <input type="text" id="inputSuccess TRADER_NAME" placeholder="Trader Name Here" name="TRADER_NAME" class="form-control col-xs-10 col-sm-5 TRADER_NAME" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Trade licence No</b><span style="color: red"></span> </label>
                    <div class="col-xs-8">
                        <input type="text" id="inputSuccess LICENCE_NO" placeholder="licence No Here" name="LICENCE_NO" class="form-control col-xs-10 col-sm-5 LICENCE_NO" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Email</b></label>
                    <div class="col-xs-8">
                        <input type="text" id="inputSuccess EMAIL" placeholder="Email Here" name="EMAIL" class="form-control col-xs-10 col-sm-5 EMAIL" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Phone Number</b><span style="color: red"> *</span> </label>
                    <div class="col-xs-8">
                        <input type="text" id="inputSuccess" placeholder="Phone Number Here" name="PHONE" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <h4  style="color: #1B6AAA; text-align: center;">Address</h4>
                <hr>
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
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Thana/Upazilla</b></label>
                    <div class="col-xs-8">
                    <span class="block input-icon input-icon-right">
                        <select id="THANA_ID" class="form-control chosen-select thana" name="THANA_ID" data-placeholder="Select or search data">
                            <option value="">Select Thana</option>
                         </select>
                    </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Bazar</b> </label>
                    <div class="col-xs-8">
                        <input type="text" name="BAZAR_NAME" class="form-control col-xs-10 col-sm-5" value="" placeholder="Bazar Name Here"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b></label>
                    <div class="col-xs-8">
                        <textarea class="form-control"  rows="5" name="REMARKS" placeholder="Remarks here"></textarea>

                    </div>
                </div>

            </div>
            <hr>
            <div class="clearfix">
                <div class="col-md-offset-3 col-md-9" style="    margin-left: 500px;">
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
@include('masterGlobal.getThana')

<script>
    $(document).ready(function () {
        $.validator.addMethod(
            "regex",
            function(value, element, regexp)
            {
                if (regexp.constructor != RegExp)
                    regexp = new RegExp(regexp);
                else if (regexp.global)
                    regexp.lastIndex = 0;
                return this.optional(element) || regexp.test(value);
            },
            "Please check your input."
        );

        $('#myform').validate({ // initialize the plugin
            errorClass: "my-error-class",
            //validClass: "my-valid-class",
            rules: {
                TRADING_NAME:{
                    required: true,
                },
                TRADER_NAME:{
                    required: true,
                },
                EMAIL:{
                    //required: true,
                    email: true
                },
                PHONE:{
                    required: true,
                    maxlength:11,
                    minlength:11,
                    regex:/^(?:\+?88)?01[1-9]\d{8}$/,
                }

            }
        });

    });
</script>
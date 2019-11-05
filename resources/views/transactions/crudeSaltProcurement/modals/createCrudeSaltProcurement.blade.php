<div class="col-md-12">
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>
    <form id="myform" action="{{ url('/crude-salt-procurement') }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Crude Salt Type</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess RECEIVE_NO" class="chosen-select form-control" name="RECEIVE_NO" data-placeholder="Select Crude Salt Type">
                               <option value=""></option>
                                @foreach($crudeSaltTypes as $chemical)
                                    <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Trading Name</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess SUPP_ID_AUTO" class="chosen-select form-control" name="SUPP_ID_AUTO" data-placeholder="Select Trading Name">
                               <option value=""></option>
                                @foreach($crudeSaltSuppliers as $crudeSaltSupplier)
                                    <option value="{{$crudeSaltSupplier->SUPP_ID_AUTO}}"> {{$crudeSaltSupplier->TRADING_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess RCV_QTY" placeholder="Example: Amount here in KG" name="RCV_QTY" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" >KG</i>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Invoice No</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="Example: Invoice No here" name="INVOICE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Source from</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="privileges" onclick="craateUserJsObject.ShowPrivileges();" class="chosen-select form-control" name="SOURCE_ID" data-placeholder="Select Source">
                                @foreach($importedData as $row)
                               <option value="{{$row->LOOKUPCHD_ID}}">{{$row->LOOKUPCHD_NAME}}</option>
                                @endforeach
                                @foreach($crudeSaltSources as $crudeSaltSource)
                                    <option value="{{$crudeSaltSource->LOOKUPCHD_ID}}"> {{$crudeSaltSource->LOOKUPCHD_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group resources"  style=" display: none;">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Country Name</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess COUNTRY_ID" class="form-control" name="COUNTRY_ID" data-placeholder="Select or search data">
                               <option value="">Select Country Name</option>
                                @foreach($importedCrudeSaltCountry as $country)
                                    <option value="{{$country->COUNTRY_ID}}"> {{$country->COUNTRY_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <textarea rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 15px;">
                <h4  style="color: #1B6AAA;">Transport Details</h4>
                <hr>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Driver Name</b><span style="color: red;"> *</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="inputSuccess DRIVER_NAME" placeholder="Example: Driver Name here" name="DRIVER_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Vehicle License</b><span style="color: red;"> *</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="inputSuccess VEHICLE_LICENSE" placeholder="Example: Vehicle License here" name="VEHICLE_LICENSE" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Mobile Number</b><span style="color: red;"> *</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="inputSuccess MOBILE_NO" placeholder="Example: Mobile Number here" name="MOBILE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Driving licence</b><span style="color: red;"> *</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="inputSuccess VEHICLE_NO" placeholder="Example: Vehicle No here" name="VEHICLE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Transport rent</b><span style="color: red;"> *</span> </label>
                        <div class="col-sm-8">
                            <input type="text" id="inputSuccess TRANSPORT_NAME" placeholder="Example: Transport Name here" name="TRANSPORT_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-8">
                            <textarea rows="3"  placeholder="Example: Remarks here" name="REMARKS_Tansport" class="form-control col-xs-10 col-sm-5" /></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="clearfix" style="margin-left: 150px;">
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
@include('masterGlobal.datePicker')

<script>
    var Privileges = jQuery('#privileges');
    var select = this.value;
    Privileges.change(function () {
        if ($(this).val() == 44) {
            $('.resources').show();
        }
        else $('.resources').hide();
    });

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
                RCV_QTY:{
                    required: true,
                },
                DRIVER_NAME:{
                    required: true,
                },
                VEHICLE_LICENSE:{
                    required: true,
                },
                VEHICLE_NO:{
                    required: true,
                },
                TRANSPORT_NAME:{
                    required: true,
                },
                MOBILE_NO:{
                    required: true,
                    maxlength:11,
                    minlength:11,
                    regex:/^(?:\+?88)?01[1-9]\d{8}$/,
                }
            }
        });

    });

</script>





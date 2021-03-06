<div class="col-md-12">
    <form action="{{ url('/crude-salt-procurement') }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-4 control-label no-padding-right" for="form-field-1-1"><b>Crude Salt Type</b><span style="color: red;">* </span></label>
                    <div class="col-sm-7">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess RECEIVE_NO" class="chosen-select form-control" name="RECEIVE_NO" data-placeholder=" -Select-">
                               <option value=""></option>
                                @foreach($crudeSaltTypes as $chemical)
                                    <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-4 control-label no-padding-right" for="form-field-1-1"><b>Trading Name</b><span style="color: red;"> * </span></label>
                    <div class="col-sm-7">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess SUPP_ID_AUTO" class="chosen-select form-control" name="SUPP_ID_AUTO" data-placeholder=" -Select-">
                               <option value=""></option>
                                @foreach($crudeSaltSuppliers as $crudeSaltSupplier)
                                    <option value="{{$crudeSaltSupplier->SUPP_ID_AUTO}}"> {{$crudeSaltSupplier->TRADING_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Amount (KG)</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-7">
                        <input autocomplete="off" type="text" id="inputSuccess RCV_QTY" placeholder="Example:- Amount Here In KG" name="RCV_QTY" class="form-control col-xs-10 col-sm-5"  onkeypress="return numbersOnly(this, event)" value=""/>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Invoice No.</b><span style="color: red;"> * </span> </label>
                    <div class="col-sm-7">
                        <input autocomplete="off" type="text" placeholder="Example:- Invoice No. Here" name="INVOICE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-4 control-label no-padding-right" for="form-field-1-1"><b>Source From</b><span style="color: red;"> * </span></label>
                    <div class="col-sm-7">
                        <span class="block input-icon input-icon-right">
                            <select class="chosen-select form-control chemical-source" name="SOURCE_ID" data-placeholder=" -Select-">

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
                    <label for="inputSuccess" class="col-sm-4 control-label no-padding-right" for="form-field-1-1"><b>Country Name</b><span style="color: red;"> </span></label>
                    <div class="col-sm-7">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess COUNTRY_ID" class="form-control" name="COUNTRY_ID" data-placeholder=" -Select-">
                               <option value="">Select Country Name</option>
                                @foreach($importedCrudeSaltCountry as $country)
                                    <option value="{{$country->COUNTRY_ID}}"> {{$country->COUNTRY_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-7">
                        <textarea rows="3"  placeholder="Example:- Remarks Here" name="REMARKS" class="form-control col-xs-5 col-sm-5"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 15px;">
                <h4  style="color: #1B6AAA;">Transport Details</h4>
                <hr>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Driver Name</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess DRIVER_NAME" placeholder="Example:- Driver Name Here" name="DRIVER_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Vehicle License</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess VEHICLE_LICENSE" placeholder="Example:- Vehicle License Here" name="VEHICLE_LICENSE" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Mobile No.</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess MOBILE_NO" placeholder="Example:- Mobile No. Here" name="MOBILE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Driving Licence</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess VEHICLE_NO" placeholder="Example:- Driving Licence Here" name="VEHICLE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Transport Fare</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess TRANSPORT_NAME" placeholder="Example:- Transport Fare Here" name="TRANSPORT_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-7">
                            <textarea rows="3"  placeholder="Example:- Remarks Here" name="REMARKS_Tansport" class="form-control col-xs-10 col-sm-5" /></textarea>
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
                <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
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
    $(document).on('change', '.chemical-source', function () {
        let sourceId = $(this).val();
        if (parseInt(sourceId) === 1001) {
            $('.resources').show();
        }else {
            $('.resources').hide();
        }
    });
</script>





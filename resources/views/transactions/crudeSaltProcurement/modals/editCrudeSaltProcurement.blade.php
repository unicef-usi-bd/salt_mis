<div class="col-md-12">
    <form action="{{ url('/crude-salt-procurement/'.$editCrudeSalt->RECEIVEMST_ID) }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-4 control-label no-padding-right" for="form-field-1-1"><b>Crude Salt Type</b><span style="color: red;"> * </span></label>
                    <div class="col-sm-7">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess RECEIVE_NO" class="chosen-select form-control" name="RECEIVE_NO" data-placeholder="Select Crude Salt Type">
                               <option value=""></option>
                                @foreach($crudeSaltTypes as $chemical)
                                    <option value="{{ $chemical->ITEM_NO }}" @if($chemical->ITEM_NO==$editCrudeSalt->RECEIVE_NO) selected @endif>{{ $chemical->ITEM_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-4 control-label no-padding-right" for="form-field-1-1"><b>Trading Name</b><span style="color: red;">* </span></label>
                    <div class="col-sm-7">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess SUPP_ID_AUTO" class="chosen-select form-control" name="SUPP_ID_AUTO" data-placeholder="Select Trading Name">
                               <option value=""></option>
                                @foreach($crudeSaltSuppliers as $crudeSaltSupplier)
                                    <option value="{{ $crudeSaltSupplier->SUPP_ID_AUTO }}" @if($crudeSaltSupplier->SUPP_ID_AUTO==$editCrudeSalt->SUPP_ID_AUTO) selected @endif>{{ $crudeSaltSupplier->TRADING_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Amount (KG)</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-7">
                        <input autocomplete="off" type="text" id="inputSuccess RCV_QTY" placeholder="Example: Amount here" name="RCV_QTY" class="form-control col-xs-10 col-sm-5" onkeypress="return numbersOnly(this, event)" value="{{ $editCrudeSalt->RCV_QTY }}"/>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Invoice No.</b><span style="color: red;"> * </span> </label>
                    <div class="col-sm-7">
                        <input autocomplete="off" type="text" placeholder="Example: Invoice No here" name="INVOICE_NO" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudeSalt->INVOICE_NO }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-4 control-label no-padding-right" for="form-field-1-1"><b>Source From</b><span style="color: red;"> * </span></label>
                    <div class="col-sm-7">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess SOURCE_ID" class="chosen-select form-control" name="SOURCE_ID" data-placeholder=" -Select- ">
                                @foreach($importedData as $row)
                                    {{--<option value="{{$row->LOOKUPCHD_ID}}">{{$row->LOOKUPCHD_NAME}}</option>--}}
                                    <option value="{{ $row->LOOKUPCHD_ID }}" @if($row->LOOKUPCHD_ID==$editCrudeSalt->SOURCE_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                @endforeach
                                @foreach($crudeSaltSources as $crudeSaltSource)
                                    <option value="{{ $crudeSaltSource->LOOKUPCHD_ID }}" @if($crudeSaltSource->LOOKUPCHD_ID==$editCrudeSalt->SOURCE_ID) selected @endif>{{ $crudeSaltSource->LOOKUPCHD_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-7">
                        <textarea rows="3"  placeholder="Example:- Remarks Here" name="REMARKS" class="form-control col-xs-5 col-sm-5">{{ $editCrudeSalt->REMARKS }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 15px;">
                <h4  style="color: #1B6AAA;">Transport Details</h4>
                <hr>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Driver Name</b><span style="color: red;"></span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess DRIVER_NAME" placeholder="Example:- Driver Name Here" name="DRIVER_NAME" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudeSalt->DRIVER_NAME  }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Vehicle License</b><span style="color: red;"></span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess VEHICLE_LICENSE" placeholder="Example:- Vehicle License Here" name="VEHICLE_LICENSE" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudeSalt->VEHICLE_LICENSE  }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Mobile No.</b><span style="color: red;"></span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess MOBILE_NO" placeholder="Example:- Mobile Number Here" name="MOBILE_NO" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudeSalt->MOBILE_NO  }}"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Driving licence</b><span style="color: red;"></span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess VEHICLE_NO" placeholder="Example:- Driving licence Here" name="VEHICLE_NO" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudeSalt->VEHICLE_NO  }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Transport Fare</b><span style="color: red;"></span> </label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" id="inputSuccess TRANSPORT_NAME" placeholder="Example:- Transport Fare Here" name="TRANSPORT_NAME" class="form-control col-xs-10 col-sm-5" value="{{ $editCrudeSalt->TRANSPORT_NAME  }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-7">
                            <textarea rows="3"  placeholder="Example:- Remarks Here" name="REMARKS_Tansport" class="form-control col-xs-10 col-sm-5" >{{ $editCrudeSalt->REMARKS_Tansport  }}</textarea>
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
                    {{ trans('dashboard.update') }}
                </button>
            </div>
        </div>
    </form>
</div>

@include('masterGlobal.chosenSelect')
@include('masterGlobal.datePicker')





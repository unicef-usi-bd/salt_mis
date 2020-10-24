<div class="col-md-12">
    <form action="{{ url('/chemical-purchase') }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Purchase Date</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" name="RECEIVE_DATE" id="RECEIVE_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 date-picker" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-4 control-label no-padding-right" for="form-field-1-1"><b>Procuring Chemical</b><span style="color: red;"> *</span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess RECEIVE_NO" class="chosen-select form-control" name="RECEIVE_NO" data-placeholder=" -Select-">
                               <option value=""></option>
                                @foreach($chemicleType as $chemical)
                                    <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Amount (KG)</b><span style="color: red;"> * </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" id="inputSuccess RCV_QTY" placeholder="Example:- Amount (KG) Here  " name="RCV_QTY" class="form-control col-xs-10 col-sm-5" onkeypress="return numbersOnly(this, event)" value=""/>
                        <input type="hidden" value="{{ $supplierId }}" name="SUPPLIER_ID">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <textarea rows="3" placeholder="Example:- Remarks Here" name="REMARKS" class="form-control col-xs-5 col-sm-5"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Invoice No.</b><span style="color: red;"> * </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" placeholder="Example:- Invoice No. Here" name="INVOICE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-4 control-label no-padding-right" for="form-field-1-1"><b>Chemical Source</b><span style="color: red;"> * </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select class="chosen-select form-control chemical-source" name="SUPP_ID_AUTO" data-placeholder=" -Select-">
                                <option value="">-Select-</option>
                                <option value="{{$defaultSupplier->SUPP_ID_AUTO}}" @if($defaultSupplier->TRADING_NAME=='BSCIC') selected @endif > {{$defaultSupplier->TRADING_NAME}}</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->SUPP_ID_AUTO}}"> {{$supplier->TRADING_NAME}}</option>
                                @endforeach
                                <option value="1001">Other</option>
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group resources"  style=" display: none;">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Seller Name</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" id="inputSuccess TRADING_NAME" placeholder="Example:- Seller Name Here" name="TRADING_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group resources"  style=" display: none;">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Address</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" id="inputSuccess ADDRESS" placeholder="Example:- Address Here" name="ADDRESS" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group resources"  style=" display: none;">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Mobile No.</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" id="inputSuccess PHONE" placeholder="Example:- Mobile No. Here" name="PHONE" class="form-control col-xs-10 col-sm-5 PHONE" value=""/>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                        @endif
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



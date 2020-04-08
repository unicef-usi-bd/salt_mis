<div class="col-md-12">

    <form action="{{ url('/chemical-purchase/'.$editChemicalpurchase->RECEIVEMST_ID) }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Purchase Date</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" name="RECEIVE_DATE" id="RECEIVE_DATE" readonly value="{{date('m/d/Y',strtotime($editChemicalpurchase->RECEIVE_DATE))}}" class="width-100 date-picker" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Procurement Chemical</b><span style="color: red;"> *</span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess RECEIVE_NO" class="chosen-select form-control" name="RECEIVE_NO" data-placeholder="Select Chemical">
                               <option value=""></option>
                                @foreach($chemicleType as $chemical)
                                    <option value="{{ $chemical->ITEM_NO }}" @if($chemical->ITEM_NO==$editChemicalpurchase->RECEIVE_NO) selected @endif>{{ $chemical->ITEM_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess RCV_QTY" placeholder="Example: Amount here" name="RCV_QTY" class="form-control col-xs-10 col-sm-5" onkeypress="return numbersOnly(this, event)" value="{{ $editChemicalpurchase->RCV_QTY }}"/>
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" >ltr</i>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Invoice No</b><span style="color: red;"> * </span> </label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="Example: Invoice No here" name="INVOICE_NO" class="form-control col-xs-10 col-sm-5" value="{{ $editChemicalpurchase->INVOICE_NO }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Chemical Source</b><span style="color: red;"> *</span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess SUPP_ID_AUTO" class="chosen-select form-control" name="SUPP_ID_AUTO" data-placeholder="Select Chemical Source">
                                <option value="{{$defaultSupplier->SUPP_ID_AUTO}}" @if($defaultSupplier->TRADING_NAME==$editChemicalpurchase->SUPP_ID_AUTO) selected @endif > {{$defaultSupplier->TRADING_NAME}}</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->SUPP_ID_AUTO }}" @if($supplier->SUPP_ID_AUTO==$editChemicalpurchase->SUPP_ID_AUTO) selected @endif>{{ $supplier->TRADING_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <textarea    rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5" >{{ $editChemicalpurchase->REMARKS }}</textarea>
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




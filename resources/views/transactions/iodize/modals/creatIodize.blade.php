<div class="col-md-12">
    <form action="{{ url('/iodized') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Date</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="text" name="BATCH_DATE" id="BATCH_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 date-picker" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Batch Number</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess BATCH_NO" placeholder="Example: Auto Generate" name="BATCH_NO" readonly class="form-control col-xs-10 col-sm-5" value="{{ $batchNo }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount of Salt</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <span class="col-sm-6" style="padding: 0;">
                    <input type="text" id="inputSuccess WASH_CRASH_QTY" placeholder="Example: Amount here" name="WASH_CRASH_QTY" class="form-control col-xs-10 col-sm-5 userAmount" onkeypress="return numbersOnly(this, event)" value=""/>
                </span>
                <span class="col-sm-6 currentStock" data-stock="{{ $totalWashing }}" style="margin-top: 6px;font-weight: bold;">[Current Stock: {{ $totalWashing }}KG]</span>
            </div>
        </div>
        <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Chemical Type</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess" class="form-control chemical  chosen-select" name="PRODUCT_ID" data-placeholder="Select or search data">
                        <option></option>
                        @foreach($chemicleType as $chemical)
                            <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                        @endforeach
                   </select>
                </span>
                </div>
            </div>
        <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1" style="margin-left: -47px;"> <b>Chemical amount</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <span class="col-sm-6" style="padding: 0;">
                    <input type="text" id="inputSuccess REQ_QTY" placeholder="Example: Amount of Chemical here" name="REQ_QTY" class="form-control col-xs-10 col-sm-5 userChemicalAmount" onkeypress="return numbersOnly(this, event)" value=""/>
                </span>
                <span class="col-sm-6 currentChemicalStock" data-stock="" data-recommend="" style="margin-top: 6px;font-weight: bold;"></span>
            </div>
            <div class="recommendInfo" style="margin-left: 27%;float: left;color:#FF8F37;font-weight: bold"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Wastage</b><span style="color: red;"> </span> </label>
            <div class="col-sm-7">
                <input type="text" id="inputSuccess WASTAGE" placeholder="Example: Amount of Wastage here" name="WASTAGE" class="form-control col-xs-10 col-sm-5" onkeypress="return numbersOnly(this, event)" value=""/>
            </div>
            <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <textarea rows="3" cols ="2" placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5"></textarea>
            </div>
        </div>

        <div class="clearfix">
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

//    User Input salt amount handler
    $(document).on('keyup','.userAmount',function () {
        let scope = $('.currentStock');
        iodizeStockDisplay(scope);
        $('.chemical').val('').trigger('chosen:updated');
        clearAlert();
    });

//    User Input Chemical handler
    $(document).on('change','.chemical',function(){
        let washSaltAmount = parseFloat($('.userAmount').val() || 0);
        let chemicalId = $(this).val();
        let recommendScope = $('.recommendInfo');
        let chemicalStockScope = $('.currentChemicalStock');
        recommendScope.empty();
        chemicalStockScope.empty();
        chemicalStockScope.prop('data-stock', '');
        chemicalStockScope.prop('data-recommend', '');
        $.ajax({
            type : 'GET',
            url : 'chemical-stock',
            data : {'chemicalId':chemicalId},
            success: function (data) {
                data = JSON.parse(data);
                let chemicalStock = data.chemicalStock;
                chemicalStockScope.attr('data-stock', chemicalStock);
                if(data.chemicalPerKg!==null) {
                    let chemicalAmount = parseFloat(data.chemicalPerKg.USE_QTY);
                    let saltAmount = parseFloat(data.chemicalPerKg.CRUDE_SALT);
                    let recommendChemical = (chemicalAmount/saltAmount)*washSaltAmount;
                    chemicalStockScope.attr('data-recommend', recommendChemical);
                    $('.userChemicalAmount').val(recommendChemical);
                }
                chemicalStockDisplay(chemicalStockScope);
            }
        })

    });

//    User Input Chemical amount handler
    $(document).on('keyup','.userChemicalAmount',function () {
        let chemicalStockScope = $('.currentChemicalStock');
        chemicalStockDisplay(chemicalStockScope);
    });

</script>





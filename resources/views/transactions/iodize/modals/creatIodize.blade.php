<div class="col-md-12">
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>

    <div class="alert alert-danger alert-dismissible msg" style="display: none;">


    </div>

    <form id="myform" action="{{ url('/iodized') }}" method="post" class="form-horizontal" role="form">
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
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount of Salt</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <span class="col-sm-6" style="padding: 0;">
                    <input type="text" id="inputSuccess WASH_CRASH_QTY" placeholder="Example: Amount here" name="WASH_CRASH_QTY" class="form-control col-xs-10 col-sm-5 saltAmount" value=""/>
                </span>
                <span class="col-sm-6" style="margin-top: 6px;font-weight: bold;">(Stock have: <span class="stockSalt">{{ $totalWashing }} KG</span><span class="result"></span>)</span>
            </div>
        </div>
        <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Chemical Type</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess PRODUCT_ID" class="form-control chemical" name="PRODUCT_ID" data-placeholder="Select or search data">
                        <option value=""></option>
                        @foreach($chemicleType as $chemical)
                            <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                        @endforeach
                   </select>
                </span>
                </div>
            </div>
        <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1" style="margin-left: -47px;"> <b>Amount of Chemical</b><span style="color: red;"> *</span> </label>

            <div class="col-sm-8">
                    <span class="col-sm-6" style="padding: 0;">
                        <input type="text" id="inputSuccess REQ_QTY" placeholder="Example: Amount of Chemical here" name="REQ_QTY" class="form-control col-xs-10 col-sm-5 chemicalAmount" value=""/>
                    </span>
                <span class="col-sm-6" style="margin-top: 6px;font-weight: bold;">(Stock have: <span class="stockChemical hidden"></span><span class="resultChemical"></span> ltr)</span>

            </div>
            <span class="requireChemicalPerKg" style="margin-left:27%;display: none;color:#1cabe2;"></span>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Wastage</b><span style="color: red;"> </span> </label>
            <div class="col-sm-7">
                <input type="text" id="inputSuccess WASTAGE" placeholder="Example: Amount of Wastage here" name="WASTAGE" class="form-control col-xs-10 col-sm-5" value=""/>

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

{{--@include('masterGlobal.formValidation')--}}
<script>
    //$('.chemicalAmount').attr('readonly', true);
    $(document).on('change','.chemical',function(){
        var washSaltAmount = $('.saltAmount').val();
        var chemicalId = $(this).val();
        if(washSaltAmount === ''){
            $('.msg').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning !</strong> Please Set Washing Salt Amount!').fadeIn();
        }

        $.ajax({
            type : 'GET',
            url : 'chemical-stock',
            data : {'chemicalId':chemicalId},
            success: function (data) {
               // alert(data)
                var data = JSON.parse(data);
                var recommandedQty = (data.chemicalPerKg.USE_QTY / data.chemicalPerKg.CRUDE_SALT) * washSaltAmount;
                //console.log(data.chemicalPerKg.USE_QTY * washSaltAmount);
                $('.chemicalAmount').val(recommandedQty.toFixed(2));
                $('.requireChemicalPerKg').text('Recommended Chemical for ( '+data.chemicalPerKg.ITEM_NAME+' ) is ' + recommandedQty.toFixed(2)).show();
                $('.stockChemical').html(data.chemicalStock).show();
                $('.resultChemical').html(data.chemicalStock.toFixed(2));
                var chemicalNeed = (parseInt(data.chemicalPerKg.USE_QTY) * parseInt(washSaltAmount)) / parseInt(data.chemicalPerKg.CRUDE_SALT);

              //  alert(chemicalNeed);

                if(parseInt(data.chemicalStock) > chemicalNeed){
                  //  alert("hi");
                    $('.chemicalAmount').attr('readonly', false);
                }else{
                    //alert("hlw");
                    $('.chemicalAmount').attr('readonly', true);
                    $('.msg').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning !</strong>You Have Not enough Chemical Stock.').fadeIn();
                    $('.saltAmount').val("");
                }

                $(document).on('keyup','.chemicalAmount',function () {
                    var amount = parseInt($(this).val()) || 0;
                    var chemicalStock = parseInt($('.stockChemical').text());
                    var remainStock = chemicalStock - amount;

                    if(chemicalStock < amount){
                        $('.stockChemical').hide();
                        $('.msg').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning !</strong>Chemical Stock Out Of bound.').fadeIn();
                        $('.resultChemical').text(0);
                        if(amount === 0){
                            $('.stockChemical').show();
                        }
                    }else{
                        $('.stockChemical').hide();
                        $('.resultChemical').text(remainStock);
                    }
                });
            }
        })

    });

    $(document).on('keyup','.saltAmount',function () {
        var amount = parseInt($(this).val()) || 0;
        var saltStock = parseInt($('.stockSalt').text());
        var remainStock = saltStock - amount;

        if(saltStock < amount){
            $('.stockSalt').hide();
            $('.msg').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning !</strong>Washing Salt Stock Out Of bound.').fadeIn();
            $('.result').text(0);
            if(amount === 0){
                $('.stockSalt').show();
            }
        }else{
            $('.stockSalt').hide();
            $('.result').text(remainStock);
        }
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
                PRODUCT_ID:{
                    required: true,
                },
                REQ_QTY:{
                    required: true,
                },
            }
        });

    });
</script>



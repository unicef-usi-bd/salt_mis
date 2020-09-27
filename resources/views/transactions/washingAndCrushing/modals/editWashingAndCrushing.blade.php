<style>
    .percentageSize {
        font-size: 22px;
    }
</style>
<div class="col-md-12">

    <form action="{{ url('/washing-crushing/'.$editData->WASHCRASHMST_ID) }}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Batch No.</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess" readonly placeholder="Example:- Batch No. here" name="BATCH_NO" class="form-control col-xs-10 col-sm-5" value="{{ $editData->BATCH_NO }}"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Date</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" name="BATCH_DATE" readonly value="{{ date("d-m-Y", strtotime($editData->BATCH_DATE)) }}" class="width-100 date-picker" />
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Crude Salt Type</b><span style="color: red;"> </span></label>
            <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess PRODUCT_ID" class="chosen-select form-control saltType" name="PRODUCT_ID" data-placeholder=" -Select-">
                       <option value=""></option>
                        @foreach($crudeSaltTypes as $chemical)
                            <option value="{{$chemical->ITEM_NO}}" @if($chemical->ITEM_NO == $editData->ITEM_NO) selected @endif> {{$chemical->ITEM_NAME}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount (KG)</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <span class="col-sm-6" style="padding: 0;">
                     <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- Amount Here" name="REQ_QTY" class="form-control col-xs-10 col-sm-5 userAmount" onkeypress="return numbersOnly(this, event)" value="{{ ($editData->REQ_QTY*100)/(100-$editData->WASTAGE)  }}"/>
                </span>
                <span class="col-sm-6 currentStock" data-stock="{{ $totalStock }}" style="margin-top: 6px;font-weight: bold;">[Current Stock: {{ $totalStock }}KG]</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Wastage</b><span style="color: red;"> </span> </label>
            <span class="col-sm-7">
                <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- Wastage Amount Here" name="WASTAGE" class="form-control col-xs-10 col-sm-5 wastageAmount" onkeypress="return numbersOnly(this, event)" value="{{ $editData->WASTAGE }}"/>
            </span>
            <span class="col-sm-1">
                <span class="group-addon percentageSize">
                    <i class="ace-icon fa fa-percent"></i>
                </span>
            </span>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <textarea rows="3"  placeholder="Example:- Remarks Here" name="REMARKS" class="form-control col-xs-5 col-sm-5"> {{ $editData->REMARKS }}</textarea>
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
<script>
    $(document).on('change','.saltType',function(){
        let scope = $('.currentStock');
        $('.userAmount').val('');
        $('.wastageAmount').val('');
        scope.attr('data-stock', '');

        //$('.stockSalt').empty()
        let saltId = $(this).val();
        $.ajax({
            type : 'GET',
            url : 'crude-salt-stock',
            data : {'saltId':saltId},
            success: function (data) {
                data = JSON.parse(data);
                scope.attr('data-stock', data.saltStock);
                currentStockDisplay(scope);
            }
        })
    });

    $(document).on('keyup','.userAmount',function () {
        let scope = $('.currentStock');
        currentStockDisplay(scope);
    });
</script>






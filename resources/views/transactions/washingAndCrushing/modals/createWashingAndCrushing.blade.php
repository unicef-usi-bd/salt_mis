<style>
    .percentageSize {
        font-size: 22px;
    }
</style>
<div class="col-md-12">
    <form action="{{ url('/washing-crushing') }}" method="post" class="form-horizontal" role="form">

        @csrf

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Batch No</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess" readonly placeholder="Example: Batch here" name="BATCH_NO" class="form-control col-xs-10 col-sm-5" value="{{ $batch }}"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Purchase Date</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input type="text" name="BATCH_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 date-picker" />
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Crude Salt Type</b><span style="color: red;"> </span></label>
            <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess" class="chosen-select form-control" name="ITEM_ID" data-placeholder="Select or search data">
                       <option value=""></option>
                        @foreach($crudeSaltTypes as $chemical)
                            <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <span class="col-sm-8" style="padding: 0;">
                     <input type="text" id="inputSuccess QTY" placeholder="Example: Amount here" name="REQ_QTY" class="form-control col-xs-10 col-sm-5" value=""/>
                </span>

                <span class="col-sm-4" style="margin-top: 6px;">(Stock have: )</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Wastage</b><span style="color: red;"> </span> </label>
            <span class="col-sm-7">
                <input type="text" id="inputSuccess" placeholder="Example: Wastage Amount here" name="WASTAGE" class="form-control col-xs-10 col-sm-5" value=""/>
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
                <textarea rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5"></textarea>
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





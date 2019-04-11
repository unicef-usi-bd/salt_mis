<div class="col-md-12">
    {{--<div id="success" class="alert alert-block alert-success" style="display: none;">--}}
    {{--<span id="successMessage"></span>--}}
    {{--<button type="button" class="close" data-dismiss="alert">--}}
    {{--<i class="ace-icon fa fa-times"></i>--}}
    {{--</button>--}}
    {{--</div>--}}

    {{--<div id="error" class="alert alert-block alert-danger" style="display: none;">--}}
    {{--<span id="errorMessage"></span>--}}
    {{--</div>--}}

    {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
    <form action="{{ url('/iodized/'.$editIodize->IODIZEDMST_ID) }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf
            @method('PUT')
            {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Batch Number</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess BATCH_NO" placeholder="Example: Auto Generate" name="BATCH_NO" class="form-control col-xs-10 col-sm-5" value="{{ $editIodize->BATCH_NO }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount of Salt</b><span style="color: red;"> </span> </label>

                    <span class="block input-icon input-icon-right">
                          <div class="col-sm-4">
                        <input type="text" id="inputSuccess WASH_CRASH_QTY" placeholder="Example: Amount here" name="WASH_CRASH_QTY" class="form-control col-xs-10 col-sm-5 saltAmount" value="{{ $editIodize->WASH_CRASH_QTY }}"/>
                        </div>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Date</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" name="BATCH_DATE" id="BATCH_DATE" readonly value="{{date('m/d/Y',strtotime($editIodize->BATCH_DATE))}}" class="width-100 date-picker" />
                    </div>
                </div>
                <div class="form-group" style="margin-left: -200px; margin-top: 40px;">
                    {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Stock :</b><span>  {{ $totalSalt }}  </span></label>--}}
                    <span class="col-sm-6"><span class="stockSalt"> ( Stock have :<strong>{{ $totalSalt }}</strong>  Kg )</span> </span>
                </div>


            </div>


        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Chemical Type</b><span style="color: red;"></span></label>
                <div class="col-sm-8">
                <span class="block input-icon input-icon-right">
                    <select id="form-field-select-3 inputSuccess PRODUCT_ID" class="chosen-select form-control" name="PRODUCT_ID" data-placeholder="Select or search data">
                        <option value=""></option>
                        @foreach($chemicleType as $chemical)
                            <option value="{{ $chemical->ITEM_NO }}" @if($chemical->ITEM_NO==$editIodize->PRODUCT_ID) selected @endif>{{ $chemical->ITEM_NAME }}</option>
                        @endforeach
                   </select>
                </span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount</b><span style="color: red;"> </span> </label>

                <span class="block input-icon input-icon-right">
                          <div class="col-sm-4">
                        <input type="text" id="inputSuccess REQ_QTY" placeholder="Example: Amount here" name="REQ_QTY" class="form-control col-xs-10 col-sm-5 saltAmount" value="{{ $editIodize->REQ_QTY }}"/>
                        </div>
                    </span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Wastage</b><span style="color: red;"> </span> </label>
                <div class="col-sm-7">
                    <input type="text" id="inputSuccess WASTAGE" placeholder="Example: Auto Generate" name="WASTAGE" class="form-control col-xs-10 col-sm-5" value="{{ $editIodize->WASTAGE }}"/>
                </div>
                <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
            </div>

            <div class="form-group" style="margin-left: -200px; margin-top: 25px;">
                {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Stock :</b><span>  {{ $totalSalt }}  </span></label>--}}
                <span class="col-sm-6" >Stock<span class="stockSalt"> ( Stock have :<strong>{{ $totalChemical }}</strong>  Kg )</span> </span>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group" style="margin-left: -160px;">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                <div class="col-sm-9">
                    <textarea style="width:95.5%;"   rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5" >{{ $editIodize->REMARKS }}</textarea>
                </div>
            </div>
        </div>


    <!-- <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('union.active_status') }}</b></label>
                <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="active_status">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
                </div>
            </div> -->

        <div class="clearfix" style="margin-left: 150px;">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn test">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'unions' }}">--}}
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
    //    $(document).on('keyup','.saltAmount',function () {
    //        alert('hi');
    ////        var  REQ_QTY = $(this).val();
    ////        var stockSalt = $(this).text();
    //
    //
    //    });
</script>



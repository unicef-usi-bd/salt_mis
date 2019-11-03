<div id="qc_tab" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info qcmsg"></div>

            {{--<form action="{{ url('/qc-info') }}" method="post" class="form-horizontal" role="form">--}}
            <form id="qcInfoId"  class="form-horizontal" role="form" >
                @csrf
                @if(isset($millerInfoId))
                    <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Have a laboratory ?</b><span style="color:red;"> *</span></label>
                        <div class="col-sm-7">
                            <label>
                                <input name="LABORATORY_FLG" type="radio" class="ace merit required"  value="1" @if ($editQcData->LABORATORY_FLG==1) checked @endif/>
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                {{--<input name="LABORATORY_FLG" type="radio" class="ace merit"  value="0" @if ($editQcData->LABORATORY_FLG==0) checked @endif/>--}}
                                <input name="LABORATORY_FLG" type="radio" class="ace merit required"  value="0" @if(isset($editQcData->LABORATORY_FLG))@if($editQcData->LABORATORY_FLG==0) checked @endif @endif/>
                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>If Iodine content check during production</b> <span style="color:red;"> *</span></label>
                        <div class="col-sm-7">
                            <label>
                                <input name="IODINE_CHECK_FLG" type="radio" class="ace merit required"   value="1" @if ($editQcData->IODINE_CHECK_FLG==1) checked @endif/>
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input name="IODINE_CHECK_FLG" type="radio" class="ace merit required"  value="0"  @if ($editQcData->IODINE_CHECK_FLG==0) checked @endif/>
                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Do you have a laboratory Man ?</b><span style="color:red;"> *</span> </label>
                        <div class="col-sm-7">
                            <label>
                                <input name="LAB_MAN_FLG" type="radio" class="ace merit"  value="1" @if ($editQcData->LAB_MAN_FLG==1) checked @endif/>
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input name="LAB_MAN_FLG" type="radio" class="ace merit"  value="0" @if ($editQcData->LAB_MAN_FLG==0) checked @endif/>
                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Monitoring Test Kit</b> <span style="color:red;"> *</span></label>
                        <div class="col-sm-7">
                            <label>
                                <input name="MONITORING_FLG" type="radio" class="ace merit"  value="1" @if ($editQcData->MONITORING_FLG==1) checked @endif/>

                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input name="MONITORING_FLG" type="radio" class="ace merit"  value="0" @if ($editQcData->MONITORING_FLG==0) checked @endif/>

                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>


                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>Standard Operation Procedure (SOP)</b></label>
                        <div class="col-sm-7">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="SOP_DESC" class="chosen-container" value="{{ $editQcData->SOP_DESC }}">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>Number Of Laboratory Man</b></label>
                        <div class="col-sm-7">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="LAB_PERSON" class="chosen-container" value="{{ $editQcData->LAB_PERSON }}">

                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>Remarks</b></label>
                        <div class="col-sm-7">
                            <span class="block input-icon input-icon-right">
                               {{--<input type="text" name="REMARKS" class="chosen-container" value="{{ $editQcData->REMARKS }}">--}}
                                <textarea name="REMARKS" id="" cols="44" rows="2">{{ $editQcData->REMARKS }}</textarea>
                            </span>
                        </div>
                    </div>

                </div>



                <hr>

                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 35%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        @if(isset($associationId))
                            {{--<button type="button" class="btn btn-success btnUpdateApprove" onclick="qcTab()">--}}
                                {{--<i class="ace-icon fa fa-check bigger-110"></i>--}}
                                {{--Approve--}}
                            {{--</button>--}}
                            <button type="button" class="btn btn-success btnUpdateQc" onclick="qcTab()">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Update & Next
                            </button>
                        @else
                            @if($editMillData->approval_status == 0)
                                <button type="button" class="btn btn-success btnUpdateQcTem" onclick="qcTab()">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Update & Next
                                </button>
                            @else
                                <span style="color: red;font-size: 18px;margin-left: 5px;">Waiting for Association update your previous request</span>
                            @endif
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).on('click','.btnUpdateQcTem',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-qc-tem',
            data : $('#qcInfoId').serialize(),
            success: function (data) {
                console.log(data);
                $('.empmsg').html('<span>'+ data +'</span>').show();
                setTimeout(function() { $(".empmsg").hide(); }, 3000);

            }
        })
    });

    $('.qcmsg').hide();
    $(document).on('click','.btnUpdateQc',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-qc-info',
            data : $('#qcInfoId').serialize(),
            success: function (data) {
                console.log(data);
                // $('.qcmsg').html('<span>'+ data +'</span>').show();
                $('.qcmsg').html('<span>'+ data +'</span>').show();
                setTimeout(function() { $(".qcmsg").hide(); }, 3000);

            }
        })
    });

    $('.millmsg').hide();
    $(document).on('click','.btnUpdateApprove',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-mill-info-approve',
            data : $('#millId').serialize(),
            success: function (data) {
                console.log(data);
                $('.millmsg').html('<span>'+ data +'</span>').show();
                setTimeout(function() { $(".millmsg").hide(); }, 3000);

            }
        })
    });

</script>
<div id="qc" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/qc-info/'.$millerInfo->MILL_ID) }}" data-clear="false" method="post" class="form-horizontal" role="form">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-7 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Have a Laboratory ?</b> </label>
                        <div class="col-sm-4">
                            <label>
                                <input autocomplete="off" name="LABORATORY_FLG" type="radio" class="ace merit"  value="1"  @if(!empty($qcInfo) && $qcInfo->LABORATORY_FLG==1) checked @endif />
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input autocomplete="off" name="LABORATORY_FLG" type="radio" class="ace merit"  value="0" @if(!empty($qcInfo) && $qcInfo->LABORATORY_FLG==0) checked @endif />
                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-8 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Do You Follow Standard Operating Procedure ?</b> </label>
                        <div class="col-sm-4">
                            <label>
                                <input autocomplete="off" name="OPERATION_PROCEDURE_FLG" type="radio" class="ace merit"  value="1" @if(!empty($qcInfo) && $qcInfo->OPERATION_PROCEDURE_FLG==1) checked @endif />
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input autocomplete="off" name="OPERATION_PROCEDURE_FLG" type="radio" class="ace merit"  value="0" @if(!empty($qcInfo) && $qcInfo->OPERATION_PROCEDURE_FLG==0) checked @endif />
                                <span class="lbl">No</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-7 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Do You Have Trained Laboratory Person ?</b> </label>
                        <div class="col-sm-5">
                            <label>
                                <input autocomplete="off" name="LAB_MAN_FLG" type="radio" class="ace merit"  value="1"  @if(!empty($qcInfo) && $qcInfo->LAB_MAN_FLG==1) checked @endif />
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input autocomplete="off" name="LAB_MAN_FLG" type="radio" class="ace merit"  value="0" @if(!empty($qcInfo) && $qcInfo->LAB_MAN_FLG==0) checked @endif/>
                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-7 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Does Laboratory Use Test Kit ?</b> </label>
                        <div class="col-sm-5">
                            <label>
                                <input autocomplete="off" name="MONITORING_FLG" type="radio" class="ace merit"  value="1" @if(!empty($qcInfo) && $qcInfo->MONITORING_FLG==1) checked @endif/>
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input autocomplete="off" name="MONITORING_FLG" type="radio" class="ace merit"  value="0" @if(!empty($qcInfo) && $qcInfo->MONITORING_FLG==0) checked @endif/>
                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>Number Of Laboratory Person</b></label>
                        <div class="col-sm-7">
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="LAB_PERSON" class="chosen-container" onkeypress="return numbersOnly(this, event)" value="@if(!empty($qcInfo)){{ $qcInfo->LAB_PERSON }}@endif">
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>Remarks</b></label>
                        <div class="col-sm-7">
                            <span class="block input-icon input-icon-right">
                                <textarea rows="3" class="form-control col-sm-7" name="REMARKS"> @if(!empty($qcInfo)){{ $qcInfo->REMARKS }}@endif</textarea>
                            </span>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="clearfix">
                    <div class="col-md-12 center">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary" onclick="formSubmitGeneral(this.form)">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{--{{ trans('dashboard.submit') }}--}}
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="qc" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">

            <form action="{{ url('/qc-info') }}" method="post" class="form-horizontal" role="form">
                @csrf
                @if(isset($createMillerInfo))
                    <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Have a laboratory ?</b> </label>
                        <div class="col-sm-7">
                            <label>
                                <input name="LABORATORY_FLG" type="radio" class="ace merit"  value="1"/>
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input name="LABORATORY_FLG" type="radio" class="ace merit"  value="0"/>
                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>If Iodine content check during production</b> </label>
                        <div class="col-sm-7">
                            <label>
                                <input name="IODINE_CHECK_FLG" type="radio" class="ace merit"  value="1"/>
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input name="IODINE_CHECK_FLG" type="radio" class="ace merit"  value="0"/>
                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Do you have a laboratory Man ?</b> </label>
                        <div class="col-sm-7">
                            <label>
                                <input name="LAB_MAN_FLG" type="radio" class="ace merit"  value="1"/>
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input name="LAB_MAN_FLG" type="radio" class="ace merit"  value="0"/>
                                <span class="lbl"> No</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1" style="margin-top: -8px;"> <b>Monitoring Test Kit</b> </label>
                        <div class="col-sm-7">
                            <label>
                                <input name="MONITORING_FLG" type="radio" class="ace merit"  value="1"/>
                                <span class="lbl"> Yes</span>
                            </label>
                            <label>
                                <input name="MONITORING_FLG" type="radio" class="ace merit"  value="0"/>
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
                               <input type="text" name="SOP_DESC" class="chosen-container">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>Number Of Laboratory Man</b></label>
                        <div class="col-sm-7">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="LAB_PERSON" class="chosen-container">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>Remarks</b></label>
                        <div class="col-sm-7">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="REMARKS" class="chosen-container">
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
                        <button type="submit" class="btn btn-primary">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{ trans('dashboard.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
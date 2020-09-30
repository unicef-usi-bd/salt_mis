<div class="col-md-12">
    <form  action="{{ url('/quality-control-testing') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-md-12"> <b>Date</b><span style="color: red;"> </span> </label>
                        <div class="col-md-12">
                            <input autocomplete="off" type="text" name="QC_DATE" id="QC_DATE" readonly value="{{date('m/d/Y')}}" class="date-picker" />
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-12"><b>Quality Control By</b><span style="color: red;"> * </span></label>
                    <div class="col-md-12">
                        <span class="block input-icon input-icon-right">
                            <select id="QC_BY"  class="chosen-select form-control" name="QC_BY" data-placeholder=" -Select-">
                               <option value=""></option>
                                @foreach($qulityControlId as $name)
                                    <option value="{{$name->LOOKUPCHD_ID}}"> {{$name->LOOKUPCHD_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-12"><b>Agency</b><span style="color: red;"> * </span></label>
                    <div class="col-md-12">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess AGENCY_ID" class="chosen-select form-control" name="AGENCY_ID" data-placeholder=" -Select-">
                               <option value=""></option>
                                @foreach($agencyId as $agency)
                                    <option value="{{$agency->LOOKUPCHD_ID}}"> {{$agency->LOOKUPCHD_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-12"> <b>Batch No.</b><span style="color: red;"> * </span> </label>
                    <div class="col-md-12">
                        <span class="block input-icon input-icon-right">
                            <select id="BATCH_NO"  class="chosen-select form-control" name="BATCH_NO" data-placeholder=" -Select-">
                               <option value=""></option>
                                {{--@foreach($iodizeBatch as $iodize)--}}
                                    {{--<option value="{{$iodize->IODIZEDMST_ID}}"> {{$iodize->BATCH_NO}}</option>--}}
                                {{--@endforeach--}}
                                @foreach($iodizeBatchIdByMonth as $iodizebatch)
                                    <option value="{{$iodizebatch->IODIZEDMST_ID}}"> {{$iodizebatch->BATCH_NO}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="col-md-4">
                    <label class="col-md-12"><b>Test Name</b><span style="color: red;"> * </span></label>
                    <div class="col-md-12">
                        <input autocomplete="off" type="text" name="QC_TESTNAME" id="QC_TESTNAME" placeholder="Example:- Test Name Here"  value="" class="form-control col-xs-5 col-sm-5" />
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="col-md-12"> <b>Attachment</b><span style="color: red;"> *</span> </label>
                    <div class="col-md-12">
                        <input type="file" id="QUALITY_CONTROL_IMAGE" name="QUALITY_CONTROL_IMAGE" value="" class="form-control col-xs-5 col-sm-5">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <label class="col-md-12"> <b>Remarks</b><span style="color: red;"> </span> </label>
                    <div class="form-group">

                        <div class="col-md-12">
                            <textarea rows="3" placeholder="Example:- Remarks Here" name="REMARKS" class="form-control col-xs-5 col-sm-5"></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12" style="margin-top: 15px; margin-left: 100px;">
            <h4  style="color: #1B6AAA; margin-left: 450px;">Test Result</h4>
            <div class="col-md-6">
                <h4 style="margin-left: 280px;">BSTI Standard</h4>
            </div>
            <div class="col-md-6">
                <h4 style="margin-left: 50px;">Batch Wise Result</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Chloride Content (as NaCl),%m/m</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->SODIUM_CHLORIDE }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Moisture, %m/m</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->MOISTURIZER }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Iodine Content, mg/kg</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->PPM }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>pH Value</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->PH }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Water Insoluble Mater, %m/m</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->water_insoluble_matter }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Matter Soluble In Water Other Than Sodium Chloride, %m/m</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-5">
                        <input autocomplete="off" type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->matter_soluble_sc }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="col-sm-6">
                        <input autocomplete="off" type="text" name="SODIUM_CHLORIDE" id="SODIUM_CHLORIDE" placeholder="" onkeypress="return numbersOnly(this, event)"  value="" class="form-control col-xs-5 col-sm-5"  />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input autocomplete="off" type="text" name="MOISTURIZER" id="MOISTURIZER" placeholder="" onkeypress="return numbersOnly(this, event)"  value="" class="form-control col-xs-5 col-sm-5" />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input autocomplete="off" type="text" name="IODINE_CONTENT" id="IODINE_CONTENT" placeholder="" onkeypress="return numbersOnly(this, event)"  value="" class="form-control col-xs-5 col-sm-5" />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input autocomplete="off" type="text" name="PH" id="PH" placeholder=""  value="" onkeypress="return numbersOnly(this, event)" class="form-control col-xs-5 col-sm-5"  />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input autocomplete="off" type="text" name="water_insoluble_matter" id="water_insoluble_matter" placeholder=""  value="" onkeypress="return numbersOnly(this, event)" class="form-control col-xs-5 col-sm-5"  />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input autocomplete="off" type="text" name="matter_soluble_sc" id="matter_soluble_sc" placeholder=""  value="" onkeypress="return numbersOnly(this, event)" class="form-control col-xs-5 col-sm-5"  />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
            </div>
        </div>


        <div class="clearfix" >
            <div class="col-md-offset-3 col-md-9" style="margin-left: 510px;">
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



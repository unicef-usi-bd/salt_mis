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
    <form action="{{ url('/quality-control-testing') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        {{--<div class="col-md-12">--}}
            @csrf
            {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Purchase Date</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" name="QC_DATE" id="QC_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 date-picker" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Agency</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess AGENCY_ID" class="chosen-select form-control" name="AGENCY_ID" data-placeholder="Select or search data">
                               <option value=""></option>
                                @foreach($agencyId as $agency)
                                    <option value="{{$agency->LOOKUPCHD_ID}}"> {{$agency->LOOKUPCHD_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Attached Test Document</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <input type="text" name="QC_TESTNAME" id="QC_TESTNAME" placeholder=""  value="" class="form-control col-xs-5 col-sm-5" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Quality Control BY</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="QC_BY"  class="chosen-select form-control" name="QC_BY" data-placeholder="Select or search data">
                               <option value=""></option>
                                @foreach($qulityControlId as $name)
                                    <option value="{{$name->LOOKUPCHD_ID}}"> {{$name->LOOKUPCHD_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Batch No</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="BATCH_NO"  class="chosen-select form-control" name="BATCH_NO" data-placeholder="Select or search data">
                               <option value=""></option>
                                @foreach($iodizeBatch as $iodize)
                                <option value="{{$iodize->IODIZEDMST_ID}}"> {{$iodize->BATCH_NO}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Attachment</b><span style="color: red;"> </span> </label>
                    <div class="col-md-8">
                        <input type="file" name="QUALITY_CONTROL_IMAGE" value="" class="form-control col-xs-5 col-sm-5">
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <textarea   rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5" /></textarea>
                    </div>
                </div>
            </div>
        {{--</div>--}}

        <div class="col-md-12" style="margin-top: 15px; margin-left: 100px;">
            <h4  style="color: #1B6AAA; margin-left: 450px;">Test Result</h4>
            <div class="col-md-6">
                <h4 style="margin-left: 150px;">BSTI Standard</h4>
            </div>
            <div class="col-md-6">
                <h4>Batch Wise Result</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Sodium Chloride</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-6">
                        <input type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->SODIUM_CHLORIDE }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Moisturizer</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-6">
                        <input type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->MOISTURIZER }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Iodine content(PPM),</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-6">
                        <input type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->PPM }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>PH</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-6">
                        <input type="text" name="" id="" placeholder=""  value="{{ $bstiChemicalData->PH }}" class="form-control col-xs-5 col-sm-5" readonly />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" name="SODIUM_CHLORIDE" id="SODIUM_CHLORIDE" placeholder=""  value="" class="form-control col-xs-5 col-sm-5"  />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" name="MOISTURIZER" id="MOISTURIZER" placeholder=""  value="" class="form-control col-xs-5 col-sm-5" />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" name="IODINE_CONTENT" id="IODINE_CONTENT" placeholder=""  value="" class="form-control col-xs-5 col-sm-5" />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" name="PH" id="PH" placeholder=""  value="" class="form-control col-xs-5 col-sm-5"  />
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="fa fa-percent"></i>
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


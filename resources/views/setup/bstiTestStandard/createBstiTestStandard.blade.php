
@extends('master')

@section('mainContent')
    <style>
        h4{
            text-align: center;
          }
        .resultRangeStyle{
            margin-bottom: 70px;
        }
    </style>
    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                BSTI Test Standard
            </small>
        </h1>
    </div><!-- /.p -->

    <div class="col-md-12" style="margin-top: 30px;">
        <form action="{{ url('/bsti-test-standard') }}" method="post" class="form-horizontal" role="form" id="myform">
            @csrf
            <div class="form-group">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Chloride Content ( as NaCI, %m/m )</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-3">
                    <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- Sodium Chloride Percentage here" name="SODIUM_CHLORIDE" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->SODIUM_CHLORIDE }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Iodine Content, mg/kg</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-3">
                    <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- Iodine Content(PPM) here" name="PPM" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->PPM }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Moisture, %m/m</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-3">
                    <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- Moisturizer Percentage here" name="MOISTURIZER" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->MOISTURIZER }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>pH Value</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-3">
                    <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- PH here" name="PH" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->PH }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Water Insoluble Matter, %m/m</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-3">
                    <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- PH here" name="water_insoluble_matter" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->water_insoluble_matter }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Matter Soluble In Water Other Than Sodium Chloride, %m/m</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-3">
                    <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- PH here" name="matter_soluble_sc" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->matter_soluble_sc }}@endif"/>
                </div>
            </div>
            <div class="clearfix" style="margin-left: 120px;">
                <div class="col-md-offset-3 col-md-9">
                    @if($editBstiTestStandard)
                        @php
                            $editPermissionLevel = $previllage->UPDATE;
                        @endphp
                        @if($editPermissionLevel == 1)
                            <a class="green showModalGlobal btn btn-warning" id="{{ 'bsti-test-standard/'.$editBstiTestStandard->BSTITEST_ID.'/edit' }}" data-target=".modal" role="button" data-toggle="modal" modal-size="modal-lg" data-permission="{{ $editPermissionLevel }}" title="Edit BSTI Test Standard">
                                <i class="ace-icon fa fa-pencil bigger-130"></i> <span>Edit</span>
                            </a>
                        @endif
                        <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)" disabled="disabled">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Save
                        </button>
                    @else
                        <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Save
                        </button>
                    @endif
                </div>
            </div>
        </form>

            <div class="col-md-12" style="margin-top: 20px;">
                <hr>
                <h4  style="color: #1B6AAA; text-align: center; ">BSTI Test Standard Result Range</h4>
                <hr>
                <form action="{{ url('/bsti-test-result-range') }}" method="post" class="form-horizontal" role="form">
                    @csrf
                    <div class="resultRangeStyle">
                    <h4><u>Chloride Content ( as NaCI, %m/m )</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-6 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Limit</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess SODIUM_CHLORIDE_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="SODIUM_CHLORIDE_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->SODIUM_CHLORIDE_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Limit</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess SODIUM_CHLORIDE_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="SODIUM_CHLORIDE_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->SODIUM_CHLORIDE_MAX }}@endif"/>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="resultRangeStyle">
                    <h4><u>Iodine Content, mg/kg</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-6 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Limit</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess PPM_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="PPM_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->PPM_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Limit</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess PPM_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="PPM_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->PPM_MAX }}@endif"/>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="resultRangeStyle">
                        <h4><u>Moisture, %m/m</u></h4>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-6 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Limit</b><span style="color: red;"> *</span> </label>
                                <div class="col-sm-5">
                                    <input autocomplete="off" type="text" id="inputSuccess MOISTURIZER_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="MOISTURIZER_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->MOISTURIZER_MIN }}@endif"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Limit</b><span style="color: red;"> *</span> </label>
                                <div class="col-sm-5">
                                    <input autocomplete="off" type="text" id="inputSuccess MOISTURIZER_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="MOISTURIZER_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->MOISTURIZER_MAX }}@endif"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resultRangeStyle">
                    <h4><u>pH Value</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-6 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Limit</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess PH_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="PH_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->PH_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Limit</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess PH_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="PH_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->PH_MAX }}@endif"/>
                                {{--<input autocomplete="off" type="text" value="{{ $editBstiTestStandardResultRange->BSTITEST_RESULT_ID }}">--}}
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="resultRangeStyle">
                    <h4><u>Water Insoluble Matter, %m/m</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-6 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess WIM_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="WIM_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->WIM_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Limit</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess WIM_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="WIM_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->WIM_MAX }}@endif"/>
                                {{--<input autocomplete="off" type="text" value="{{ $editBstiTestStandardResultRange->BSTITEST_RESULT_ID }}">--}}
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="resultRangeStyle">
                    <h4><u>Matter Soluble In Water Other Than Sodium Chloride, %m/m</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-6 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Limit</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess MSWSC_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="MSWSC_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->MSWSC_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Limit</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" id="inputSuccess MSWSC_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="MSWSC_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->MSWSC_MAX }}@endif"/>
                                {{--<input autocomplete="off" type="text" value="{{ $editBstiTestStandardResultRange->BSTITEST_RESULT_ID }}">--}}
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="clearfix" style="margin-left: 120px;">
                        <div class="col-md-offset-3 col-md-9">
                            @if($editBstiTestStandardResultRange)
                                @php
                                    $editPermissionLevel = $previllage->UPDATE;
                                @endphp
                                @if($editPermissionLevel == 1)
                                    <a class="green showModalGlobal btn btn-warning" id="{{ 'bsti-test-result-range/'.$editBstiTestStandardResultRange->BSTITEST_RESULT_ID.'/edit' }}" data-target=".modal" modal-size="modal-lg" role="button" data-toggle="modal" data-permission="{{ $editPermissionLevel }}" title="Edit BSTI Test Standard Range">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i> <span>Edit</span>
                                    </a>
                                @endif
                                <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)" disabled="disabled">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Save
                                </button>
                            @else
                                <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Save
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

    </div>

    <!--Sweet Alert Global Script Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.ajaxFormSubmit')
    <!-- Sweet Alert Global Script End -->

@endsection

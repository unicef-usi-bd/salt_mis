@extends('master')

@section('mainContent')
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
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Sodium Chloride</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-6">
                    <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- Sodium Chloride Percentage here" name="SODIUM_CHLORIDE" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->SODIUM_CHLORIDE }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Iodine Content(PPM)</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-6">
                    <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- Iodine Content(PPM) here" name="PPM" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->PPM }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Moisturizer</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-6">
                    <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- Moisturizer Percentage here" name="MOISTURIZER" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->MOISTURIZER }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>PH</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-6">
                    <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- PH here" name="PH" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->PH }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Water insoluble matter</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-6">
                    <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- PH here" name="water_insoluble_matter" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->water_insoluble_matter }}@endif"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Matter soluble in water other than sodium chloride</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-6">
                    <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- PH here" name="matter_soluble_sc" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->matter_soluble_sc }}@endif"/>
                </div>
            </div>
            <div class="clearfix" style="margin-left: 120px;">
                <div class="col-md-offset-3 col-md-9">
                    @if($editBstiTestStandard)
                        @php
                            $editPermissionLevel = $previllage->UPDATE;
                        @endphp
                        @if($editPermissionLevel == 1)
                            <a class="green showModalGlobal btn btn-warning" id="{{ 'bsti-test-standard/'.$editBstiTestStandard->BSTITEST_ID.'/edit' }}" data-target=".modal" role="button" data-toggle="modal" data-permission="{{ $editPermissionLevel }}" title="Edit BSTI Test Standard">
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
                <h4  style="color: #1B6AAA; text-align: center; margin-left: -200px;">Bsti Test Standard Result Range</h4>
                <hr>
                <form action="{{ url('/bsti-test-result-range') }}" method="post" class="form-horizontal" role="form">
                    @csrf
                    <h4><u>Sodium Chloride</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess SODIUM_CHLORIDE_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="SODIUM_CHLORIDE_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->SODIUM_CHLORIDE_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess SODIUM_CHLORIDE_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="SODIUM_CHLORIDE_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->SODIUM_CHLORIDE_MAX }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <h4><u>Moisturizer</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess MOISTURIZER_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="MOISTURIZER_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->MOISTURIZER_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess MOISTURIZER_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="MOISTURIZER_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->MOISTURIZER_MAX }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <h4><u>Iodize Content(PPM)</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess PPM_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="PPM_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->PPM_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess PPM_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="PPM_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->PPM_MAX }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <h4><u>PH</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess PH_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="PH_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->PH_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess PH_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="PH_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->PH_MAX }}@endif"/>
                                {{--<input type="text" value="{{ $editBstiTestStandardResultRange->BSTITEST_RESULT_ID }}">--}}
                            </div>
                        </div>
                    </div>
                    <h4><u>Water insoluble matter</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess WIM_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="WIM_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->WIM_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess WIM_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="WIM_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->WIM_MAX }}@endif"/>
                                {{--<input type="text" value="{{ $editBstiTestStandardResultRange->BSTITEST_RESULT_ID }}">--}}
                            </div>
                        </div>
                    </div>
                    <h4><u>Matter soluble in water other than sodium chloride</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess MSWSC_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="MSWSC_MIN" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->MSWSC_MIN }}@endif"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-7">
                                <input type="text" id="inputSuccess MSWSC_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="MSWSC_MAX" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandardResultRange){{ $editBstiTestStandardResultRange->MSWSC_MAX }}@endif"/>
                                {{--<input type="text" value="{{ $editBstiTestStandardResultRange->BSTITEST_RESULT_ID }}">--}}
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

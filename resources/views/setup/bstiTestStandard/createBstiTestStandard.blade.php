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
             <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Sodium Chloride</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-7">
                        <input type="text" id="inputSuccess " placeholder="Example:- Sodium Chloride Percentage here" name="SODIUM_CHLORIDE" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->SODIUM_CHLORIDE }}@endif"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Moisturizer</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-7">
                        <input type="text" id="inputSuccess" placeholder="Example:- Moisturizer Percentage here" name="MOISTURIZER" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->MOISTURIZER }}@endif"/>
                    </div>
                </div>
             </div>
             <div class="col-md-6" style="margin-left: -125px;">
                <div class="form-group">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Iodine Content(PPM)</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-7">
                        <input type="text" id="inputSuccess" placeholder="Example:- Iodine Content(PPM) here" name="PPM" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->PPM }}@endif"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>PH</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-7">
                        <input type="text" id="inputSuccess" placeholder="Example:- PH here" name="PH" class="form-control col-xs-10 col-sm-5" value="@if($editBstiTestStandard){{ $editBstiTestStandard->PH }}@endif"/>
                    </div>
                </div>
             </div>
            <div class="clearfix" style="margin-left: 120px;">
                <div class="col-md-offset-3 col-md-9">
                    @php
                        $editPermissionLevel = $previllage->UPDATE;
                    @endphp
                    @if($editPermissionLevel == 1)
                    <a class="green showModalGlobal btn btn-warning" id="{{ 'bsti-test-standard/'.$editBstiTestStandard->BSTITEST_ID.'/edit' }}" data-target=".modal" role="button" data-toggle="modal" data-permission="{{ $editPermissionLevel }}" title="Edit BSTI Test Standard">
                        <i class="ace-icon fa fa-pencil bigger-130"></i> <span>Edit</span>
                    </a>
                    @endif
                    @if($editBstiTestStandard)
                        <button type="submit" class="btn btn-primary submitBtn" disabled="disabled">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Save
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary submitBtn">
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
                <form action="{{ url('/bsti-test-result-range') }}" method="post" class="form-horizontal" role="form" id="myform">
                    @csrf
                    <h4><u>Sodium Chloride</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="inputSuccess SODIUM_CHLORIDE_MIN" placeholder="" name="SODIUM_CHLORIDE_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandardResultRange->SODIUM_CHLORIDE_MIN }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="inputSuccess SODIUM_CHLORIDE_MAX" placeholder="" name="SODIUM_CHLORIDE_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandardResultRange->SODIUM_CHLORIDE_MAX }}"/>
                            </div>
                        </div>
                    </div>
                    <h4><u>Moisturizer</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="inputSuccess MOISTURIZER_MIN" placeholder="" name="MOISTURIZER_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandardResultRange->MOISTURIZER_MIN }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="inputSuccess MOISTURIZER_MAX" placeholder="" name="MOISTURIZER_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandardResultRange->MOISTURIZER_MAX }}"/>
                            </div>
                        </div>
                    </div>
                    <h4><u>Iodize Content(PPM)</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="inputSuccess PPM_MIN" placeholder="" name="PPM_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandardResultRange->PPM_MIN }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="inputSuccess PPM_MAX" placeholder="" name="PPM_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandardResultRange->PPM_MAX }}"/>
                            </div>
                        </div>
                    </div>
                    <h4><u>PH</u></h4>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="inputSuccess PH_MIN" placeholder="" name="PH_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandardResultRange->PH_MIN }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="inputSuccess PH_MAX" placeholder="" name="PH_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandardResultRange->PH_MAX }}"/>
                                {{--<input type="text" value="{{ $editBstiTestStandardResultRange->BSTITEST_RESULT_ID }}">--}}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix" style="margin-left: 120px;">
                        <div class="col-md-offset-3 col-md-9">
                            @php
                                $editPermissionLevel = $previllage->UPDATE;
                            @endphp
                            @if($editPermissionLevel == 1)

                                <a class="green showModalGlobal btn btn-warning" id="{{ 'bsti-test-result-range/'.$editBstiTestStandardResultRange->BSTITEST_RESULT_ID.'/edit' }}" data-target=".modal" modal-size="modal-lg" role="button" data-toggle="modal" data-permission="{{ $editPermissionLevel }}" title="Edit BSTI Test Standard Range">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i> <span>Edit</span>
                                </a>
                            @endif
                            @if($editBstiTestStandardResultRange)
                                <button type="submit" class="btn btn-primary submitBtn" disabled="disabled">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Save
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary submitBtn">
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
    <!-- Sweet Alert Global Script End -->

@endsection

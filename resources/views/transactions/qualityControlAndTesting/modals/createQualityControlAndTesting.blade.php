<div class="col-md-12">
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>
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
    <form id="myform" action="{{ url('/quality-control-testing') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        {{--<div class="col-md-12">--}}
            @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-md-12"> <b>Date</b><span style="color: red;"> </span> </label>
                        <div class="col-md-12">
                            <input type="text" name="QC_DATE" id="QC_DATE" readonly value="{{date('m/d/Y')}}" class="date-picker" />
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-12"><b>Quality Control BY</b><span style="color: red;"> </span></label>
                    <div class="col-md-12">
                        <span class="block input-icon input-icon-right">
                            <select id="QC_BY"  class="chosen-select form-control" name="QC_BY" data-placeholder="Select Quality Control BY">
                               <option value=""></option>
                                @foreach($qulityControlId as $name)
                                    <option value="{{$name->LOOKUPCHD_ID}}"> {{$name->LOOKUPCHD_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-12"><b>Agency</b><span style="color: red;"> </span></label>
                    <div class="col-md-12">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess AGENCY_ID" class="chosen-select form-control" name="AGENCY_ID" data-placeholder="Select Agency">
                               <option value=""></option>
                                @foreach($agencyId as $agency)
                                    <option value="{{$agency->LOOKUPCHD_ID}}"> {{$agency->LOOKUPCHD_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-md-12"> <b>Batch No</b><span style="color: red;"> </span> </label>
                    <div class="col-md-12">
                        <span class="block input-icon input-icon-right">
                            <select id="BATCH_NO"  class="chosen-select form-control" name="BATCH_NO" data-placeholder="Select Batch No">
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
                    <label class="col-md-12"><b>Test Name</b><span style="color: red;"> </span></label>
                    <div class="col-md-12">
                        <input type="text" name="QC_TESTNAME" id="QC_TESTNAME" placeholder="BSTI test standard"  value="BSTI test standard" class="form-control col-xs-5 col-sm-5" />
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
                            <textarea rows="3" placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5"></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
            {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
            {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                    {{--<label style="margin-left: -250px;" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Date</b><span style="color: red;"> </span> </label>--}}
                    {{--<div class="col-sm-2">--}}
                        {{--<input type="text" name="QC_DATE" id="QC_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 date-picker" />--}}
                    {{--</div>--}}

                    {{--<label style="margin-left: -150px;" for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Quality Control BY</b><span style="color: red;"> </span></label>--}}
                    {{--<div class="col-sm-2">--}}
                        {{--<span class="block input-icon input-icon-right">--}}
                            {{--<select id="QC_BY"  class="chosen-select form-control" name="QC_BY" data-placeholder="Select Quality Control BY">--}}
                               {{--<option value=""></option>--}}
                                {{--@foreach($qulityControlId as $name)--}}
                                    {{--<option value="{{$name->LOOKUPCHD_ID}}"> {{$name->LOOKUPCHD_NAME}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</span>--}}
                    {{--</div>--}}
                    {{--<label  style="margin-left: -210px;" for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Agency</b><span style="color: red;"> </span></label>--}}
                    {{--<div class="col-sm-2">--}}
                        {{--<span class="block input-icon input-icon-right">--}}
                            {{--<select id="form-field-select-3 inputSuccess AGENCY_ID" class="chosen-select form-control" name="AGENCY_ID" data-placeholder="Select Agency">--}}
                               {{--<option value=""></option>--}}
                                {{--@foreach($agencyId as $agency)--}}
                                    {{--<option value="{{$agency->LOOKUPCHD_ID}}"> {{$agency->LOOKUPCHD_NAME}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</span>--}}
                    {{--</div>--}}
                    {{--<label style="margin-left: -210px;" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Batch No</b><span style="color: red;"> </span> </label>--}}
                    {{--<div class="col-sm-2">--}}
                        {{--<span class="block input-icon input-icon-right">--}}
                            {{--<select id="BATCH_NO"  class="chosen-select form-control" name="BATCH_NO" data-placeholder="Select Batch No">--}}
                               {{--<option value=""></option>--}}
                                {{--@foreach($iodizeBatch as $iodize)--}}
                                    {{--<option value="{{$iodize->IODIZEDMST_ID}}"> {{$iodize->BATCH_NO}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</span>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group">


                </div>
            {{--</div>--}}
            {{--<div class="col-md-6">--}}



                <div class="form-group">


                </div>
            {{--</div>--}}
            {{--<div class="col-md-6">--}}

            {{--</div>--}}
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

        <div class="clearfix" >
            <div class="col-md-offset-3 col-md-9" style="margin-left: 510px;">
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

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
<script>
    $(document).ready(function () {
        $.validator.addMethod(
            "regex",
            function(value, element, regexp)
            {
                if (regexp.constructor != RegExp)
                    regexp = new RegExp(regexp);
                else if (regexp.global)
                    regexp.lastIndex = 0;
                return this.optional(element) || regexp.test(value);
            },
            "Please check your input."
        );

        $('#myform').validate({ // initialize the plugin
            errorClass: "my-error-class",
            //validClass: "my-valid-class",
            rules: {
                 SODIUM_CHLORIDE:{
                    required: true,
                },
                MOISTURIZER:{
                    required: true,
                },
                IODINE_CONTENT:{
                    required: true,
                },
                PH:{
                    required: true,
                },
                QUALITY_CONTROL_IMAGE:{
                    required: true,
                    extension: "xlsx|csv"
                }
            },
            messages: {
                QUALITY_CONTROL_IMAGE: {
                    //required: "Please upload file.",
                    extension: "Please upload file in these format only ( XLSX,CSV )."
                },
            }
        });

    });

</script>


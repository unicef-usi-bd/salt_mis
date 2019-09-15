@extends('master')

@section('mainContent')
    {{--@include('masterGlobal.datePicker')--}}
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <style>
        .table th{
            text-align: center;
        }

        .chosen-container { width: 100% !important; }

        .select2{
            width:100% !important;
        }
        .disabledTab{
            pointer-events: none;
        }
        .my-error-class {
            color:red;
        }
        /*.my-valid-class {*/
            /*color:green;*/
        /*}*/
        .input-icon.input-icon-right>input,select.form-control {
            padding-left: 3px;
            padding-right: 0px;
            font-size: small;
        }

    </style>

    <div class="page-header">
        <h1>
            {{--{{ trans('soeReport.report') }}--}}
            Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{--{{ trans('soeReport.report_dashboard') }}--}}
                Miller Profie
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-md-12" style="width: 1250px;">
            <div class="col-sm-12">

                <div class="tabbable">

                    <ul class="nav nav-tabs" id="myTab">

                        @php
                            $millerDetails = DB::select(DB::raw(
                                "select * from ssm_mill_info where MILL_ID = $millerInfoId"
                            ));
                            //echo $millerDetails[0]->OWNER_TYPE_ID;
                        @endphp

                        <li> <a data-toggle="tab" href="#mill"> Mill Information </a> </li>
                        {{--@if($millerDetails[0]->OWNER_TYPE_ID == 12)--}}
                        <li class="disabled disabledTab"> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
                        {{--@else--}}
                        {{--<li> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>--}}
                        {{--@endif--}}
                        <li class="active"> <a data-toggle="tab" href="#certificate">  Certificate Information </a> </li>
                        <li class="disabled disabledTab"> <a data-toggle="tab" href="#qc"> QC Information </a> </li>
                        <li class="disabled disabledTab"> <a data-toggle="tab" href="#employee"> Employee Information </a> </li>
                    </ul>

                    <div class="tab-content">

                        {{--Mill Info--}}
                        @include('profile.miller.updateMillInformation')
                        {{--/-Miller Info--}}
                        {{--Entrepreneur Information--}}
                        @include('profile.miller.updateEntrepreneurInformation')
                        {{--/-Entrepreneur Information--}}



                        {{--Certificate Info--}}
                        <div id="certificate" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="color: red;">** You Must Provide Industrial Salt Manufacturing,Edible Salt Manufacturing and BSTI Certificate, OtherWise you can't go further of profile creation. </h5>
                                    <form action="{{ url('/certificate-info') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data" id="myform">
                                        @csrf
                                        @if(isset($millerInfoId))
                                            <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                                        @endif
                                        <table class="table table-bordered fundAllocation" style="margin-top: 64px;">
                                            <thead>
                                            <tr>
                                                <th style="width:175px ;">Type of Certificate<span style="color:red;"> *</span></th>
                                                <th style="width:130px ;">Issure Name<span style="color:red;"> *</span></th>
                                                <th style="width:140px ;">District<span style="color:red;"> </span></th>
                                                <th style="width:140px ;">Issuing Date<span style="color:red;"> *</span></th>
                                                <th style="width:150px ;">Certificate Number<span style="color:red;"> *</span></th>
                                                <th style="width: 260px;">Attached File<span style="color:red;"> *</span></th>
                                                <th style="width:140px;" >Renewing Date<span style="color:red;"> *</span></th>
                                                <th  style="width:140px ;">Remarks</th>
                                                <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd2"><i class="fa fa-plus"></i></span></th>
                                            </tr>
                                            </thead>
                                            <tbody class="newRow2">
                                            <tr class="rowFirst2">

                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <select class="form-control CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]"  >
                                                            <option value="">Select</option>
                                                            @foreach($certificate as $row)
                                                                <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" id="textInput" name="ISSURE_ID[]" class="chosen-container ISSURE_ID">
                                                        {{--<select class="form-control ISSURE_ID" id="ISSURE_ID" name="ISSURE_ID[]"  >--}}
                                                            {{--<option value="">Select</option>--}}
                                                            {{--@foreach($issueBy as $row)--}}
                                                                {{--<option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                                            {{--@endforeach--}}
                                                         {{--</select>--}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <select class="form-control DISTRICT_ID" id="DISTRICT_ID" name="DISTRICT_ID[]"  >
                                                            <option value="">Select</option>
                                                            @foreach($getDistrict as $row)
                                                                <option value="{{ $row->DISTRICT_ID }}">{{ $row->DISTRICT_NAME }}</option>
                                                            @endforeach
                                                         </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="date" id="textInput" name="ISSUING_DATE[]" class="chosen-container ISSUING_DATE">
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text"  name="CERTIFICATE_NO[]" id="inputSuccess total_amount" value="" class="width-100 CERTIFICATE_NO"  />
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="file" name="user_image[]" class="chosen-container TRADE_LICENSE" >
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="date" id="textInput1" name="RENEWING_DATE[]" class="chosen-container RENEWING_DATE">
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="budget_against_code "><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="REMARKS[]" id="inputSuccess total_amount" value="" class="width-100 REMARKS"  />
                                                    </span>
                                                </td>
                                                <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="clearfix">
                                            <div class="col-md-offset-3 col-md-9" style="margin-left: 35%!important;">
                                                <button type="reset" class="btn">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    {{ trans('dashboard.reset') }}
                                                </button>
                                                <button class="btn btn-primary btnCertificate">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Save & Next
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $('.rowAdd2').click(function(){
                                    var getTr = $('tr.rowFirst2:first');
//            alert(getTr.html());
                                    $("select.chosen-select").chosen('destroy');
                                    $('tbody.newRow2').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
                                    var defaultRow = $('tr.removableRow:last');
                                    defaultRow.find(' select.CERTIFICATE_TYPE_ID').attr('disabled', false);
                                    defaultRow.find('select.ISSURE_ID').prop('disabled', false);

//            For Ignore array Conflict
                                    defaultRow.find('input.ISSUING_DATE').attr('disabled', false);
                                    defaultRow.find('input.CERTIFICATE_NO').attr('disabled', false);
                                    defaultRow.find('input.TRADE_LICENSE').attr('disabled', false);
                                    defaultRow.find('input.RENEWING_DATE').attr('disabled', false);
                                    defaultRow.find('input.REMARKS').attr('disabled', false);
                                    defaultRow.find('span.budget_against_code').text('');
                                    defaultRow.find('span.errorMsg').text('');
                                    $('.chosen-select').chosen(0);
                                });
                            });
                            // Fore Remove Row By Click
                            $(document).on("click", "span.rowRemove ", function () {
                                $(this).closest("tr.removableRow").remove();
                            });

                        </script>
                        {{--/-Certificate Info--}}

                        {{--QC Info--}}
                        @include('profile.miller.qcInformation')
                        {{--/- QC Info--}}

                        {{--Employee Info--}}
                        @include('profile.miller.employeeInformation')
                        {{--/- Employee Info--}}


                    </div>
                </div>
            </div><!-- /.col -->

            <div class="space"></div>
        </div>
    </div><!-- /.row -->



    @include('masterGlobal.chosenSelect')
    @include('masterGlobal.getDistrict')
    @include('masterGlobal.getUpazila')
    @include('masterGlobal.getUnion')
    @include('masterGlobal.getMillersId')
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    {{--<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>--}}

    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>

//        $(document).on('click','#OWNER_TYPE_ID',function(){
//            console.log('hi');
//        });

        $(document).ready(function(){
            $('.rowAdd').click(function(){
                var getTr = $('tr.rowFirst:first');
//            alert(getTr.html());
                $("select.chosen-select").chosen('destroy');
                $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
                var defaultRow = $('tr.removableRow:last');
                defaultRow.find(' input.OWNER_NAME').attr('disabled', false);
                defaultRow.find('select.DIVISION_ID').prop('disabled', false);
                defaultRow.find('select.DISTRICT_ID').prop('disabled', false);
                defaultRow.find('select.UPAZILA_ID').prop('disabled', false);
                defaultRow.find('select.UNION_ID').prop('disabled', false);
//            For Ignore array Conflict
                defaultRow.find('input.NID').attr('NID', false);
                defaultRow.find('input.MOBILE_1').attr('MOBILE_1', false);
                defaultRow.find('input.MOBILE_2').attr('disabled', false);
                defaultRow.find('input.EMAIL').attr('disabled', false);
                defaultRow.find('input.REMARKS').attr('disabled', false);
                defaultRow.find('span.budget_against_code').text('');
                defaultRow.find('span.errorMsg').text('');
                $('.chosen-select').chosen(0);
            });
        });
        // Fore Remove Row By Click
        $(document).on("click", "span.rowRemove ", function () {
            $(this).closest("tr.removableRow").remove();
        });

        $(document).on('change','.CERTIFICATE_TYPE_ID',function(){
            var certificateTypeId = $(this).val();
            $.ajax({
                type : 'GET',
                url : '{{ url('certificate-issuer-name') }}/'+certificateTypeId,
                success: function (data) {
                    $('.ISSURE_ID').val(data[0].LOOKUPCHD_NAME);
                }
            });
            checkCertificate();
        });

        $(document).ready(function () {
            $('.btnCertificate').prop('disabled', true);

            $('#myform').validate({ // initialize the plugin
                errorClass: "my-error-class",
                //validClass: "my-valid-class",
                rules: {
                    'CERTIFICATE_TYPE_ID[]': {
                        required: true,
                    },
                    'ISSURE_ID[]': {
                        required: true,

                    },
                    "ISSUING_DATE[]":{
                        required: true,


                    },
                    'CERTIFICATE_NO[]':{
                        required: true,

                    },
                    'user_image[]':{
                        required: true,
                    },
                    'RENEWING_DATE[]':{
                        required: true,
                    }

                }
            });

        });
        
        function checkCertificate() {
            var bsti = false; // 34
            var industrial = false; // 38
            var ediTable = false; // 39
            $('.newRow2 tr').each(function () {
                var certificateId = parseInt($(this).find('.CERTIFICATE_TYPE_ID').val());
                if(certificateId===34) bsti = true;
                if(certificateId===38) industrial = true;
                if(certificateId===39) ediTable = true;
            });
            if(bsti && industrial && ediTable){
                $('.btnCertificate').prop('disabled', false);
            } else{
                $('.btnCertificate').prop('disabled', true);
            }
        }

//        $('.CERTIFICATE_TYPE_ID').change(function() {
//            if( $(this).val() == 32 || $(this).val() == 36) {
//                $('#textInput').prop( "disabled", true );
//                $('#textInput1').prop( "disabled", true );
//            } else {
//                $('#textInput').prop( "disabled", false );
//                $('#textInput1').prop( "disabled", false );
//            }
//        });

    </script>
    @include('profile.miller.ajaxUpdateScriptForAllInfo')
    @include('profile.miller.updateMillersId')



    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')


@endsection

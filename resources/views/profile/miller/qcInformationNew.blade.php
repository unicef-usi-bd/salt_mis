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
        <div class="col-md-12">
            <div class="col-sm-12">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">

                        <li> <a data-toggle="tab" href="#mill"> Mill Information </a> </li>
                        <li> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
                        <li> <a data-toggle="tab" href="#certificate">  Certificate Information </a> </li>
                        <li class="active"> <a data-toggle="tab" href="#qc"> QC Information </a> </li>
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
                        @include('profile.miller.updateCertificateInformation')

                        {{--/-Certificate Info--}}

                        {{--QC Info--}}
                        <div id="qc" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="{{ url('/qc-info') }}" method="post" class="form-horizontal" role="form">
                                        @csrf
                                        @if(isset($millerInfoId))
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
                                                    Save & Next
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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




    </script>
    @include('profile.miller.ajaxUpdateScriptForAllInfo')
    @include('profile.miller.updateMillersId')


    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.getDistrictUpazilaUnion')

@endsection

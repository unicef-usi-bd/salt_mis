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

                        <li> <a data-toggle="tab" href="#mill"> Mill Information </a> </li>
                        <li> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
                        <li> <a data-toggle="tab" href="#certificate">  Certificate Information </a> </li>
                        <li> <a data-toggle="tab" href="#qc"> QC Information </a> </li>
                        <li class="active"> <a data-toggle="tab" href="#employee"> Employee Information </a> </li>
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
                        @include('profile.miller.updateQcInformation')

                        {{--/- QC Info--}}

                        {{--Employee Info--}}
                        <div id="employee" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ url('/employee-info') }}" method="post" class="form-horizontal" role="form" >
                                        @csrf
                                        @if(isset($millerInfoId))
                                            <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                                        @endif
                                        <div class="col-md-6">
                                            <b style="font-size: 14px;">Total Number of Employee</b> <br><br>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="TOTMALE_EMP" class="chosen-container totalMaleEmp" placeholder="Male">
                                                    </span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="TOTFEM_EMP" class="chosen-container totalFemaleEmp" placeholder="Female">
                                                    </span>
                                                </div>
                                            </div>

                                            <b style="font-size: 14px;">Part Time Employee</b> <br><br>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="PARTTIMEMALE_EMP" class="chosen-container partTimeMaleEmp" placeholder="Male">
                                                    </span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text"  name="PARTTIMEFEM_EMP" class="chosen-container partTimeFemaleEmp" placeholder="Female">
                                                    </span>
                                                </div>
                                            </div>
                                            <span style="color:red;display: none" class="error">Total number of Employee must be equal to Part time and Full time employee.</span>
                                            <br><b style="font-size: 14px;">Remarks</b> <br><br>
                                            <div class="form-group">
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       {{--<input type="text" name="REMARKS" class="chosen-container" placeholder="Male">--}}
                                                       <textarea name="REMARKS" id="" cols="123" rows="2"></textarea>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <b style="font-size: 14px;">Full Time Employee</b> <br><br>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="FULLTIMEMALE_EMP" class="chosen-container fullTimeMaleEmp" placeholder="Male">
                                                    </span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="FULLTIMEFEM_EMP" class="chosen-container fullTimeFemaleEmp" placeholder="Female">
                                                    </span>
                                                </div>
                                            </div>
                                            <b style="font-size: 14px;">Total Number of Technical Person </b> <br><br>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="TOTMALETECH_PER" class="chosen-container" placeholder="Male">
                                                    </span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="TOTFEMTECH_PER" class="chosen-container" placeholder="Female">
                                                    </span>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="clearfix">
                                            <div class="col-md-offset-3 col-md-9" style="margin-left: 30%!important;">
                                                <button type="reset" class="btn">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    {{ trans('dashboard.reset') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary finalSubmit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
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
     {{--validation for full time employee--}}
    @include('profile.miller.totalEmployeeValidation')
    @include('profile.miller.updateMillersId')


    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.getDistrictUpazilaUnion')

@endsection



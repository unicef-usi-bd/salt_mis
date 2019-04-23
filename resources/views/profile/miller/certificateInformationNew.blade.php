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
        <div class="col-md-12" style="width: 1040px;">
            <div class="col-sm-12">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">

                        <li> <a data-toggle="tab" href="#mill"> Mill Information </a> </li>
                        <li> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
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

                                    <form action="{{ url('/certificate-info') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($millerInfoId))
                                            <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                                        @endif
                                        <table class="table table-bordered fundAllocation" style="margin-top: 64px;">
                                            <thead>
                                            <tr>
                                                <th style="width:175px ;">Type of Certificate<span style="color:red;"> </span></th>
                                                <th style="width:130px ;">Issure Name<span style="color:red;"> </span></th>
                                                <th style="width:140px ;">Issuing Date</th>
                                                <th style="width:150px ;">Certificate Number</th>
                                                <th style="width: 260px;">Trade License</th>
                                                <th style="width:140px;" >Renewing Date</th>
                                                <th  style="width:140px ;">Remarks</th>
                                                <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd2"><i class="fa fa-plus"></i></span></th>
                                            </tr>
                                            </thead>
                                            <tbody class="newRow2">
                                            <tr class="rowFirst2">

                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <select class="form-control chosen-select CERTIFICATE_TYPE_ID" id="CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]"  >
                                                            <option value="">Select</option>
                                                            @foreach($certificate as $row)
                                                                <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <select class="form-control chosen-select ISSURE_ID" id="ISSURE_ID" name="ISSURE_ID[]"  >
                                                            <option value="">Select</option>
                                                            @foreach($issueBy as $row)
                                                                <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                            @endforeach
                                                         </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="date" name="ISSUING_DATE[]" class="chosen-container ISSUING_DATE">
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="CERTIFICATE_NO[]" id="inputSuccess total_amount" value="" class="width-100 CERTIFICATE_NO"  />
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
                                                       <input type="date" name="RENEWING_DATE[]" class="chosen-container RENEWING_DATE">
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


@endsection

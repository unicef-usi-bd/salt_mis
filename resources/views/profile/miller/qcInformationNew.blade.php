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
        <div class="col-md-12">
            <div class="col-sm-12">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">

                        <li> <a data-toggle="tab" href="#mill"> Mill Information </a> </li>
                        <li> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
                        <li> <a data-toggle="tab" href="#certificate">  Certificate Information </a> </li>
                        <li class="active"> <a data-toggle="tab" href="#qc"> QC Information </a> </li>
                        <li> <a data-toggle="tab" href="#employee"> Employee Information </a> </li>
                    </ul>

                    <div class="tab-content">
                        {{--Mill Info--}}
                        <div id="mill" class="tab-pane fade ">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="{{ url('/mill-info') }}" method="post" class="form-horizontal" role="form" >
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Name of Mill</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="MILL_NAME" class="chosen-container">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Process Type</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="REG_TYPE_ID" class="chosen-select chosen-container" name="PROCESS_TYPE_ID" data-placeholder="Select">
                                                           <option value=""></option>
                                                            @foreach($processType as $row)
                                                               <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Mill</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="MILL_TYPE_ID" class="chosen-select chosen-container" name="MILL_TYPE_ID" data-placeholder="Select">
                                                           <option value=""></option>
                                                            @foreach($millType as $row)
                                                               <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Capacity</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="REG_TYPE_ID" class="chosen-select chosen-container" name="CAPACITY_ID" data-placeholder="Select">
                                                           <option value=""></option>
                                                            @foreach($capacity as $row)
                                                               <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Zone</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="ZONE_ID" class="chosen-select chosen-container" name="ZONE_ID" data-placeholder="Select">
                                                           <option value=""></option>
                                                            @foreach($getZone as $row)
                                                               <option value="{{ $row->ZONE_CODE }}">{{ $row->ZONE_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Millers ID</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <input readonly type="text" name="MILLERS_ID" class="chosen-container millersId">
                                                    </span>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group" >
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                        <select id="DIVISION_ID" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">
                                                            <option value=""></option>
                                                            @foreach($getDivision as $row)
                                                                <option value="{{ $row->DIVISION_ID }}">{{ $row->DIVISION_NAME }}</option>
                                                            @endforeach

                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="DISTRICT_ID" class="chosen-select chosen-container district" name="DISTRICT_ID" data-placeholder="Select">
                                                           <option value="">Select</option>

                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Upazila</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="UPAZILA_ID" class="chosen-select chosen-container upazila" name="UPAZILA_ID" data-placeholder="Select">
                                                           <option value="">Select</option>
                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Union</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="UNION_ID" class="chosen-select chosen-container union" name="UNION_ID" data-placeholder="Select">
                                                           <option value="">Select</option>
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="ACTIVE_FLG" class="chosen-select chosen-container" name="ACTIVE_FLG" data-placeholder="Select">
                                                           <option value="1">Active</option>
                                                           <option value="0">Inactive</option>
                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Remarks</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="REMARKS" class="chosen-container">
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="clearfix">
                                            <div class="col-md-offset-3 col-md-9" style="margin-left: 40%!important;">
                                                <button type="reset" class="btn">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    {{ trans('dashboard.reset') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    {{ trans('dashboard.submit') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--/-Miller Info--}}
                        {{--Entrepreneur Information--}}
                        <div id="entrepreneur" class="tab-pane fade ">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="{{ url('/entrepreneur-info') }}" method="post" class="form-horizontal" role="form">
                                        @csrf
                                        @if(isset($millerInfoId))
                                            <input type="text" value="{{ $millerInfoId }}" name="MILL_ID">
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Registration Type</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="REG_TYPE_ID" class="chosen-select chosen-container" name="REG_TYPE_ID" data-placeholder="Select or search data">
                                                           <option value=""></option>
                                                            @foreach($registrationType as $row)
                                                               <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group" >
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Owner</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                        <select id="OWNER_TYPE_ID" name="OWNER_TYPE_ID" class="chosen-select chosen-container" data-placeholder="Select or search data">
                                                            <option value=""></option>
                                                            @foreach($ownerType as $row)
                                                                <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                            @endforeach

                                                        </select>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>


                                        <table class="table table-bordered fundAllocation" style="margin-top: 64px;">
                                            <thead>
                                            <tr>
                                                <th style="width:130px ;">Owner Name<span style="color:red;"> *</span></th>
                                                <th style="width:130px ;">Division<span style="color:red;"> </span></th>
                                                <th style="width: ;">District</th>
                                                <th style="width: ;">Upazila</th>
                                                <th style="width: 100px;">Union</th>
                                                <th style="width: ;" >NID</th>
                                                <th style="width: ;">Mobile 1</th>
                                                <th  style="width: ;">Mobile 2</th>
                                                <th  style="width: ;">Email</th>
                                                <th  style="width: ;">Remarks</th>
                                                <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                                            </tr>
                                            </thead>
                                            <tbody class="newRow">
                                            <tr class="rowFirst">
                                                <td>
                                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="OWNER_NAME[]" id="inputSuccess " value="" class="width-100 OWNER_NAME"  />
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <select class="form-control chosen-select DIVISION_ID" id="ENT_DIVISION_ID" name="DIVISION_ID[]"  >
                                                            <option value="">Select</option>
                                                            @foreach($getDivision as $row)
                                                                <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <select class="form-control chosen-select ent_district" id="ENT_DISTRICT_ID" name="DISTRICT_ID[]"  >
                                                            <option value="">Select</option>
                                                         </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <select class="form-control chosen-select ent_upazila" id="ENT_UPAZILA_ID" name="UPAZILA_ID[]"  >
                                                            <option value=""> Select </option>
                                                        </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <select class="form-control ent_union" id="UNION_ID" name="UNION_ID[]"  >
                                                            <option value="">Select</option>
                                                        </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="NID[]" id="inputSuccess total_amount" value="" class="width-100 NID"  />
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="MOBILE_1[]" id="inputSuccess total_amount" value="" class="width-100 MOBILE_1"  />
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="MOBILE_2[]" id="inputSuccess total_amount" value="" class="width-100 MOBILE_2"  />
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="EMAIL[]" id="inputSuccess batch_no" value="" class="width-100 EMAIL"  />
                                                        <input type="hidden" class="batch_disabled" disabled="disabled" name="batch_no[]" value="">
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
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="reset" class="btn">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    {{ trans('dashboard.reset') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    {{ trans('dashboard.submit') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--/-Entrepreneur Information--}}

                        {{--Certificate Info--}}
                        <div id="certificate" class="tab-pane fade ">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="{{ url('/certificate-info') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($millerInfoId))
                                            <input type="text" value="{{ $millerInfoId }}" name="MILL_ID">
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
                                                        <input type="date" name="ISSUING_DATE" class="chosen-container ISSUING_DATE">
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="CERTIFICATE_NO[]" id="inputSuccess total_amount" value="{{ $editData->CERTIFICATE_NO }}" class="width-100 CERTIFICATE_NO"  />
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
                                                       <input type="date" name="RENEWING_DATE" class="chosen-container RENEWING_DATE">
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
                                                    {{ trans('dashboard.submit') }}
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
                        {{--/-Certificate Info--}}

                        {{--QC Info--}}
                        <div id="qc" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="{{ url('/qc-info') }}" method="post" class="form-horizontal" role="form">
                                        @csrf
                                        @if(isset($millerInfoId))
                                            <input type="text" value="{{ $millerInfoId }}" name="MILL_ID">
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
                                                    {{ trans('dashboard.submit') }}
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



    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.getDistrictUpazilaUnion')

@endsection

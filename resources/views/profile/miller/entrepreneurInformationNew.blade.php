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
        /*.nav-tabs>li.active>a{*/
            /*background-color: #1CABE2;*/
        /*}*/

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
                        <li> <a data-toggle="tab" href="#mill_tab"> Mill Information </a> </li>
                        <li class="active"> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
                        <li class="disabled disabledTab"> <a data-toggle="tab" href="#certificate">  Certificate Information </a> </li>
                        <li class="disabled disabledTab"> <a data-toggle="tab" href="#qc"> QC Information </a> </li>
                        <li class="disabled disabledTab"> <a data-toggle="tab" href="#employee"> Employee Information </a> </li>
                    </ul>

                    <div class="tab-content">
                        {{--Mill Info--}}
                        <div id="mill_tab" class="tab-pane fade ">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="alert alert-info millInfo_msg"></div>

                                    <form id="millId"  class="form-horizontal" role="form" action="{{ url('edit-mill-info') }}" >
                                    {{--<form id="millId"  class="form-horizontal" role="form" action="{{ url('update-mill-information') }}" >--}}
                                        <input type="text" value="{{ $millerInfoId }}" name="MILL_ID" class="millerInfoId" >
                                        @csrf

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Name of Mill</b></label>
                                                <div class="col-sm-8">
                                                <span class="block input-icon input-icon-right">
                                                   <input type="text" name="MILL_NAME" class="chosen-container mill" value="{{ $editMillData->MILL_NAME }}">
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
                                                               <option value="{{ $row->LOOKUPCHD_ID }}" @if($editMillData->PROCESS_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Mill</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="MILL_TYPE_IDD" class="chosen-select chosen-container" name="MILL_TYPE_ID" data-placeholder="Select">
                                                           <option value=""></option>
                                                            @foreach($millType as $row)
                                                               <option value="{{ $row->UD_ID }}" @if($editMillData->MILL_TYPE_ID==$row->UD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
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
                                                               <option value="{{ $row->LOOKUPCHD_ID }}" @if($editMillData->CAPACITY_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Zone</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="ZONE_IDD" class="chosen-select chosen-container" name="ZONE_ID" data-placeholder="Select">
                                                           <option value=""></option>
                                                            @foreach($getZone as $row)
                                                               <option value="{{ $row->ZONE_CODE }}" @if($editMillData->ZONE_ID==$row->ZONE_CODE) selected @endif>{{ $row->ZONE_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Millers ID</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">

                                                       <input readonly type="text" name="MILLERS_ID" class="chosen-container millersIdd" value="{{ $editMillData->MILLERS_ID }}">
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
                                                                <option value="{{ $row->DIVISION_ID }}" @if($editMillData->DIVISION_ID==$row->DIVISION_ID) selected @endif>{{ $row->DIVISION_NAME }}</option>
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

                                                           <option value="{{ $editMillData->DISTRICT_ID }}">{{ $editMillData->DISTRICT_NAME }}</option>
                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Upazila</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="UPAZILA_ID" class="chosen-select chosen-container upazila" name="UPAZILA_ID" data-placeholder="Select">

                                                           <option value="{{ $editMillData->UPAZILA_ID }}">{{ $editMillData->UPAZILA_NAME }}</option>
                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Union</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="UNION_ID" class="chosen-select chosen-container union" name="UNION_ID" data-placeholder="Select">

                                                           <option value="{{ $editMillData->UNION_ID }}">{{ $editMillData->UNION_NAME }}</option>
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="ACTIVE_FLG" class="chosen-select chosen-container" name="ACTIVE_FLG" data-placeholder="Select">
                                                               @if(isset($editMillData))
                                                               <option value="1" @if($editMillData->ACTIVE_FLG=='1') selected  @endif >Active</option>
                                                               <option value="0" @if($editMillData->ACTIVE_FLG=='0') selected  @endif >Inactive</option>
                                                           @else
                                                               <option value="1">Active</option>
                                                               <option value="0">Inactive</option>
                                                           @endif
                                                       </select>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Remarks</b></label>
                                                <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">

                                                       <input type="text" name="REMARKS" value="{{ $editMillData->REMARKS }}" class="chosen-container">
                                                    </span>
                                                </div>
                                            </div>

                                        </div>

                                        <hr>
                                        <div class="clearfix">
                                            <div class="col-md-offset-3 col-md-9" style="margin-left: 44%!important;">
                                                <button type="reset" class="btn">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    {{ trans('dashboard.reset') }}
                                                </button>
                                                <button type="button" class="btn btn-primary btnUpdateMillInfo" onclick="millTab()">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Update & Next
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div> {{--col-md-12--}}
                            </div>
                        </div>

                        {{--/-Miller Info--}}
                        {{--Entrepreneur Information--}}
                        <div id="entrepreneur" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="{{ url('/entrepreneur-info') }}" method="post" class="form-horizontal" role="form">
                                        @csrf
                                        @if(isset($millerInfoId))
                                            <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
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
                                                <th style="">District</th>
                                                <th style="">Upazila</th>
                                                <th style="width: 100px;">Union</th>
                                                <th style="" >NID</th>
                                                <th style="">Mobile 1</th>
                                                <th  style="">Mobile 2</th>
                                                <th  style="">Email</th>
                                                <th  style="">Remarks</th>
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
                                                    Save & Next
                                                </button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--/-Entrepreneur Information--}}

                        {{--Certificate Info--}}
                        @include('profile.miller.certificateInformation')
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
    <script>
        $(document).ready(function () {
            $('#DIVISION_ID').on('change',function(){
                var divisionId = $(this).val(); //alert(divisionId);exit();
                var option = '<option value="">Select District</option>';
                $.ajax({
                    type : "get",
                    url  : "supplier-profile/get-district/{id}",
                    data : {'divisionId': divisionId},
                    success:function (data) {
                        for (var i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                        }
                        $('.district').html(option);
                        $('.district').trigger("chosen:updated");
                    }
                });
            });
        });

        $(document).ready(function () {
            $('select#DISTRICT_ID').on('change',function(){
                var districtId = $(this).val(); //alert(districtId); exit();
                var option = '<option value="">Select Upazila</option>';
                $.ajax({
                    type : "get",
                    url  : "supplier-profile/get-upazila/{id}",
                    data : {'districtId': districtId},
                    success:function (data) {
                        for (var i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                        }
                        $('.upazila').html(option);
                        $('.upazila').trigger("chosen:updated");
                    }
                });
            });
        });

        $(document).ready(function () {
            $('#UPAZILA_ID').on('change',function(){
                var upazilaId = $(this).val(); //alert(upazilaId);exit();
                var option = '<option value="">Select Union</option>';
                $.ajax({
                    type : "get",
                    url  : "supplier-profile/get-union/{id}",
                    data : {'upazilaId': upazilaId},
                    success:function (data) {
                        for (var i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].UNION_ID +'">'+ data[i].UNION_NAME+'</option>';
                        }
                        $('.union').html(option);
                        $('.union').trigger("chosen:updated");
                    }
                });
            });
        });
    </script>
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
    <script>  // millers Id
        $(document).ready(function () {
            $('#ZONE_IDD').on('change',function(){
                var millTypeId = $("#MILL_TYPE_IDD").val();
                var zoneId = $("#ZONE_IDD").val();
                var key = Math.floor(10000 + Math.random() * 90000);
                var millersIdd = millTypeId+'-'+zoneId+'-'+key;
                $('.millersIdd').val(millersIdd); //alert(millersId);exit();

            });
        });
    </script>




    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    <script>
        $(document).ready(function () {
            $('select#ENT_DIVISION_ID').on('change',function(){
                var divisionId = $(this).val(); //alert(divisionId);exit();
                var option = '<option value="">Select District</option>';
                $.ajax({
                    type : "get",
                    url  : "supplier-profile/get-district/{id}",
                    data : {'divisionId': divisionId},
                    success:function (data) {
                        for (var i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                        }
                        $('.ent_district').html(option);
                        $('.ent_district').trigger("chosen:updated");
                    }
                });
            });
        });

        $(document).ready(function () {
            $('select#ENT_DISTRICT_ID').on('change',function(){
                var districtId = $(this).val(); //alert(districtId); exit();
                var option = '<option value="">Select Upazila</option>';
                $.ajax({
                    type : "get",
                    url  : "supplier-profile/get-upazila/{id}",
                    data : {'districtId': districtId},
                    success:function (data) {
                        for (var i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                        }
                        $('.ent_upazila').html(option);
                        $('.ent_upazila').trigger("chosen:updated");
                    }
                });
            });
        });

        $(document).ready(function () {
            $('#ENT_UPAZILA_ID').on('change',function(){
                var upazilaId = $(this).val(); //alert(upazilaId);exit();
                var option = '<option value="">Select Union</option>';
                $.ajax({
                    type : "get",
                    url  : "supplier-profile/get-union/{id}",
                    data : {'upazilaId': upazilaId},
                    success:function (data) {
                        for (var i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].UNION_ID +'">'+ data[i].UNION_NAME+'</option>';
                        }
                        $('.ent_union').html(option);
                        $('.ent_union').trigger("chosen:updated");
                    }
                });
            });
        });
    </script>


@endsection

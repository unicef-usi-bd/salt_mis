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
        select.form-control {
            padding-left: 1px;
            padding-right: 0px;
            font-size: small;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }
        td{
            border:1px solid #000;
        }

        tr td:last-child{
            width:1%;
            white-space:nowrap;
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
                        <li class="active"> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
                        <li class="disabled disabledTab"> <a data-toggle="tab" href="#certificate">  Certificate Information </a> </li>
                        <li class="disabled disabledTab"> <a data-toggle="tab" href="#qc"> QC Information </a> </li>
                        <li class="disabled disabledTab"> <a data-toggle="tab" href="#employee"> Employee Information </a> </li>
                    </ul>

                    <div class="tab-content">
                        {{--Mill Info--}}
                        @include('profile.miller.updateMillInformation')

                        {{--/-Miller Info--}}
                        {{--Entrepreneur Information--}}
                        <div id="entrepreneur" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">

                                    <form action="{{ url('/entrepreneur-info') }}" method="post" class="form-horizontal" role="form" id="myform">
                                        @csrf
                                        @if(isset($millerInfoId))
                                            <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                                        @endif

                                        <?php

                                        $milltype =  DB::select(DB::raw("select OWNER_TYPE_ID, MILL_ID
                                                    from ssm_mill_info
                                                    where MILL_ID = $millerInfoId"));

                                        ?>

                                        {{--<div class="col-md-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Registration Type</b></label>--}}
                                                {{--<div class="col-sm-8">--}}
                                                    {{--<span class="block input-icon input-icon-right">--}}
                                                       {{--<select id="REG_TYPE_ID" class="chosen-select chosen-container" name="REG_TYPE_ID" data-placeholder="Select or search data">--}}
                                                           {{--<option value=""></option>--}}
                                                            {{--@foreach($registrationType as $row)--}}
                                                               {{--<option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                                           {{--@endforeach--}}

                                                       {{--</select>--}}
                                                    {{--</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                        {{--</div>--}}

                                        {{--<div class="col-md-6">--}}

                                            {{--<div class="form-group" >--}}
                                                {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Owner</b></label>--}}
                                                {{--<div class="col-sm-8">--}}
                                                    {{--<span class="block input-icon input-icon-right">--}}
                                                        {{--<select id="OWNER_TYPE_ID" name="OWNER_TYPE_ID" class="chosen-select chosen-container" data-placeholder="Select or search data">--}}
                                                            {{--<option value=""></option>--}}
                                                            {{--@foreach($ownerType as $row)--}}
                                                                {{--<option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                                            {{--@endforeach--}}

                                                        {{--</select>--}}
                                                    {{--</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                        {{--</div>--}}


                                        <div class="table-width" style="overflow-x: scroll;height: 280px;">
                                            <table class="table table-bordered fundAllocation" style="margin-top: 64px;width: 100%">
                                                <thead>

                                                <tr>
                                                    <th style="width:200px;">Owner Name <span style="color:red;"> *</span></th>
                                                    <th style="width:200px;">Division<span style="color:red;"> </span></th>
                                                    <th style="width:200px!important;">District</th>
                                                    <th style="width:200px;">Upazila</th>
                                                    {{--<th style="width:200px;">Union</th>--}}
                                                    <th style="width:200px;">NID<span style="color:red;"> </span></th>
                                                    <th style="width:200px;">Mobile 1<span style="color:red;"> *</span></th>
                                                    <th style="width:200px;">Mobile 2</th>
                                                    <th style="width:200px;">Email <span style="color:red;"> *</span></th>
                                                    <th style="width:200px;">Remarks</th>
                                                    @if($milltype[0]->OWNER_TYPE_ID != 12)
                                                    <th style="width:30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                                                    {{--@eles--}}
                                                        {{--<th style="width:30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>--}}
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody class="newRow">
                                                <tr class="rowFirst">
                                                    <td>
                                                        <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                        <span class="block input-icon input-icon-right">
                                                            {{--<input type="text" name="OWNER_NAME[]" id="inputSuccess " value="" class="width-100 OWNER_NAME"  />--}}
                                                            <input type="text" name="OWNER_NAME[]" id="inputSuccess " value="" class="OWNER_NAME"/>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="block input-icon input-icon-right">
                                                            <select class="form-control DIVISION_ID chosen-select" id="ENT_DIVISION_ID" name="DIVISION_ID[]" url="{{ url('supplier-profile/get-district') }}" >
                                                                <option value="">Select Division</option>
                                                                @foreach($getDivision as $row)
                                                                    <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                                                @endforeach
                                                            </select>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="block input-icon input-icon-right">
                                                            <select class="form-control ent_district chosen-select" id="ENT_DISTRICT_ID" name="DISTRICT_ID[]" url="{{ url('supplier-profile/get-upazila') }}" >
                                                                <option value="">Select</option>
                                                             </select>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="block input-icon input-icon-right">
                                                            <select class="form-control ent_upazila chosen-select" id="ENT_UPAZILA_ID" name="UPAZILA_ID[]" url="{{ url('supplier-profile/get-union') }}" >
                                                                <option value=""> Select </option>
                                                            </select>
                                                        </span>
                                                    </td>
                                                    {{--<td>--}}
                                                        {{--<span class="block input-icon input-icon-right">--}}
                                                            {{--<select class="form-control ent_union chosen-select" id="UNION_ID" name="UNION_ID[]"  >--}}
                                                                {{--<option value="">Select</option>--}}
                                                            {{--</select>--}}
                                                        {{--</span>--}}
                                                    {{--</td>--}}
                                                    <td>
                                                        <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" name="NID[]" minlength="10" id="inputSuccess" value="" class="NID"  />
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="number" name="MOBILE_1[]" maxlength="11" minlength="11" value="" class="MOBILE_1"  />
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="number" name="MOBILE_2[]" id="inputSuccess" value="" class="MOBILE_2" maxlength="11" minlength="11"  />
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" name="EMAIL[]" id="inputSuccess batch_no" value="" class="EMAIL"  />
                                                            <input type="hidden" class="batch_disabled" disabled="disabled" name="batch_no[]" value="">
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="budget_against_code "><!-- Drop Total Budget here By Ajax --></span>
                                                        <span class="block input-icon input-icon-right">
                                                            {{--<input type="text" name="REMARKS[]" id="inputSuccess " value="" class="REMARKS"  />--}}
                                                            <textarea name="REMARKS[]" class="REMARKS" id="" cols="25" rows="1"></textarea>
                                                        </span>
                                                    </td>
                                                    @if($milltype[0]->OWNER_TYPE_ID != 12)
                                                    <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                                                    @endif
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="clearfix">
                                            <div class="col-md-offset-3 col-md-9" style="margin-left: 360px;">
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

    {{--for Mill on change division --}}
    {{--for Mill on change division --}}
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
                //defaultRow.find('select.UNION_ID').prop('disabled', false);
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
    <script>
        $(document).ready(function () {
            $('select#ENT_DIVISION_ID').on('change',function(){
                var divisionId = $(this).val(); //alert(divisionId); //exit();
                var option = '<option value="">Select District</option>';
                var url  = $(this).attr('url');
                var url = url+'/'+divisionId;
                $.ajax({
                    type : "get",
                    url  : url,
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
                var url = $(this).attr('url');
                var url = url+'/'+districtId;
                $.ajax({
                    type : "get",
                    url  : url,
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
                var url = $(this).attr('url');
                var url = url+'/'+upazilaId;
                $.ajax({
                    type : "get",
                    url  : url,
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

        // validation check
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
                    "OWNER_NAME[]": {
                        required: true
                    },
                    "MOBILE_1[]":{
                        required: true,
                        regex:/^(?:\+?88)?01[15-9]\d{8}$/,
                    },
                    // "MOBILE_2[]":{
                    //     maxlength:11,
                    //     regex:/^(?:\+?88)?01[15-9]\d{8}$/,
                    //
                    // },
                    "EMAIL[]":{
                        required: true,
                        email: true
                    },
                    "NID[]":{
                        required: true,
                    }

                }
            });

        });
    </script>




@endsection

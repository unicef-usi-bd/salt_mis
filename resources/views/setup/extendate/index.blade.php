@extends('master')

@section('mainContent')

    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Extended date
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="col-md-12">
        <style>
            .my-error-class {
                color:red;
            }
            .my-valid-class {
                color:green;
            }
        </style>

{{--        <form id="myform" action="{{ url('/extended-date-update') }}" method="post" class="form-horizontal" role="form">--}}
            <div class="col-md-12">
                @csrf
                {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
                <div class="col-md-6" style="margin-left: 20%;">
                    <div class="form-group">
                        <label  for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Miller Name</b><span style="color: red;"> </span></label>
                        <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess " class="chosen-select millerName form-control" name="MILL_ID" data-placeholder="Select Mill Name">
                               <option value="">Select Mill Name</option>
                                @foreach($millerId as $row)
                                    <option value="{{$row->MILL_ID}}">{{ $row->MILL_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<label style="margin-left: -18%" class="col-sm-8 control-label no-padding-right" for="form-field-1-1"> <b>Renewing days</b><span style="color: red;"> </span> </label>--}}
                        {{--<div class="col-sm-6">--}}
                            {{--<input style="width: 50px;" id="renewalDaysId" type="text"  name=""  class="chosen-container renewingDays" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col-md-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<label style="margin-left: -5%" class="col-sm-6 control-label no-padding-right" for="form-field-1-1"> <b>Extended Date</b><span style="color: red;"> </span> </label>--}}
                        {{--<div class="col-sm-4">--}}
                            {{--<input type="date" id="renewaldateId"  name="RENEWING_DATE"  class="expierDateId renewalDate RENEWING_DATE" value="">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        <br>
        <br>

            <div class="row" style="margin-top: 20px; width: 100%">
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        {{--<div class="tabbable resultTab">--}}
                        <div class="tab-content">

                            <div class="row tblReport" style="padding-left: 10px;padding-right: 10px;">

                            </div>
                        </div>
                        {{--</div>--}}
                    </div>


                </div>
            </div>
            <div class="form-group">

            </div>

            <div class="clearfix" style="margin-left: 150px;">
                {{--<div class="col-md-offset-3 col-md-9">--}}
                    {{--<button type="reset" class="btn test">--}}
                        {{--<i class="ace-icon fa fa-undo bigger-110"></i>--}}
                        {{--{{ trans('dashboard.reset') }}--}}
                    {{--</button>--}}
                    {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'unions' }}">--}}
                    {{--<button type="submit" class="btn btn-primary">--}}
                        {{--<i class="ace-icon fa fa-check bigger-110"></i>--}}
                        {{--{{ trans('dashboard.submit') }}--}}
                    {{--</button>--}}
                {{--</div>--}}
            </div>
        {{--</form>--}}
    </div>


    @include('masterGlobal.chosenSelect')
    @include('masterGlobal.datePicker')

    {{--@include('masterGlobal.formValidation')--}}
    <script>
        var Privileges = jQuery('#privileges');
        var select = this.value;
        Privileges.change(function () {
            if ($(this).val() == 1001) {
                $('.resources').show();
            }
            else $('.resources').hide();
        });

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

                    PHONE:{
                        required: true,
                        maxlength:11,
                        minlength:11,
                        regex:/^(?:\+?88)?01[15-9]\d{8}$/,
                    },
                    RCV_QTY:{
                        required: true,
                    }
                }
            });

        });

        $(document).on('change','.millerName',function () {
            //alert('hi');
            var mill_id = $(this).val();
//       alert(mill_id);
            var _token = '{{ csrf_token() }}';
            $.ajax({
                type: 'POST',
                url:'{{ url('extended-date/miller-info') }}',
                data:{'mill_id':mill_id,_token: _token},
                success:function (data) {
//                    console.log(data);
                    //$('.resultTab').show();
                    $('.tblReport').html(data.html);

                }
            });

        });

        $(document).on('keyup','.renewingDays',function () {
            //alert('hi');
            var dayAdd = $(this).val();
            var renewalDate = $('.renewalDate').text();
            if(renewalDate===""){
                alert('Alert ! Mill name is required.')
            }
            var array = renewalDate.split('-');
            var dd = array[0];
            var mm = array[1];
            var yy = array[2];
            var dateFrom = yy + '-' + mm + '-' + dd;
            renewalDate = daysAddToDate(dateFrom, dayAdd);
            $('.expierDateId').val(renewalDate);
        });

        $(document).on('change','.expierDateId',function () {
            //alert('hi');
            var toDate = $(this).val();
            var fromDate = $('.renewalDate').text();
//            if(fromDate===""){
//                alert('Alert ! Mill name is required.')
//            }

            if(fromDate!=="" && toDate!==""){
                fromDate = dateToArray(fromDate)[2]+'-'+dateToArray(fromDate)[1]+'-'+dateToArray(fromDate)[0]; // format day-month-year to month-day-year
                var fromDate = new Date(fromDate);
                var toDate = new Date(toDate);
                var diffTime = Math.abs(toDate - fromDate);
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                $('.renewingDays').val(diffDays)
            }
        });

        function daysAddToDate(fromDate, daysToAdd) {
            var someDate = new Date(fromDate);
            someDate.setDate(someDate.getDate() + parseInt(daysToAdd));
            var dd = someDate.getDate()+1;
            var mm = someDate.getMonth() + 1;
            var yy = someDate.getFullYear();
            var someFormattedDate = yy +'-'+ mm +'-'+dd;
            return someFormattedDate;
        }

        function dateToArray(data) {
            return data.split('-');
        }


    </script>




@endsection


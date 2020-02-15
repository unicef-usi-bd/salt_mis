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
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>

    <div class="page-header">
        <h1>
            Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
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
                        @endphp

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
                                    <h5 style="color: red;">** You Must Provide Edible Salt Manufacturing and BSTI Certificate, OtherWise you can't go further of profile creation. </h5>
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
                                                        <select class="form-control CERTIFICATE_TYPE_ID" id="CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]"  required>
                                                            <option value="">Select</option>
                                                            @foreach($certificate as $row)
                                                                <option value="{{ $row->CERTIFICATE_ID }}">{{ $row->CERTIFICATE_NAME }}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                    <input type="hidden" placeholder=" " name="CERTIFICATE_TYPE[]" class="form-control col-xs-10 col-sm-5 CERTIFICATE_TYPE" value=""/>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <select class="form-control issuer ISSURE_ID" id="ISSURE_ID" name="ISSURE_ID[]"  required>
                                                            <option value="">Select</option>

                                                         </select>
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
                                                        <input type="date"  name="ISSUING_DATE[]" class="chosen-container ISSUING_DATE">
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text"  name="CERTIFICATE_NO[]" id="inputSuccess total_amount" value="" class="width-100 CERTIFICATE_NO"  required/>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="file" name="user_image[]" class="chosen-container TRADE_LICENSE" required>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="date" id="textInput1" name="RENEWING_DATE[]" class="chosen-container RENEWING_DATE" required>
                                                    </span>
                                                    <input type="hidden" placeholder=" " name="IS_EXPIRE[]" class="form-control col-xs-10 col-sm-5 IS_EXPIRE" value=""/>
                                                </td>

                                                <td>
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
                                                <button type="submit" class="btn btn-primary btnCertificate">
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
                                    $("select.chosen-select").chosen('destroy');
                                    $('tbody.newRow2').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
                                    var defaultRow = $('tr.removableRow:last');
                                    defaultRow.find(' select.CERTIFICATE_TYPE_ID').attr('disabled', false);
                                    defaultRow.find('select.ISSURE_ID').empty().append('<option value="">Select</option>');
                                    console.log(defaultRow.find('select.ISSURE_ID').val(''));
                                    defaultRow.find('input.ISSUING_DATE').attr('disabled', false);
                                    defaultRow.find('input.CERTIFICATE_NO').attr('disabled', false);
                                    defaultRow.find('input.TRADE_LICENSE').attr('disabled', false);
                                    defaultRow.find('input.RENEWING_DATE').attr('disabled', false);
                                    defaultRow.find('input.REMARKS').attr('disabled', false);

                                    $('.chosen-select').chosen(0);
                                });

                                $('.btnCertificate').prop('disabled', true);
                            });
                            // Fore Remove Row By Click
                            $(document).on("click", "span.rowRemove ", function () {
                                var thisRow = $(this).closest("tr.removableRow");
                                var certificateType = thisRow.find('.CERTIFICATE_TYPE_ID').val();
                                if(certificateType == 5 || certificateType == 10){
                                    $('.btnCertificate').prop('disabled', true);
                                }
                                thisRow.remove();

//
                            });

                        </script>
                        {{--/-Certificate Info--}}

                        {{--QC Info--}}
                        @include('profile.miller.modal.create.qcInformation')
                        {{--/- QC Info--}}

                        {{--Employee Info--}}
                        @include('profile.miller.modal.create.employeeInformation')
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

        // Fore Remove Row By Click
//        $(document).on("click", "span.rowRemove ", function () {
//            $(this).closest("tr.removableRow").remove();
//
//        });

        $(document).on('change','.CERTIFICATE_TYPE_ID',function(){

            checkCertificate();
        });


        function checkCertificate() {
            var bsti = false; // 34
            var ediTable = false; // 39
            $('.newRow2 tr').each(function () {
                var certificateId = parseInt($(this).find('.CERTIFICATE_TYPE_ID').val());
                if(certificateId===5) bsti = true;
                //if(certificateId===38) industrial = true;
                if(certificateId===10) ediTable = true;
            });
            if(bsti  && ediTable){
                $('.btnCertificate').prop('disabled', false);
            } else{
                $('.btnCertificate').prop('disabled', true);
            }
        }

        $('.CERTIFICATE_TYPE_ID').change(function() {
            if( $(this).val() == 32 || $(this).val() == 36) {
                //$('#textInput').prop( "disabled", true );
                $('#textInput1').prop( "disabled", true );
            } else {
                //$('#textInput').prop( "disabled", false );
                $('#textInput1').prop( "disabled", false );
            }
        });

$(document).on('change', '.CERTIFICATE_TYPE_ID', function () {
    var thisRow = $(this).closest('tr');
    var issuerId = thisRow.find('.CERTIFICATE_TYPE_ID').val();
    var option = '<option value="">Select Issuer</option>';
    var _token = '{{ csrf_token() }}';

    $.ajax({
        type : "post",
        url  : '{{ url('certificate/get-issuer') }}',
        data : {issuerId: issuerId, _token: _token},
        success:function (data) {
            console.log(thisRow);
            var selected = '';
            var issurInfo = data[0];
            var certificate = data[1];

            thisRow.find('.CERTIFICATE_TYPE').val(certificate.CERTIFICATE_TYPE);
            thisRow.find('.IS_EXPIRE').val(certificate.IS_EXPIRE);

            if(certificate.CERTIFICATE_TYPE == 1) {
                thisRow.find('.RENEWING_DATE').prop('required' , true );
            }else{
                thisRow.find('.RENEWING_DATE').prop('required' , false );
            }

           for (var i = 0; i < issurInfo.length; i++){
              var selected = issurInfo[i].LOOKUPCHD_ID == certificate.ISSUR_ID ? 'Selected' : '';
              option = option + '<option value="'+ issurInfo[i].LOOKUPCHD_ID +'"' + selected +' >'+ issurInfo[i].LOOKUPCHD_NAME+'</option>';
           }
           thisRow.find('.issuer').html(option);
        }
    });
});


    </script>
    @include('profile.miller.ajaxUpdateScriptForAllInfo')
    @include('profile.miller.updateMillersId')



    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')


@endsection

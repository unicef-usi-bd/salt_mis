<div id="certificate_tab" class="tab-pane fade ">
    <div class="row">
        <div class="col-md-12">
            {{--<div class="alert alert-info certificate_msg"></div>--}}


            @if(request()->session()->get('MILL_ID'))
            <form action="{{ url('/edit-certificate-info-normal-tem') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
            @else
            <form id="certificateId" action="{{ url('/edit-certificate-info-normal') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
            @endif

               @csrf
                @if(isset($millerInfoId))
                    <input type="hidden" class="MILL_ID" value="{{ $millerInfoId }}" name="MILL_ID">
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
                        <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAddCert"><i class="fa fa-plus"></i></span></th>
                    </tr>
                    </thead>
                    <tbody class="newRowCert">
                    @foreach($editCertificateData as $editCertData)
                        <tr class="rowFirstCert">

                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control CERTIFICATE_TYPE_ID required" id="CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]"  @if($editCertData->CERTIFICATE_TYPE_ID == 5 || $editCertData->CERTIFICATE_TYPE_ID == 10) disabled  @endif>
                                        <option value="">Select</option>
                                        @foreach($certificateId as $row)
                                            {{--<option value="{{ $row->LOOKUPCHD_ID }}" @if($editCertData->CERTIFICATE_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                            <option value="{{ $row->CERTIFICATE_ID }}" @if($editCertData->CERTIFICATE_TYPE_ID==$row->CERTIFICATE_ID) selected @endif>{{ $row->CERTIFICATE_NAME }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                                <input type="hidden" placeholder=" " name="CERTIFICATE_TYPE[]" class="form-control col-xs-10 col-sm-5 CERTIFICATE_TYPE" value="{{ $editCertData->CERTIFICATE_TYPE }}"/>
                                <input type="hidden" class="CERTIFICATE_ID" value="{{ $editCertData->CERTIFICATE_ID }}" name="CERTIFICATE_ID[]">
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    {{--<input type="text"  name="ISSURE_ID[]" class="chosen-container ISSURE_ID" value="{{ $editCertData->ISSURE_ID }}">--}}
                                    <select class="form-control issuer  ISSURE_ID required" id="ISSURE_ID" name="ISSURE_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($issuerId as $row)
                                            <option value="{{ $row->LOOKUPCHD_ID }}" @if($editCertData->ISSURE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                        @endforeach
                                     </select>
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control DISTRICT_ID" id="DISTRICT_ID" name="DISTRICT_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($getDistrict as $row)
                                            <option value="{{ $row->DISTRICT_ID }}" @if($editCertData->DISTRICT_ID==$row->DISTRICT_ID) selected @endif>{{ $row->DISTRICT_NAME }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="date" name="ISSUING_DATE[]" value="{{ $editCertData->ISSUING_DATE }}" class="chosen-container ISSUING_DATE required">
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                            </td>

                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="CERTIFICATE_NO[]" id=" " value="{{ $editCertData->CERTIFICATE_NO }}" class="width-100 CERTIFICATE_NO license required"  />
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                            </td>
                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                    <input type="file" name="user_image[]" class="chosen-container TRADE_LICENSE required" value="" >
                                    <span class="TRADE_LICENSE">{{  $editCertData->TRADE_LICENSE  }}</span>
                                    {{--<span class="TRADE_LICENSE"><a href="{{ url('/'. $editCertData->TRADE_LICENSE ) }}" target="_blank"><img src="{{ url('/'. $editCertData->TRADE_LICENSE ) }}" alt="trade license"  width="20%"></a></span>--}}
                                    <span style="color:red;display:none;" class="error">This field is required</span>

                                </span>
                                <input type="hidden" name="userImage" value="{{ $editCertData->TRADE_LICENSE }}"/>
                            </td>
                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                   <input type="date" id="textInput1" name="RENEWING_DATE[]"  class="chosen-container RENEWING_DATE required" value="{{ $editCertData->RENEWING_DATE }}">
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                                <input type="hidden" value="{{ $editCertData->IS_EXPIRE }}" name="IS_EXPIRE[]">
                            </td>

                            <td>
                                <span class="budget_against_code "><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" id="inputSuccess " value="{{ $editCertData->REMARKS }}" class="width-100 REMARKS" value="{{ $editCertData->RENEWING_DATE }}" />
                                </span>
                            </td>
                            <td>
                                <span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left:40%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        @if(isset($associationId))
                            <button type="submit" class="btn btn-success" >
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Approve
                            </button>
                            <button type="submit" class="btn btn-success" >
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Submit
                            </button>
                        @else

                            {{--<button type="button" class="btn btn-success btnUpdateCertificateTem" onclick="millTab()">--}}
                                {{--<i class="ace-icon fa fa-check bigger-110"></i>--}}
                                {{--Update--}}
                            {{--</button>--}}
                            <button type="submit" class="btn btn-success" >
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Submit
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('masterGlobal.datePicker')
<script>
    $(document).ready(function(){
        $('.rowAddCert').click(function(){
            var getTr = $('tr.rowFirstCert:first');
//            alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRowCert').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            var defaultRow = $('tr.removableRow:last');
            defaultRow.find(' input.MILL_ID').val('');
            defaultRow.find(' select.CERTIFICATE_TYPE_ID').val('');
            defaultRow.find(' select.CERTIFICATE_TYPE_ID').removeAttr("disabled");
            defaultRow.find('select.ISSURE_ID').val('');
            defaultRow.find('select.DISTRICT_ID').val('');
            defaultRow.find('input.CERTIFICATE_ID').val('');

//            For Ignore array Conflict
            defaultRow.find('input.ISSUING_DATE').val('');
            defaultRow.find('input.CERTIFICATE_NO').val('');
            defaultRow.find('span.TRADE_LICENSE').text('');
            defaultRow.find('input.RENEWING_DATE').val('');
            defaultRow.find('input.REMARKS').val('');
            defaultRow.find('span.budget_against_code').text('');
            defaultRow.find('span.errorMsg').text('');
            $('.chosen-select').chosen(0);
        });
    });
    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
//        $(this).closest("tr.removableRow").remove();
        var thisRow = $(this).parents("tr");
        var certificateTypeId = parseInt(thisRow.find('.CERTIFICATE_TYPE_ID').val());
        if(certificateTypeId === 5 || certificateTypeId === 10) return false;
        var certificateId = thisRow.find('.CERTIFICATE_ID').val();
        var actionUrl = '{{ url("single-certificate-delete") }}';
        var token =  "{{ csrf_token() }}";

        $.ajax({
            type : "POST",
            url : actionUrl,
            data : {certificateId: certificateId, _token: token },
            success: function (data) {
                console.log(data);

            }
        });

        $(this).parents("tr").remove();
    });

</script>
<script>
    // $('.certificate_msg').hide();
    // $(document).on('click','.btnUpdateCertificate',function () {
    //     $.ajax({
    //         type : 'POST',
    //         url : 'edit-certificate-info',
    //         data : $('#certificateId').serialize(),
    //         success: function (data) {
    //             console.log(data);
    //             $('.certificate_msg').html('<span>'+ data +'</span>').show();
    //
    //         }
    //     })
    //
    // });

     $(document).on('click','.btnUpdateCertificateTem',function () {
//         alert('hi');
//         var data = $('#certificateId').serialize();
//         console.log(data);
         $.ajax({
             type : 'POST',
             url : 'edit-certificate-info-normal-tem',
             data : $('#certificateId').serialize(),
             success: function (data) {
                 console.log(data);
                 $('.certificate_msg').html('<span>'+ data +'</span>').show();

             }
         })

     });

    //input type text and number validation enable disable button
    $(document).ready(function() {
        $('input[type="text"]').keyup(function () {
            checkValidation($(this))
        });

        $('input[type="file"]').keyup(function () {
            checkValidation($(this))
        });
        $('input[type="date"]').change(function () {
            checkValidation($(this))
        });
    });

    function checkValidation(selector) {
        var thisInput = selector.closest('.block');
        var license = $('.license').val();
        var status = true;
        $('select.required').each(function () {
            if ($(this).val() === "") {
                status = false;
            }
        });

        if (status === true) {
            $('input[type="submit"]').prop('disabled', false);
        } else {
            $('input[type="submit"]').prop('disabled', true);
        }
        if(thisInput.find('.required').val()===""){
            thisInput.find('span.error').show();

        } else{
            thisInput.find('span.error').hide();

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



</script>
<script>
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
<style>
    .input-icon.input-icon-right>input,select.form-control {
        padding-left: 3px;
        padding-right: 0px;
        font-size: small;
    }
</style>
<div id="certificate" class="tab-pane fade ">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info certificate_msg"></div>

            <form id="certtificateId"  class="form-horizontal" role="form" action="{{ url('edit-certificate-info') }}" enctype="multipart/form-data">

                @csrf
                @if(isset($millerInfoId))
                    <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                @endif
                <table class="table table-bordered fundAllocation" style="margin-top: 64px;">
                    <thead>
                    <tr>
                        <th style="width:150px ;">Type of Certificate<span style="color:red;">*</span></th>
                        <th style="width:120px ;">Issure Name<span style="color:red;">*</span></th>
                        <th style="width:120px ;">Issuing Date<span style="color:red;">*</span></th>
                        <th style="width:120px ;">Certificate Number<span style="color:red;">*</span></th>
                        <th style="width: 120px;">Trade License<span style="color:red;">*</span></th>
                        <th style="width:120px;" >Renewing Date<span style="color:red;">*</span></th>
                        <th  style="width:120px ;">Remarks</th>
                        <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd2"><i class="fa fa-plus"></i></span></th>
                    </tr>
                    </thead>
                    <tbody class="newRow2">
                    @foreach($editCertificateData as $editCertData)
                        <tr class="rowFirst2">

                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control CERTIFICATE_TYPE_ID required" id="CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($certificate as $row)
                                            <option value="{{ $row->LOOKUPCHD_ID }}" @if($editCertData->CERTIFICATE_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control ISSURE_ID required" id="ISSURE_ID" name="ISSURE_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($issueBy as $row)
                                            <option value="{{ $row->LOOKUPCHD_ID }}" @if($editCertData->ISSURE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                        @endforeach
                                     </select>
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right ">
                                    <input type="date" name="ISSUING_DATE" value="{{ $editCertData->ISSUING_DATE }}" class="chosen-container ISSUING_DATE required">
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                            </td>

                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right ">
                                    <input type="text" name="CERTIFICATE_NO[]" id="inputSuccess total_amount" value="{{ $editCertData->CERTIFICATE_NO }}" class="width-100 CERTIFICATE_NO required"  />
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                            </td>
                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right required">
                                    <input type="file" name="user_image[]" class="chosen-container TRADE_LICENSE required" >
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                            </td>
                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right ">
                                   <input type="date" name="RENEWING_DATE" class="chosen-container RENEWING_DATE required" value="{{ $editCertData->RENEWING_DATE }}">
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                            </td>

                            <td>
                                <span class="budget_against_code "><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" id="inputSuccess total_amount" value="" class="width-100 REMARKS" value="{{ $editCertData->RENEWING_DATE }}" />
                                </span>
                            </td>
                            <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 44%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary btnUpdateCertificateInfo" onclick="certificateTab()">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Update & Next
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

    // select validation
    // $(document).ready(function() {
    //     $('select.required').on('change', function () {
    //         var status = true;
    //         $('select.required').each(function () {
    //             if ($(this).val() === "") {
    //                 status = false;
    //             }
    //         });
    //         if (status === true) {
    //             $('input[type="button"]').prop('disabled', false);
    //             $('span.error1').hide();
    //         } else {
    //             $('input[type="button"]').prop('disabled', true);
    //             $('span.error1').show();
    //         }
    //     });
    //     // input validation
    //     $('input[type="text"]').keyup(function () {
    //         var status = true;
    //         $('input.required').each(function () {
    //             if ($(this).val() === "") {
    //                 status = false;
    //             }
    //         });
    //         if (status === true) {
    //             $(':input[type="button"]').prop('disabled', false);
    //             $('span.errorLic').hide();
    //         } else {
    //             $(':input[type="button"]').prop('disabled', true);
    //             $('span.errorLic').show();
    //         }
    //     });
    //     $('input[type="date"]').change(function () {
    //         var status = true;
    //         $('input.required').each(function () {
    //             if ($(this).val() === "") {
    //                 status = false;
    //             }
    //         });
    //         if (status === true) {
    //             $(':input[type="button"]').prop('disabled', false);
    //             $('span.errorDat').hide();
    //         } else {
    //             $(':input[type="button"]').prop('disabled', true);
    //             $('span.errorDat').show();
    //         }
    //     });
    // });

    $(document).ready(function() {
        $('input[type="text"]').keyup(function () {
            checkValidation($(this))
        });

        $('input[type="file"]').change(function () {
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
            $('input[type="button"]').prop('disabled', false);
        } else {
            $('input[type="button"]').prop('disabled', true);
        }
        if(thisInput.find('.required').val()===""){
            thisInput.find('span.error').show();

        } else{
            thisInput.find('span.error').hide();

        }
    }

</script>
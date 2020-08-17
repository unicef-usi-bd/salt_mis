<style>
    th, td {
        min-width: 160px;
    }
</style>
<div id="certificate" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/certificate-info/'.$millerInfo->MILL_ID) }}" data-clear="false" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="scroll-div">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Type of Certificate<span style="color:red;"> </span></th>
                            <th>Issuer Name<span style="color:red;"> </span></th>
                            <th>Issuing Date</th>
                            <th>Certificate Number</th>
                            <th>Trade License</th>
                            <th>Renewing Date</th>
                            <th>Remarks</th>
                            <th class="text-center"><span class="btn btn-primary btn-sm rowAddCertificate"><i class="fa fa-plus"></i></span></th>
                        </tr>
                        </thead>
                        <tbody class="certificateTable">
                        @if(sizeof($certificateInfo)>0)
                            @foreach($certificateInfo as $certificate)
                                <tr class="certificateRow">
                                    <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]">
                                        <option value="">Select</option>
                                        @foreach($certificates as $row)
                                            <option @if($row->CERTIFICATE_TYPE==1) style="color: purple;font-weight: bold;" @endif value="{{ $row->LOOKUPCHD_ID }}" @if($certificate->CERTIFICATE_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                        @endforeach
                                    </select>
                                </span>
                                        <input type="hidden" class="certificateId" name="CERTIFICATE_ID[]" value="{{ $certificate->CERTIFICATE_ID }}"/>
                                    </td>
                                    <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select ISSURE_ID" name="ISSURE_ID[]">
                                        <option value="">Select One</option>
                                        @foreach($issueBy as $row)
                                            @if($certificate->CERTIFICATE_TYPE_ID==$row->CERTIFICATE_TYPE_ID)
                                                <option value="{{ $row->ISSUR_ID }}" selected>{{ $row->ISSUER_NAME }}</option>
                                            @endif
                                        @endforeach
                                     </select>
                                </span>
                                    </td>
                                    <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="date" name="ISSUING_DATE[]" value="{{ $certificate->ISSUING_DATE }}" class="chosen-container ISSUING_DATE">
                                </span>
                                    </td>

                                    <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="CERTIFICATE_NO[]" {{--onkeypress="return numbersOnly(this, event)"--}} value="{{ $certificate->CERTIFICATE_NO }}" class="width-100 CERTIFICATE_NO"/>
                                </span>
                                    </td>
                                    <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="file" name="user_image[]" class="chosen-container TRADE_LICENSE">
                                </span>
                                    </td>
                                    <td>
                                <span class="block input-icon input-icon-right">
                                   <input type="date" name="RENEWING_DATE[]" value="{{ $certificate->RENEWING_DATE }}" class="chosen-container RENEWING_DATE">
                                </span>
                                    </td>

                                    <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" id="inputSuccess" value="{{ $certificate->REMARKS }}" class="width-100 REMARKS"/>
                                </span>
                                    </td>
                                    <th class="text-center"><span class="btn btn-danger btn-sm rowRemove"><i class="fa fa-remove"></i></span></th>
                                </tr>
                            @endforeach
                        @else
                            <tr class="certificateRow">
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]">
                                        <option value="">Select</option>
                                        @foreach($certificates as $row)
                                            <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                        @endforeach
                                    </select>
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select ISSURE_ID" name="ISSURE_ID[]">
                                        <option value="">Select</option>
                                        {{--@foreach($issueBy as $row)--}}
                                        {{--<option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                        {{--@endforeach--}}
                                     </select>
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="date" name="ISSUING_DATE" class="chosen-container ISSUING_DATE">
                                </span>
                                </td>

                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="CERTIFICATE_NO[]" onkeypress="return numbersOnly(this, event)" value="" class="width-100 CERTIFICATE_NO"/>
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="file" name="user_image[]" class="chosen-container TRADE_LICENSE">
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                   <input type="date" name="RENEWING_DATE" class="chosen-container RENEWING_DATE">
                                </span>
                                </td>

                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" id="inputSuccess" value="" class="width-100 REMARKS"/>
                                </span>
                                </td>
                                <td class="text-center"><span class="btn btn-danger btn-sm rowRemove"><i class="fa fa-remove"></i></span></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="clearfix">
                    <div class="col-md-12 center">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary" onclick="formSubmitWithValidation(this.form)">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{--{{ trans('dashboard.submit') }}--}} Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    function validation() {
        let scope, certificateId, renewDate, message, status = true;
        let certificateName = null;
        $(".certificateTable tr").each(function () {
            scope = $(this);
            certificateId = parseInt(scope.find('.CERTIFICATE_TYPE_ID').val() || 0);
            if (certificateId !== 32 && certificateId !== 36) {
                certificateName = scope.find('.CERTIFICATE_TYPE_ID').find(":selected").text();
                renewDate = scope.find('.RENEWING_DATE').val();
                if (certificateId !== 0 && renewDate === '') {
                    message = `${certificateName} Renewing date must be required`;
                    displayAlertHandler(message, 'danger');
                    status = false;
                }
            }
        });
        return status;
    }

    function formSubmitWithValidation(from_data) {
        let checkValidation = validation();
        if (checkValidation) formSubmit(from_data);
    }


    $(document).ready(function () {
        $('.rowAddCertificate').click(function () {
            let getTr = $('tr.certificateRow:first');
//            alert(getTr.html());
            let thisYear = new Date().getFullYear();
            $("select.chosen-select").chosen('destroy');
            $('tbody.certificateTable').append("<tr class='removableRow'>" + getTr.html() + "</tr>");
            let defaultRow = $('tr.removableRow:last');
//            For Ignore array Conflict
            defaultRow.find('input.ISSUING_DATE').val('');
            defaultRow.find('input.certificateId').val('');
            defaultRow.find('input.CERTIFICATE_NO').val('');
            defaultRow.find('input.TRADE_LICENSE').val('');
            defaultRow.find('input.RENEWING_DATE').val(`${thisYear}-06-30`);
            defaultRow.find('input.REMARKS').val('');
            defaultRow.find('.chosen-select').val('').trigger('chosen:updated');
            defaultRow.find('.ISSURE_ID').html('<option value="0">Select</option>').trigger('chosen:updated');
        });
    });

    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        $(this).closest("tr.removableRow").remove();
    });

    //    Check Duplicate Certificates
    $(document).on('change', '.CERTIFICATE_TYPE_ID', function () {
        let certificateId = $(this).val();
        let duplicates = hasDuplicateCertificate(certificateId);
        if (duplicates) {
            let certificateName = $(this).find(":selected").text();
            let message = `${certificateName} certificate already exist.`;
            displayAlertHandler(message, 'danger');
            $(this).val('').trigger('chosen:updated');
        }
    });

    const hasDuplicateCertificate = (certificateId) => {
        let count = 0;
        let eachCertificateId;
        $('.certificateTable tr').each(function () {
            eachCertificateId = $(this).find('.CERTIFICATE_TYPE_ID').val();
            if (eachCertificateId === certificateId) count++;
            if (count === 2) return;
        });
        return count > 1;
    }

</script>

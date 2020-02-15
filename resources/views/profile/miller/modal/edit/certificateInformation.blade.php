<div id="certificate" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/certificate-info/'.$millerInfo->MILL_ID) }}" data-clear="false" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                            <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAddCertificate"><i class="fa fa-plus"></i></span></th>
                        </tr>
                    </thead>
                    <tbody class="certificateTable">
                    @if(sizeof($certificateInfo)>0)
                        @foreach($certificateInfo as $certificate)
                        <tr class="certificateRow">
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($certificates as $row)
                                            <option value="{{ $row->LOOKUPCHD_ID }}" @if($certificate->CERTIFICATE_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                        @endforeach
                                    </select>
                                </span>
                                <input type="hidden" class="certificateId" name="CERTIFICATE_ID[]" value="{{ $certificate->CERTIFICATE_ID }}"/>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select ISSURE_ID" name="ISSURE_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($issueBy as $row)
                                            <option value="{{ $row->LOOKUPCHD_ID }}" @if($certificate->ISSURE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                        @endforeach
                                     </select>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="date" name="ISSUING_DATE" value="{{ $certificate->ISSUING_DATE }}" class="chosen-container ISSUING_DATE">
                                </span>
                            </td>

                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="CERTIFICATE_NO[]" value="{{ $certificate->CERTIFICATE_NO }}" class="width-100 CERTIFICATE_NO" />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="file" name="user_image[]" class="chosen-container TRADE_LICENSE" >
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                   <input type="date" name="RENEWING_DATE" value="{{ $certificate->RENEWING_DATE }}" class="chosen-container RENEWING_DATE">
                                </span>
                            </td>

                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" id="inputSuccess" value="{{ $certificate->REMARKS }}" class="width-100 REMARKS"  />
                                </span>
                            </td>
                            <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="certificateRow">
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($certificate as $row)
                                            <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select ISSURE_ID" name="ISSURE_ID[]"  >
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
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="CERTIFICATE_NO[]" value="" class="width-100 CERTIFICATE_NO"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="file" name="user_image[]" class="chosen-container TRADE_LICENSE" >
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                   <input type="date" name="RENEWING_DATE" class="chosen-container RENEWING_DATE">
                                </span>
                            </td>

                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" id="inputSuccess total_amount" value="" class="width-100 REMARKS"  />
                                </span>
                            </td>
                            <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 35%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
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
        $('.rowAddCertificate').click(function(){
            let getTr = $('tr.certificateRow:first');
//            alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.certificateTable').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            let defaultRow = $('tr.removableRow:last');
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
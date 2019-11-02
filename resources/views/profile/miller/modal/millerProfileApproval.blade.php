<style>
    table.borderless td,table.borderless th{
        border: none !important;
    }
</style>
<div class="col-md-12">
    <form action="{{ url('/miller-profile-approval/'.$id) }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
        @csrf
        @method('PUT')

        <div class="error-container">
        <h4 class="center text-success">Mill Information </h4>
        {{--<h4 class="center text-success">{{ trans('dashboard.details') }} </h4>--}}
        <div class="row table-responsive">
            <div class="col-md-6">
                <h4 class="center text-success" style="color: green;">Previous Mill Information </h4>
                <input type="hidden" name="MILL_ID" value="{{ $previousMillerData->MILL_ID }}">
                <table class="table borderless">
                    <tr>
                        <th class=" ">Name of Mill</th>
                        <th> :</th>
                        <td> {{ $previousMillerData->MILL_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Process Type</th>
                        <th> :</th>
                        <td> {{ $previousMillerData->process_name }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Mill Type</th>
                        <th> :</th>
                        <td> {{ $previousMillerData->mill_name }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Capacity</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->CAPACITY_ID }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Division Name</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->DIVISION_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">District Name</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->DISTRICT_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Upazila Name</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->UPAZILA_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Zone</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->ZONE_NAME }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Millers ID</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->MILLERS_ID }}</td>

                    </tr>
                    <tr>
                        <th class=" ">Active Status</th>
                        <th> :</th>
                        <td>
                            <?php  if($previousMillerData->ACTIVE_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td> {{ $previousMillerData->REMARKS }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <h4 class="center text-success" style="color: red;">Change Mill Information </h4>
                <input type="hidden" name="MILL_ID_TEM" value="{{ $presentMillerData->MILL_ID_TEM }}">
                <table class="table borderless">
                    <tr>
                        <th class=" ">Name of Mill</th>
                        <th> :</th>
                        <td> {{ $presentMillerData->MILL_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Process Type</th>
                        <th> :</th>
                        <td> {{ $presentMillerData->process_name }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Mill Type</th>
                        <th> :</th>
                        <td> {{ $presentMillerData->mill_name }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Capacity</th>
                        <th> :</th>
                        <td>{{ $presentMillerData->CAPACITY_ID }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Division Name</th>
                        <th> :</th>
                        <td>{{ $presentMillerData->DIVISION_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">District Name</th>
                        <th> :</th>
                        <td>{{ $presentMillerData->DISTRICT_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Upazila Name</th>
                        <th> :</th>
                        <td>{{ $presentMillerData->UPAZILA_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Zone</th>
                        <th> :</th>
                        <td>{{ $presentMillerData->ZONE_NAME }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Millers ID</th>
                        <th> :</th>
                        <td>{{ $presentMillerData->MILLERS_ID }}</td>

                    </tr>
                    <tr>
                        <th class=" ">Active Status</th>
                        <th> :</th>
                        <td>
                            <?php  if($presentMillerData->ACTIVE_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td> {{ $presentMillerData->REMARKS }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <h4 class="center text-success">Entrepreneur Information Details</h4>
        <div class="row">
            <div class="col-md-12">
                <h4 class="center text-success" style="color: green;">Previous Entrepreneur Information </h4>
                <table id="simple-table" class="table  table-bordered">
                    <tr>
                        <th class=" ">Owner Name</th>
                        <th class=" ">NID</th>
                        <th class=" ">Division Name</th>
                        <th class=" ">District Name</th>
                        <th class=" ">Upazila Name</th>
                        <th class=" ">Mobile 1</th>
                        <th class=" ">Mobile 2</th>
                        <th class=" ">Email </th>
                        <th class=" ">Remarks</th>
                    </tr>
                    @foreach($previousEnterpreneurData as $row)
                        <input type="hidden" name="ENTREPRENEUR_ID[]" value="{{ $row->ENTREPRENEUR_ID }}">
                        <tr>
                            <td> {{ $row->OWNER_NAME }}</td>
                            <td>{{ $row->NID }} </td>
                            <td>{{ $row->DIVISION_NAME }} </td>
                            <td>{{ $row->DISTRICT_NAME }} </td>
                            <td>{{ $row->UPAZILA_NAME }} </td>
                            <td>{{ $row->MOBILE_1 }}</td>
                            <td>{{ $row->MOBILE_2 }}</td>
                            <td> {{ $row->EMAIL }}</td>
                            <td> {{ $row->REMARKS }}</td>
                        </tr>
                    @endforeach

                </table>
            </div>

            <div class="col-md-12">
                <h4 class="center text-success" style="color: red;">Change Entrepreneur Information </h4>
                <table class="table table-bordered">
                    <tr>
                        <th class=" ">Owner Name</th>
                        <th class=" ">NID</th>
                        <th class=" ">Division Name</th>
                        <th class=" ">District Name</th>
                        <th class=" ">Upazila Name</th>
                        <th class=" ">Mobile 1</th>
                        <th class=" ">Mobile 2</th>
                        <th class=" ">Email </th>
                        <th class=" ">Remarks</th>
                    </tr>
                    @foreach($presentEnterpreneurData as $row)
                        <tr>
                            <input type="hidden" name="ENTREPRENEUR_ID_TEM[]" value="{{ $row->ENTREPRENEUR_ID_TEM }}">
                            <input type="hidden" name="TEM_ENTREPRENEUR_ID[]" value="{{ $row->ENTREPRENEUR_ID }}">
                            <input type="hidden" name="TEM_MILL_ID[]" value="{{ $row->MILL_ID }}">
                            <td> {{ $row->OWNER_NAME }}</td>
                            <td>{{ $row->NID }} </td>
                            <td>{{ $row->DIVISION_NAME }} </td>
                            <td>{{ $row->DISTRICT_NAME }} </td>
                            <td>{{ $row->UPAZILA_NAME }} </td>
                            <td>{{ $row->MOBILE_1 }}</td>
                            <td>{{ $row->MOBILE_2 }}</td>
                            <td> {{ $row->EMAIL }}</td>
                            <td> {{ $row->REMARKS }}</td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>

        <h4 class="center text-success">Certificate Information </h4>
        <div class="row table-responsive">
            <div class="col-md-12">
                <h4 class="center text-success" style="color: green;">Previous Certificate Information </h4>
                <table class="table table-bordered">
                    <tr>
                        <th class=" ">Type of Certificate </th>
                        <th class=" ">Issure Name</th>
                        <th class=" ">Issuing Date</th>
                        <th class=" ">Certificate Number</th>
                        <th class=" ">Trade License </th>
                        <th class=" ">Renewing Date</th>
                        <th class=" ">Remarks</th>
                    </tr>
                    @foreach($previousCertificaterData as $row)
                        <input type="hidden" name="CERTIFICATE_ID[]" value="{{ $row->CERTIFICATE_ID }}">
                    <tr>
                        <td> {{ $row->CERTIFICATE_NAME }} </td>
                        <td> {{ $row->issuer_name }} </td>
                        <td> {{ $row->ISSUING_DATE }}</td>
                        <td>{{ $row->CERTIFICATE_NO }} </td>
                        <td><a href="{{ url('/'. $row->TRADE_LICENSE ) }}" target="_blank">File</a>  </td>
                        <td>{{ $row->RENEWING_DATE }} </td>
                        <td>{{ $row->REMARKS }} </td>
                    </tr>
                    @endforeach

                </table>
            </div>

            <div class="col-md-12">
                <h4 class="center text-success" style="color: red;">Change Certificate Information </h4>
                <table class="table table-bordered">
                    <tr>
                        <th class=" ">Type of Certificate </th>
                        <th class=" ">Issure Name</th>
                        <th class=" ">Issuing Date</th>
                        <th class=" ">Certificate Number</th>
                        <th class=" ">Trade License </th>
                        <th class=" ">Renewing Date</th>
                        <th class=" ">Remarks</th>
                    </tr>
                    @foreach($presentCertificaterData as $row)
                        <input type="hidden" name="CERTIFICATE_ID_TEM[]" value="{{ $row->CERTIFICATE_ID_TEM }}">
                        <input type="hidden" name="TEM_CERTIFICATE_ID[]" value="{{ $row->CERTIFICATE_ID }}">
                    <tr>
                        <td> {{ $row->CERTIFICATE_NAME }} </td>
                        <td> {{ $row->issuer_name }} </td>
                        <td> {{ $row->ISSUING_DATE }}</td>
                        <td>{{ $row->CERTIFICATE_NO }} </td>
                        <td><a href="{{ url('/'. $row->TRADE_LICENSE ) }}" target="_blank">File</a>  </td>
                        <td>{{ $row->RENEWING_DATE }} </td>
                        <td>{{ $row->REMARKS }} </td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>

        <h4 class="center text-success">QC Information </h4>
        <div class="row table-responsive">
            <div class="col-md-6">
                <input type="hidden" name="QCINFO_ID" value="{{ $previousQcData->QCINFO_ID }}">
                <h4 class="center text-success" style="color: green;">Previous QC Information </h4>
                <table class="table borderless">
                    <tr>
                        <th class=" ">laboratory </th>
                        <th> :</th>
                        <td>
                            <?php  if($previousQcData->LABORATORY_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Standard Operation Procedure (SOP)</th>
                        <th> :</th>
                        <td> {{ $previousQcData->SOP_DESC }} </td>
                    </tr>
                    <tr>
                        <th class=" ">If Iodine content check during production</th>
                        <th> :</th>
                        <td>
                            <?php  if($previousQcData->IODINE_CHECK_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Monitoring Test Kit</th>
                        <th> :</th>
                        <td>
                            <?php  if($previousQcData->MONITORING_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Do you have a laboratory Man</th>
                        <th> :</th>
                        <td>
                            <?php  if($previousQcData->LAB_MAN_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">No of Laboratory Man</th>
                        <th> :</th>
                        <td>{{ $previousQcData->LAB_PERSON }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td>{{ $previousQcData->REMARKS }}</td>

                    </tr>

                </table>
            </div>

            <div class="col-md-6">

                <input type="hidden" name="QCINFO_ID_TEM" value="{{ $presentQcData->QCINFO_ID_TEM }}">
                <h4 class="center text-success" style="color: red;">Change QC Information </h4>
                <table class="table borderless">
                    <tr>
                        <th class=" ">laboratory </th>
                        <th> :</th>
                        <td>
                            <?php  if($presentQcData->LABORATORY_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Standard Operation Procedure (SOP)</th>
                        <th> :</th>
                        <td> {{ $presentQcData->SOP_DESC }} </td>
                    </tr>
                    <tr>
                        <th class=" ">If Iodine content check during production</th>
                        <th> :</th>
                        <td>
                            <?php  if($presentQcData->IODINE_CHECK_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Monitoring Test Kit</th>
                        <th> :</th>
                        <td>
                            <?php  if($presentQcData->MONITORING_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Do you have a laboratory Man</th>
                        <th> :</th>
                        <td>
                            <?php  if($presentQcData->LAB_MAN_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">No of Laboratory Man</th>
                        <th> :</th>
                        <td>{{ $presentQcData->LAB_PERSON }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td>{{ $presentQcData->REMARKS }}</td>

                    </tr>

                </table>
            </div>
        </div>

        <h4 class="center text-success">Employee Information </h4>
        <div class="row table-responsive">
            <div class="col-md-6">
                <input type="hidden" name="MILLEMP_ID" value="{{ $previousEmployeeData->MILLEMP_ID }}">
                <h4 class="center text-success" style="color: red;">Change Employee Information </h4>
                <table class="table borderless">
                    <tr>
                        <th class=" ">Total Male Employee </th>
                        <th> :</th>
                        <td> {{ $previousEmployeeData->TOTMALE_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Total Female Employee</th>
                        <th> :</th>
                        <td> {{ $previousEmployeeData->TOTFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Full Time Male Employee</th>
                        <th> :</th>
                        <td> {{ $previousEmployeeData->FULLTIMEMALE_EMP }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Full Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->FULLTIMEFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Part Time Male Employee</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->PARTTIMEMALE_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Part Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->PARTTIMEFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Technical Male Employee</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->TOTMALETECH_PER }} </td>
                    </tr>
                    <tr>
                        <th class=" "> Technical Female Employee</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->TOTFEMTECH_PER }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->REMARKS }} </td>

                    </tr>

                </table>
            </div>

            <div class="col-md-6">
                <input type="hidden" name="MILLEMP_ID_TEM" value="{{ $presentEmployeeData->MILLEMP_ID_TEM }}">
                <h4 class="center text-success" style="color: green;">Previous Employee Information </h4>
                <table class="table borderless">
                    <tr>
                        <th class=" ">Total Male Employee </th>
                        <th> :</th>
                        <td> {{ $presentEmployeeData->TOTMALE_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Total Female Employee</th>
                        <th> :</th>
                        <td> {{ $presentEmployeeData->TOTFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Full Time Male Employee</th>
                        <th> :</th>
                        <td> {{ $presentEmployeeData->FULLTIMEMALE_EMP }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Full Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $presentEmployeeData->FULLTIMEFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Part Time Male Employee</th>
                        <th> :</th>
                        <td>{{ $presentEmployeeData->PARTTIMEMALE_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Part Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $presentEmployeeData->PARTTIMEFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Technical Male Employee</th>
                        <th> :</th>
                        <td>{{ $presentEmployeeData->TOTMALETECH_PER }} </td>
                    </tr>
                    <tr>
                        <th class=" "> Technical Female Employee</th>
                        <th> :</th>
                        <td>{{ $presentEmployeeData->TOTFEMTECH_PER }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td>{{ $presentEmployeeData->REMARKS }} </td>

                    </tr>

                </table>
            </div>
        </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Remarks</b></label>
                    <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               {{--<input type="text" name="REMARKS" class="chosen-container">--}}
                                <textarea rows="3" class="form-control col-sm-8" name="REMARKS"></textarea>
                            </span>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{--{{ trans('dashboard.submit') }}--}}
                    Approve
                </button>
            </div>

        <div class="space"></div>
    </div>
    </form>
</div>
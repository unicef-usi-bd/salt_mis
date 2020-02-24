<style>
    table.border-none td,table.border-none th{
        border: none !important;
    }
</style>
<div class="col-md-12">
    <form action="{{ url('/miller-profile-approval/'.$id) }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
        @csrf
        @method('PUT')
        <div class="error-container">
        <h4 class="well center">Miller profile approval </h4>
        <div class="row table-responsive">
            <div class="col-md-6">
                <h4 class="center text-primary" style="color: green;">Current Mill Information </h4>
                @if($currentMillInfo)
                <input type="hidden" name="MILL_ID" value="{{ $currentMillInfo->MILL_ID }}">
                <table class="table border-none">
                    <tr>
                        <th class=" ">Name of Mill</th>
                        <th> :</th>
                        <td> {{ $currentMillInfo->MILL_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Mill Logo</th>
                        <th> :</th>
                        <td> <img id="output"  style="width: 50px;height: 50px;" src="{{ asset('/'.$currentMillInfo->mill_logo) }}" /> </td>
                    </tr>
                    <tr>
                        <th class=" ">Process Type</th>
                        <th> :</th>
                        <td> {{ $currentMillInfo->process_name }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Mill Type</th>
                        <th> :</th>
                        <td> {{ $currentMillInfo->mill_name }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Capacity</th>
                        <th> :</th>
                        <td>{{ $currentMillInfo->CAPACITY_ID }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Division Name</th>
                        <th> :</th>
                        <td>{{ $currentMillInfo->DIVISION_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">District Name</th>
                        <th> :</th>
                        <td>{{ $currentMillInfo->DISTRICT_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Upazila Name</th>
                        <th> :</th>
                        <td>{{ $currentMillInfo->UPAZILA_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Zone</th>
                        <th> :</th>
                        <td>{{ $currentMillInfo->ZONE_NAME }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Millers ID</th>
                        <th> :</th>
                        <td>{{ $currentMillInfo->MILLERS_ID }}</td>

                    </tr>
                    <tr>
                        <th class=" ">Active Status</th>
                        <th> :</th>
                        <td>
                            <?php  if($currentMillInfo->ACTIVE_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td> {{ $currentMillInfo->REMARKS }}</td>
                    </tr>
                </table>
                    @else
                    <h3 style="text-align: center;color: red;">No Data Found</h3>
                    @endif
            </div>

            <div class="col-md-6">
                <h4 class="center text-success" style="color: red;">Update Mill Information </h4>
                @if($updateMillInfo)
                <input type="hidden" name="MILL_ID_TEM" value="{{ $updateMillInfo->MILL_ID_TEM }}">
                <table class="table border-none">
                    <tr>
                        <th class=" ">Name of Mill</th>
                        <th> :</th>
                        <td> {{ $updateMillInfo->MILL_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Mill Logo</th>
                        <th> :</th>
                        <td> <img id="output"  style="width: 50px;height: 50px;" src="{{ asset('/'.$updateMillInfo->mill_logo) }}" /></td>
                    </tr>
                    <tr>
                        <th class=" ">Process Type</th>
                        <th> :</th>
                        <td> {{ $updateMillInfo->process_name }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Mill Type</th>
                        <th> :</th>
                        <td> {{ $updateMillInfo->mill_name }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Capacity</th>
                        <th> :</th>
                        <td>{{ $updateMillInfo->CAPACITY_ID }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Division Name</th>
                        <th> :</th>
                        <td>{{ $updateMillInfo->DIVISION_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">District Name</th>
                        <th> :</th>
                        <td>{{ $updateMillInfo->DISTRICT_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Upazila Name</th>
                        <th> :</th>
                        <td>{{ $updateMillInfo->UPAZILA_NAME }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Zone</th>
                        <th> :</th>
                        <td>{{ $updateMillInfo->ZONE_NAME }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Millers ID</th>
                        <th> :</th>
                        <td>{{ $updateMillInfo->MILLERS_ID }}</td>

                    </tr>
                    <tr>
                        <th class=" ">Active Status</th>
                        <th> :</th>
                        <td>
                            <?php  if($updateMillInfo->ACTIVE_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td> {{ $updateMillInfo->REMARKS }}</td>
                    </tr>
                </table>
                    @else
                    <h4 style="text-align: center;color: red;">No Data Found</h4>
                    @endif
            </div>
        </div>

        <h4 class="center text-success">Entrepreneur Information</h4>
        <div class="row">
            <div class="col-md-12">
                <h4 class="center text-success" style="color: green;">Current Information </h4>
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
                    @if($currentEntrepreneurs)
                    @foreach($currentEntrepreneurs as $currentEntrepreneur)
                        <input type="hidden" name="ENTREPRENEUR_ID[]" value="{{ $currentEntrepreneur->ENTREPRENEUR_ID }}">
                        <tr>
                            <td> {{ $currentEntrepreneur->OWNER_NAME }}</td>
                            <td>{{ $currentEntrepreneur->NID }} </td>
                            <td>{{ $currentEntrepreneur->DIVISION_NAME }} </td>
                            <td>{{ $currentEntrepreneur->DISTRICT_NAME }} </td>
                            <td>{{ $currentEntrepreneur->UPAZILA_NAME }} </td>
                            <td>{{ $currentEntrepreneur->MOBILE_1 }}</td>
                            <td>{{ $currentEntrepreneur->MOBILE_2 }}</td>
                            <td> {{ $currentEntrepreneur->EMAIL }}</td>
                            <td> {{ $currentEntrepreneur->REMARKS }}</td>
                        </tr>
                    @endforeach
                        @else
                        <tr>
                            <td style="text-align: center;color: red;">No Data Found</td>
                        </tr>
                    @endif
                </table>
            </div>

            <div class="col-md-12">
                <h4 class="center text-success" style="color: red;">Update Information </h4>
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
                    @if($updateEntrepreneurs)
                    @foreach($updateEntrepreneurs as $updateEntrepreneur)
                        <tr>
                            <input type="hidden" name="ENTREPRENEUR_ID_TEM[]" value="{{ $updateEntrepreneur->ENTREPRENEUR_ID_TEM }}">
                            <input type="hidden" name="TEM_ENTREPRENEUR_ID[]" value="{{ $updateEntrepreneur->ENTREPRENEUR_ID }}">
                            <input type="hidden" name="TEM_MILL_ID[]" value="{{ $updateEntrepreneur->MILL_ID }}">
                            <td> {{ $updateEntrepreneur->OWNER_NAME }}</td>
                            <td>{{ $updateEntrepreneur->NID }} </td>
                            <td>{{ $updateEntrepreneur->DIVISION_NAME }} </td>
                            <td>{{ $updateEntrepreneur->DISTRICT_NAME }} </td>
                            <td>{{ $updateEntrepreneur->UPAZILA_NAME }} </td>
                            <td>{{ $updateEntrepreneur->MOBILE_1 }}</td>
                            <td>{{ $updateEntrepreneur->MOBILE_2 }}</td>
                            <td> {{ $updateEntrepreneur->EMAIL }}</td>
                            <td> {{ $updateEntrepreneur->REMARKS }}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td style="text-align: center;color: red;">No Data Found</td>
                        </tr>
                    @endif
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
                        <th class=" ">Issuer Name</th>
                        <th class=" ">Issuing Date</th>
                        <th class=" ">Certificate Number</th>
                        <th class=" ">Trade License </th>
                        <th class=" ">Renewing Date</th>
                        <th class=" ">Remarks</th>
                    </tr>
                    @if($presentCertificates)
                    @foreach($presentCertificates as $presentCertificate)
                        <input type="hidden" name="CERTIFICATE_ID[]" value="{{ $presentCertificate->CERTIFICATE_ID }}">
                    <tr>
                        <td> {{ $presentCertificate->CERTIFICATE_NAME }} </td>
                        <td> {{ $presentCertificate->issuer_name }} </td>
                        <td> {{ $presentCertificate->ISSUING_DATE }}</td>
                        <td>{{ $presentCertificate->CERTIFICATE_NO }} </td>
                        <td><a href="{{ url('/'. $presentCertificate->TRADE_LICENSE ) }}" target="_blank">File</a>  </td>
                        <td>{{ $presentCertificate->RENEWING_DATE }} </td>
                        <td>{{ $presentCertificate->REMARKS }} </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td style="text-align: center;color: red;">No Data Found</td>
                        </tr>
                    @endif
                </table>
            </div>

            <div class="col-md-12">
                <h4 class="center text-success" style="color: red;">Change Certificate Information </h4>
                <table class="table table-bordered">
                    <tr>
                        <th class=" ">Type of Certificate </th>
                        <th class=" ">Issuer Name</th>
                        <th class=" ">Issuing Date</th>
                        <th class=" ">Certificate Number</th>
                        <th class=" ">Trade License </th>
                        <th class=" ">Renewing Date</th>
                        <th class=" ">Remarks</th>
                    </tr>
                    @if($updateCertificates)
                    @foreach($updateCertificates as $updateCertificate)
                        <input type="hidden" name="CERTIFICATE_ID_TEM[]" value="{{ $updateCertificate->CERTIFICATE_ID_TEM }}">
                        <input type="hidden" name="TEM_CERTIFICATE_ID[]" value="{{ $updateCertificate->CERTIFICATE_ID }}">
                    <tr>
                        <td> {{ $updateCertificate->CERTIFICATE_NAME }} </td>
                        <td> {{ $updateCertificate->issuer_name }} </td>
                        <td> {{ $updateCertificate->ISSUING_DATE }}</td>
                        <td>{{ $updateCertificate->CERTIFICATE_NO }} </td>
                        <td><a href="{{ url('/'. $updateCertificate->TRADE_LICENSE ) }}" target="_blank">File</a>  </td>
                        <td>{{ $updateCertificate->RENEWING_DATE }} </td>
                        <td>{{ $updateCertificate->REMARKS }} </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td style="text-align: center;color: red;">No Data Found</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        <h4 class="center text-success">QC Information </h4>
        <div class="row table-responsive">
            <div class="col-md-6">
                <h4 class="center text-success" style="color: green;">Previous QC Information </h4>
                @if($currentQcInfo)
                    <input type="hidden" name="QCINFO_ID" value="{{ $currentQcInfo->QCINFO_ID }}">
                <table class="table border-none">
                    <tr>
                        <th class=" ">laboratory </th>
                        <th> :</th>
                        <td>
                            <?php  if($currentQcInfo->LABORATORY_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Standard Operation Procedure (SOP)</th>
                        <th> :</th>
                        <td> {{ $currentQcInfo->SOP_DESC }} </td>
                    </tr>
                    <tr>
                        <th class=" ">If Iodine content check during production</th>
                        <th> :</th>
                        <td>
                            <?php  if($currentQcInfo->IODINE_CHECK_FLG == 0){ ?>
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
                            <?php  if($currentQcInfo->MONITORING_FLG == 0){ ?>
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
                            <?php  if($currentQcInfo->LAB_MAN_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">No of Laboratory Man</th>
                        <th> :</th>
                        <td>{{ $currentQcInfo->LAB_PERSON }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td>{{ $currentQcInfo->REMARKS }}</td>

                    </tr>

                </table>
                @else

                    <h3 style="text-align: center;color: red;">No Data Found</h3>
                @endif
            </div>

            <div class="col-md-6">

                <h4 class="center text-success" style="color: red;">Change QC Information </h4>
                @if($updateQcInfo)
                <input type="hidden" name="QCINFO_ID_TEM" value="{{ $updateQcInfo->QCINFO_ID_TEM }}">
                <table class="table border-none">
                    <tr>
                        <th class=" ">laboratory </th>
                        <th> :</th>
                        <td>
                            <?php  if($updateQcInfo->LABORATORY_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">Standard Operation Procedure (SOP)</th>
                        <th> :</th>
                        <td> {{ $updateQcInfo->SOP_DESC }} </td>
                    </tr>
                    <tr>
                        <th class=" ">If Iodine content check during production</th>
                        <th> :</th>
                        <td>
                            <?php  if($updateQcInfo->IODINE_CHECK_FLG == 0){ ?>
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
                            <?php  if($updateQcInfo->MONITORING_FLG == 0){ ?>
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
                            <?php  if($updateQcInfo->LAB_MAN_FLG == 0){ ?>
                            <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                            <?php }else{ ?>
                            <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class=" ">No of Laboratory Man</th>
                        <th> :</th>
                        <td>{{ $updateQcInfo->LAB_PERSON }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td>{{ $updateQcInfo->REMARKS }}</td>

                    </tr>

                </table>
                @else
                    <h3 style="text-align: center;color: red;">No Data Found</h3>
                @endif
            </div>
        </div>

        <h4 class="center text-success">Employee Information </h4>
        <div class="row table-responsive">
            <div class="col-md-6">
                <h4 class="center text-success" style="color: red;">Previous Employee Information </h4>
                @if($currentEmployees)
                <input type="hidden" name="MILLEMP_ID" value="{{ $currentEmployees->MILLEMP_ID }}">
                <table class="table border-none">
                    <tr>
                        <th class=" ">Total Male Employee </th>
                        <th> :</th>
                        <td> {{ $currentEmployees->TOTMALE_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Total Female Employee</th>
                        <th> :</th>
                        <td> {{ $currentEmployees->TOTFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Full Time Male Employee</th>
                        <th> :</th>
                        <td> {{ $currentEmployees->FULLTIMEMALE_EMP }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Full Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $currentEmployees->FULLTIMEFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Part Time Male Employee</th>
                        <th> :</th>
                        <td>{{ $currentEmployees->PARTTIMEMALE_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Part Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $currentEmployees->PARTTIMEFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Technical Male Employee</th>
                        <th> :</th>
                        <td>{{ $currentEmployees->TOTMALETECH_PER }} </td>
                    </tr>
                    <tr>
                        <th class=" "> Technical Female Employee</th>
                        <th> :</th>
                        <td>{{ $currentEmployees->TOTFEMTECH_PER }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td>{{ $currentEmployees->REMARKS }} </td>

                    </tr>

                </table>
                @else
                    <h3 style="text-align: center;color: red;">No Data Found</h3>
                @endif
            </div>

            <div class="col-md-6">
                <h4 class="center text-success" style="color: green;">Change Employee Information </h4>
                @if($updateEmployees)
                <input type="hidden" name="MILLEMP_ID_TEM" value="{{ $updateEmployees->MILLEMP_ID_TEM }}">
                <table class="table border-none">
                    <tr>
                        <th class=" ">Total Male Employee </th>
                        <th> :</th>
                        <td> {{ $updateEmployees->TOTMALE_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Total Female Employee</th>
                        <th> :</th>
                        <td> {{ $updateEmployees->TOTFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Full Time Male Employee</th>
                        <th> :</th>
                        <td> {{ $updateEmployees->FULLTIMEMALE_EMP }}</td>
                    </tr>
                    <tr>
                        <th class=" ">Full Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $updateEmployees->FULLTIMEFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Part Time Male Employee</th>
                        <th> :</th>
                        <td>{{ $updateEmployees->PARTTIMEMALE_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Part Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $updateEmployees->PARTTIMEFEM_EMP }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Technical Male Employee</th>
                        <th> :</th>
                        <td>{{ $updateEmployees->TOTMALETECH_PER }} </td>
                    </tr>
                    <tr>
                        <th class=" "> Technical Female Employee</th>
                        <th> :</th>
                        <td>{{ $updateEmployees->TOTFEMTECH_PER }} </td>
                    </tr>
                    <tr>
                        <th class=" ">Remarks</th>
                        <th> :</th>
                        <td>{{ $updateEmployees->REMARKS }} </td>

                    </tr>

                </table>
                @else
                    <h3 style="text-align: center;color: red;">No Data Found</h3>
                @endif
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
                <button type="button" onclick="formSubmit(this.form)" class="btn btn-success"><i class="ace-icon fa fa-check bigger-110"></i>Approve</button>
            </div>

            <div class="space"></div>
        </div>
    </form>
</div>
@include('masterGlobal.ajaxFormSubmit')
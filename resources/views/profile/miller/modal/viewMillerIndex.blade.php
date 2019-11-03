<style>
    table.borderless td,table.borderless th{
        border: none !important;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
        <h4 class="center text-success">Mill Information </h4>
        {{--<h4 class="center text-success">{{ trans('dashboard.details') }} </h4>--}}
        <div class="row table-responsive">
            @if($previousMillerData)
                <table class="table borderless">
                    <tr>
                        <th class=" ">Name of Mill</th>
                        <th> :</th>
                        <td> {{ $previousMillerData->MILL_NAME }} </td>
                        <th class=" ">Process Type</th>
                        <th> :</th>
                        <td> {{ $previousMillerData->process_name }} </td>
                    </tr>

                    <tr>
                        <th class=" ">Mill Type</th>
                        <th> :</th>
                        <td> {{ $previousMillerData->mill_name }} </td>
                        <th class=" ">Capacity</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->CAPACITY_ID }}</td>
                    </tr>

                    <tr>
                        <th class=" ">Division Name</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->DIVISION_NAME }} </td>
                        <th class=" ">District Name</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->DISTRICT_NAME }} </td>
                    </tr>

                    <tr>
                        <th class=" ">Upazila Name</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->UPAZILA_NAME }} </td>
                        <th class=" ">Zone</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->ZONE_NAME }}</td>
                    </tr>

                    <tr>
                        <th class=" ">Millers ID</th>
                        <th> :</th>
                        <td>{{ $previousMillerData->MILLERS_ID }}</td>
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
            @else
                <h3 style="text-align: center;color: red;">No Data Found</h3>
            @endif
        </div>

        <h4 class="center text-success">Entrepreneur Information Details</h4>
        <div class="row table-responsive">
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
                @if($previousEnterpreneurData)
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
                @else
                    <tr>
                        <td style="text-align: center;color: red;">No Data Found</td>
                    </tr>
                @endif
            </table>
        </div>

        <h4 class="center text-success">Certificate Information </h4>
        <div class="row table-responsive">
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
                @if($previousCertificaterData)
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
                @else
                    <tr>
                        <td style="text-align: center;color: red;">No Data Found</td>
                    </tr>
                @endif
            </table>
        </div>
        <h4 class="center text-success">QC Information </h4>
        <div class="row table-responsive">
            @if($previousQcData)
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
            @else

                <h3 style="text-align: center;color: red;">No Data Found</h3>
            @endif
        </div>

        <h4 class="center text-success">Employee Information </h4>
        <div class="row table-responsive">
            @if($previousEmployeeData)
                <table class="table borderless">
                    <tr>
                        <th class=" ">Total Male Employee </th>
                        <th> :</th>
                        <td> {{ $previousEmployeeData->TOTMALE_EMP }} </td>
                        <th class=" ">Total Female Employee</th>
                        <th> :</th>
                        <td> {{ $previousEmployeeData->TOTFEM_EMP }} </td>
                    </tr>

                    <tr>
                        <th class=" ">Full Time Male Employee</th>
                        <th> :</th>
                        <td> {{ $previousEmployeeData->FULLTIMEMALE_EMP }}</td>
                        <th class=" ">Full Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->FULLTIMEFEM_EMP }} </td>
                    </tr>

                    <tr>
                        <th class=" ">Part Time Male Employee</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->PARTTIMEMALE_EMP }} </td>
                        <th class=" ">Part Time Female Employee</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->PARTTIMEFEM_EMP }} </td>
                    </tr>

                    <tr>
                        <th class=" ">Technical Male Employee</th>
                        <th> :</th>
                        <td>{{ $previousEmployeeData->TOTMALETECH_PER }} </td>
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
            @else
                <h3 style="text-align: center;color: red;">No Data Found</h3>
            @endif
        </div>

        <div class="space"></div>
    </div>
</div>
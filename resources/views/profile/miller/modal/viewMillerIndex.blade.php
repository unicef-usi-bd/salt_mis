<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
        <h4 class="center text-success">Mill Information </h4>
        {{--<h4 class="center text-success">{{ trans('dashboard.details') }} </h4>--}}
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th class=" ">Name of Mill</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->MILL_NAME }} </td>
                    <th class=" ">Process Type</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->LOOKUPCHD_NAME }} </td>

                </tr>
                <tr>
                    <th class=" ">Mill Type</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->MILL_TYPE_ID }}</td>
                    <th class=" ">Capacity</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->CAPACITY_ID }} </td>

                </tr>
                <tr>
                    <th class=" ">Division Name</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->DIVISION_NAME }} </td>
                    <th class=" ">District Name</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->DISTRICT_NAME }} </td>

                </tr>
                <tr>
                    <th class=" ">Upazila Name</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->UPAZILA_NAME }} </td>
                    <th class=" ">Union Name</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->UNION_NAME }}</td>

                </tr>
                <tr>
                    <th class=" ">Zone</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->ZONE_NAME }}</td>
                    <th class=" ">Millers ID</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->MILLERS_ID }}</td>

                </tr>
                <tr>
                    <th class=" ">Active Status</th>
                    <th> :</th>
                    <td>
                        <?php  if($viewMillerData->ACTIVE_FLG == 0){ ?>
                        <span class="label label-sm label-danger arrowed arrowed-righ">Inactive</span>
                        <?php }else{ ?>
                        <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                        <?php } ?>
                    </td>
                    <th class=" ">Remarks</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->REMARKS }}</td>

                </tr>
            </table>
        </div>

        <h4 class="center text-success">Entrepreneur Information </h4>
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th class=" ">Registration Type</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->LOOKUPCHD_NAME }} </td>
                    <th class=" ">Type of Owner</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->OWNER_TYPE_ID }} </td>

                </tr>
                <tr>
                    <th class=" ">Owner Name</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->OWNER_NAME }}</td>
                    <th class=" ">NID</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->NID }} </td>

                </tr>
                <tr>
                    <th class=" ">Division Name</th>
                    <th> :</th>
                    <td>{{ $millerListForEntrepreneur->DIVISION_NAME }} </td>
                    <th class=" ">District Name</th>
                    <th> :</th>
                    <td>{{ $millerListForEntrepreneur->DISTRICT_NAME }} </td>

                </tr>
                <tr>
                    <th class=" ">Upazila Name</th>
                    <th> :</th>
                    <td>{{ $millerListForEntrepreneur->UPAZILA_NAME }} </td>
                    <th class=" ">Union Name</th>
                    <th> :</th>
                    <td>{{ $millerListForEntrepreneur->UNION_NAME }}</td>

                </tr>
                <tr>
                    <th class=" ">Mobile 1</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->MOBILE_1 }}</td>
                    <th class=" ">Mobile 2</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->MOBILE_2 }}</td>

                </tr>
                <tr>
                    <th class=" ">Email </th>
                    <th> :</th>
                    <td> {{ $viewMillerData->EMAIL }}</td>
                    <th class=" ">Remarks</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->REMARKS }}</td>

                </tr>
            </table>
        </div>

        <h4 class="center text-success">Certificate Information </h4>
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th class=" ">Type of Certificate </th>
                    <th> :</th>
                    <td> {{ $viewMillerData->CERTIFICATE_TYPE_ID }} </td>
                    <th class=" ">Issure Name</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->ISSURE_ID }} </td>

                </tr>
                <tr>
                    <th class=" ">Issuing Date</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->ISSUING_DATE }}</td>
                    <th class=" ">Certificate Number</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->CERTIFICATE_NO }} </td>

                </tr>
                <tr>
                    <th class=" ">Trade License </th>
                    <th> :</th>
                    <td><a href="{{ url('/'. $viewMillerData->TRADE_LICENSE ) }}" target="_blank">File</a>  </td>
                    <th class=" ">Renewing Date</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->RENEWING_DATE }} </td>

                </tr>
                <tr>
                    <th class=" ">Remarks</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->REMARKS }} </td>

                </tr>

            </table>
        </div>
        <h4 class="center text-success">QC Information </h4>
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th class=" ">laboratory </th>
                    <th> :</th>
                    <td>
                        <?php  if($viewMillerData->LABORATORY_FLG == 0){ ?>
                        <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                        <?php }else{ ?>
                        <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                        <?php } ?>
                    </td>
                    <th class=" ">Standard Operation Procedure (SOP)</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->SOP_DESC }} </td>

                </tr>
                <tr>
                    <th class=" ">If Iodine content check during production</th>
                    <th> :</th>
                    <td>
                        <?php  if($viewMillerData->IODINE_CHECK_FLG == 0){ ?>
                        <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                        <?php }else{ ?>
                        <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                        <?php } ?>
                    </td>
                    <th class=" ">Monitoring Test Kit</th>
                    <th> :</th>
                    <td>
                        <?php  if($viewMillerData->MONITORING_FLG == 0){ ?>
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
                        <?php  if($viewMillerData->LAB_MAN_FLG == 0){ ?>
                        <span class="label label-sm label-danger arrowed arrowed-righ">No</span>
                        <?php }else{ ?>
                        <span class="label label-sm label-info arrowed arrowed-righ">Yes</span>
                        <?php } ?>
                    </td>
                    <th class=" ">No of Laboratory Man</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->LAB_PERSON }} </td>

                </tr>
                <tr>
                    <th class=" ">Remarks</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->REMARKS }} </td>

                </tr>

            </table>
        </div>

        <h4 class="center text-success">Employee Information </h4>
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th class=" ">Total Male Employee </th>
                    <th> :</th>
                    <td> {{ $viewMillerData->TOTMALE_EMP }} </td>
                    <th class=" ">Total Female Employee</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->TOTFEM_EMP }} </td>

                </tr>
                <tr>
                    <th class=" ">Full Time Male Employee</th>
                    <th> :</th>
                    <td> {{ $viewMillerData->FULLTIMEMALE_EMP }}</td>
                    <th class=" ">Full Time Female Employee</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->FULLTIMEFEM_EMP }} </td>

                </tr>
                <tr>
                    <th class=" ">Part Time Male Employee</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->PARTTIMEMALE_EMP }} </td>
                    <th class=" ">Part Time Female Employee</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->PARTTIMEFEM_EMP }} </td>

                </tr>
                <tr>
                    <th class=" ">Technical Male Employee</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->TOTMALETECH_PER }} </td>
                    <th class=" "> Technical Female Employee</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->TOTFEMTECH_PER }} </td>

                </tr>
                <tr>
                    <th class=" ">Remarks</th>
                    <th> :</th>
                    <td>{{ $viewMillerData->REMARKS }} </td>

                </tr>

            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
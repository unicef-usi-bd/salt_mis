

<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
       <div class="row">
           <div class="col-md-6">
               <h4 class="left text-danger" >Mill Information </h4>
               <hr>
               <table class="table">
                   <tr style="margin-left: 200%;">
                       <th>Renewing Date </th>
                       <th> :</th>
                       <td class="renewalDate" style="background-color: red;  font-weight: bolder; color: white;">{{date('d-m-Y',strtotime($millInfo->RENEWING_DATE))}}</td>
                   </tr>
                   <tr>
                       <th>Mill Name</th>
                       <th> :</th>
                       <td>{{$millInfo->MILL_NAME}}</td>
                       <th>Mill Logo</th>
                       <th> :</th>
                       <td><img id="output"  style="width: 50px;height: 50px;" src="{{ asset('/'.$millInfo->mill_logo) }}" /></td>
                   </tr>

                   <tr>
                       <th>Process Type</th>
                       <th> :</th>
                       <td>{{$millInfo->ProcessType}}</td>

                   </tr>
                   <tr>
                       <th>Type of Mill</th>
                       <th> :</th>
                       <td>{{ $millInfo->millerType }}</td>
                       <th>Type Of Owner</th>
                       <th> :</th>
                       <td>{{$millInfo->ownerType}}</td>
                   </tr>
                   <tr>
                       <th>Capacity</th>
                       <th> :</th>
                       <td>{{ $millInfo->CAPACITY_ID }}</td>
                       <th>Address</th>
                       <th> :</th>
                       <td>{{ $millInfo->DIVISION_NAME }}, {{ $millInfo->DISTRICT_NAME }},<br> {{ $millInfo->UPAZILA_NAME }}</td>
                   </tr>
                   {{--<tr>--}}
                       {{--<th>Zone </th>--}}
                       {{--<th> :</th>--}}
                       {{--<td>{{$millInfo->ZONE_NAME}}</td>--}}
                       {{--<th>Millers ID </th>--}}
                       {{--<th> :</th>--}}
                       {{--<td>{{$millInfo->MILLERS_ID}}</td>--}}
                   {{--</tr>--}}

               </table>
           </div>
           <div class="space"></div>

           <div class="col-md-6">
               <div class="col-md-12">
               <h4 class="left text-danger" >Entrepreneur Information</h4>
               <hr>
               <table  class="table table-bordered table-hover">
                   <thead>
                   <tr>
                       <th>Owner Name</th>
                       <th>NID</th>
                       <th>Mobile</th>
                       <th>Email</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($millenteprunerInfo as $row)
                       <tr>
                           <td>{{ $row->OWNER_NAME }}</td>
                           <td>{{ $row->NID }}</td>
                           <td>{{ $row->MOBILE_1 }}</td>
                           <td>{{ $row->EMAIL }}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
               </div>
               <div class="col-md-12">

                       <h4 class="left text-danger" >Employee Information </h4>
                       <hr>
                       <table class="table">
                           <tr style="margin-left: 200%;">
                               <th width="200px;">Total Number of Employee </th>
                               <th width="5px;"> :</th>
                               <td>{{ $millInfo->TOTMALE_EMP + $millInfo->TOTFEM_EMP  }}</td>
                           </tr>


                           <tr>
                               <th width="200px;">Full Time Employee</th>
                               <th width="5px;"> :</th>
                               <td>{{$millInfo->FULLTIMEMALE_EMP + $millInfo->FULLTIMEFEM_EMP}}</td>
                           </tr>

                           <tr>
                               <th width="200px;"> Part Time Employee</th>
                               <th width="5px;"> :</th>
                               <td>{{ $millInfo->PARTTIMEMALE_EMP + $millInfo->PARTTIMEFEM_EMP }}</td>
                           </tr>
                       </table>

               </div>
           </div>
           <div class="space"></div>
       </div>
    </div>
</div>
    <div class="error-container">
        <h4 class="left text-danger" >Certificate Information</h4>
        <hr>
        <div class="row table-responsive">
            <table  class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Type of Certificate</th>
                    <th>Issure Name</th>
                    <th>Issuing Date</th>
                    <th>Certificate Number</th>
                    <th>Attached File</th>
                    <th>Renewing Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($certificateInfo as $row)
                    <tr>
                        <td>{{ $row->CERTIFICATE_NAME }}</td>
                        <td>{{ $row->issureName }}</td>
                        <td>{{ date('m-d-Y',strtotime($row->ISSUING_DATE)) }}</td>
                        <td>{{ $row->CERTIFICATE_NO }}</td>
                        <td><img id="output"  style="width: 50px;height: 50px;" src="{{ asset('/'.$row->TRADE_LICENSE) }}" /></td>
                        <td>{{ date('m-d-Y',strtotime($row->RENEWING_DATE)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="space"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
       var renewalDate = $('.renewalDate').text();
       $('.RENEWING_DATE').val(renewalDate);
    });
</script>

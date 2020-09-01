<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>

<div class="row">
    <form action="{{ url('/extended-date-update') }}" method="post" class="form-horizontal" role="form">
     @csrf
        <div class="col-md-12">
            <div class="col-md-2">
                <button type="button" title="View Mill Extend logs" class="btn btn-warning" data-toggle="collapse" data-target="#extendDetailsTarget">Extend Date details</button>
            </div>
            <div class="col-md-4">
                <div class="form-group" style="margin-left: -95px;">
                    <label  class="col-sm-8 control-label no-padding-right" for="form-field-1-1"> <b>Renewing days</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-4">
                        <input style="width: 50px;" placeholder="0" type="number" min="0"    name="renewing_days"  class="renewingDays" value="0">
                    </div>
                    <input type="hidden" name="MILL_ID" class="extendMillerId" value="{{$millInfo->MILL_ID}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group" style="margin-left: -35%">
                    <label  class="col-sm-6 control-label no-padding-right" for="form-field-1-1"> <b>Extended Date</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-4">
                        <input autocomplete="off" type="text" readonly name="renewing_date"  class="expireDate date-picker" value=""/>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="col-md-12 center">
                    <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        {{ trans('dashboard.submit') }}
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
<hr>
<div class="col-md-12">
    <div class="row">
        <div id="extendDetailsTarget" class="collapse">
            <h4 class="left text-danger" >Extend date Information</h4>
            <table  class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Application date for extension </th>
                    <th>Total days</th>
                    <th>Start date</th>
                    <th>End date</th>
                </tr>
                </thead>
                <tbody>
                @if(sizeof($extendDetails)!=0)
                    @foreach($extendDetails as $key=>$row)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ date('d-M-Y', strtotime($row->created_at)) }}</td>
                        <td>{{ $row->extend_days }}</td>
                        <td>{{ date('d-M-Y', strtotime($row->created_at)) }}</td>
                        <td>{{ date('d-M-Y', strtotime($row->extend_date)) }}</td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center text-danger"><h5>Opps! Data not found.</h5></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <h4 class="left text-danger" >Mill&nbsp;Information </h4>
            <hr>
            <table class="table">
                <tr style="margin-left: 200%;">
                    <th>Renewing Date </th>
                    <th> :</th>
                    <td class="renewalDate" style="background-color: red; max-width: 100px; font-weight: bolder; color: white;">{{ date('m/d/Y', strtotime($millInfo->RENEWING_DATE)) }}</td>
                    @if($extendDate)
                    <th>Extend Date</th>
                    <th> :</th>
                    <td style="background: yellowgreen;max-width: 100px; font-weight: bolder; color: black;">{{ date('m/d/Y', strtotime($extendDate)) }}</td>
                    @endif
                </tr>
                <tr>
                    <th>Mill&nbsp;Name</th>
                    <th> :</th>
                    <td>{{$millInfo->MILL_NAME}}</td>
                    <th>Mill Logo</th>
                    <th> :</th>
                    <td>
                        <img id="output"  style="width: 50px;height: 50px;" src="{{ asset('/'.$millInfo->mill_logo) }}" />
                    </td>
                </tr>

                <tr>
                    <th>Process&nbsp;Type</th>
                    <th> :</th>
                    <td>{{$millInfo->ProcessType}}</td>

                </tr>
                <tr>
                    <th>Type&nbsp;of&nbsp;Mill</th>
                    <th> :</th>
                    <td>{{ $millInfo->millerType }}</td>
                    <th>Type&nbsp;Of&nbsp;Owner</th>
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
            </table>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <h4 class="left text-danger" >Entrepreneur&nbsp;Information</h4>
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
                    @foreach($entepreunerInfo as $row)
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

                <h4 class="left text-danger" >Employee&nbsp;Information </h4>
                <hr>
                <table class="table">
                    <tr style="margin-left: 200%;">
                        <th width="200px;">Total&nbsp;Number&nbsp;of&nbsp;Employee </th>
                        <th width="5px;"> :</th>
                        <td>{{ $millInfo->TOTMALE_EMP + $millInfo->TOTFEM_EMP  }}</td>
                    </tr>


                    <tr>
                        <th width="200px;">Full&nbsp;Time&nbsp;Employee</th>
                        <th width="5px;"> :</th>
                        <td>{{$millInfo->FULLTIMEMALE_EMP + $millInfo->FULLTIMEFEM_EMP}}</td>
                    </tr>

                    <tr>
                        <th width="200px;"> Part&nbsp;Time&nbsp;Employee</th>
                        <th width="5px;"> :</th>
                        <td>{{ $millInfo->PARTTIMEMALE_EMP + $millInfo->PARTTIMEFEM_EMP }}</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="space"></div>
    </div>
</div>
<div class="error-container">
    <h4 class="left text-danger" >Certificate&nbsp;Information</h4>
    <hr>
    <div class="row table-responsive">
        <table  class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Type&nbsp;of&nbsp;Certificate</th>
                <th>Issuer&nbsp;Name</th>
                <th>Issuing&nbsp;Date</th>
                <th>Certificate&nbsp;Number</th>
                <th>Attached&nbsp;File</th>
                <th>Renewing&nbsp;Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($certificateInfo as $row)
                <tr>
                    <td>{{ $row->CERTIFICATE_NAME }}</td>
                    <td>{{ $row->issureName }}</td>
                    <td>{{ date('m-d-Y',strtotime($row->ISSUING_DATE)) }}</td>
                    <td>{{ $row->CERTIFICATE_NO }}</td>
                    <td>
                       <a href="{{ url('/'. $row->TRADE_LICENSE ) }}" target="_blank"><img style="width: 50px;height: 50px;" src="{{ url('/'. $row->TRADE_LICENSE ) }}" alt="trade license"  width="20%"></a>
                    </td>
                    <td>{{ date('m-d-Y',strtotime($row->RENEWING_DATE)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="space"></div>
</div>

@include('masterGlobal.datePicker')
@include('masterGlobal.ajaxFormSubmit')
<script>
    $(document).ready(function () {
        let millerId = $('.millerName').val();
        $('.extendMillerId').val(millerId);
        let renewingDays = parseInt($('.renewingDays').val());
        let renewalDate = $('.renewalDate').text();
        let datepicker = $('input.date-picker');
        renewalDate = addDaysToDate(new Date(renewalDate), renewingDays);
        if(datepicker) datepicker.val(renewalDate).trigger('changeDate');

    });

    $(document).on('change', '.renewingDays', function () {
        let datepicker = $('input.date-picker');
        let renewingDays = parseInt($('.renewingDays').val() || 0);
        let renewalDate = $('.renewalDate').text();
        renewalDate = addDaysToDate(new Date(renewalDate), renewingDays);
        if(datepicker) datepicker.val(renewalDate).trigger('changeDate');
    });

//    Add days to Date object
    function addDaysToDate(date, days) {
        const newDate = new Date(Number(date));
        newDate.setDate(date.getDate() + days);
        let day = newDate.getDate();
        let month = newDate.getMonth()+1;
        let year = newDate.getFullYear();
        return `${month}/${day}/${year}`;
    }

//    Two Date Difference
    function daysDifference(fromDate, toDate) {
        let days;
        fromDate = new Date(fromDate);
        toDate = new Date(toDate);
        let diffTime = Math.abs(toDate - fromDate);
        days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return days;
    }
</script>

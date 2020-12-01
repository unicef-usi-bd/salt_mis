
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row addexcelbutton" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('miller-license-report-pdf/'.$zone.'/'.$issuerId.'/'.$renawlDate.'/'.$failDate) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>List Of Licence</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            {{--<tr>--}}
            {{--<th rowspan="2">No. of Established FIACs </th>--}}
            {{--<th colspan="12">No. of Farmers Visited FIAC</th>--}}
            {{--<th rowspan="2">Total Nos.</th>--}}
            {{--</tr>--}}
            <tr>
                <th>SL</th>
                <th>Association Name</th>
                <th>Millers Name</th>
                <th>License Type</th>
                <th>Issuer Name</th>
                <th>Issuing Date </th>
                <th>Renewal Date</th>
                <th>Status</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($listLicenseMiller as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->ASSOCIATION_NAME}}</td>
                    <td>{{$row->MILL_NAME}}</td>
                    <td>{{$row->license_type}}</td>
                    <td>{{$row->issuer_name}}</td>
                    <td>{{$row->ISSUING_DATE}}</td>
                    <td>{{$row->RENEWING_DATE}}</td>
                    <td>@if($row->ACTIVE_FLG == 1)
                            <span>Active</span>
                        @else
                            <span>Inactive</span>
                        @endif</td>

                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>

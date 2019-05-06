<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>QC Report</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Miller Name</th>
        <th>Batch No</th>
        <th>QC By</th>
        <th>Agency Name</th>
        <th>Test Result</th>
    </tr>

    </tr>
    @foreach($MillerList as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->mill_name}}</td>
            <td>{{$row->BATCH_NO}}</td>
            <td>{{$row->QC_BY}}</td>
            <td>{{$row->AGENCY_NAME}}</td>
            <td>{{$row->QC_TESTNAME}}</td>
        </tr>
    @endforeach

</table>
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
        <th>Millers Name</th>
        <th>License Type</th>
        <th>Issuer Name</th>
        <th>Issuing Date</th>
        <th>Renewing Date</th>
    </tr>

    </tr>
    @foreach($MillerList as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->MILL_NAME}}</td>
            <td>{{$row->CERT_NAME}}</td>
            <td>{{$row->ISSUER}}</td>
            <td>{{ date('d-M-Y', strtotime($row->ISSUING_DATE)) }}</td>
            <td>{{ date('d-M-Y', strtotime($row->RENEWING_DATE)) }}</td>

        </tr>
    @endforeach

</table>
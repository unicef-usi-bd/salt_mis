<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Monitor Miller Report</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Miller Name</th>
        <th>Monitor By</th>
        <th>Date</th>

    </tr>
    @foreach($monitorMiller as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->MILL_NAME}}</td>
            <td>{{$row->MONITOR_BY}}</td>
            <td>{{ date('Y-m-d', strtotime($row->MOMITOR_DATE))}}</td>
        </tr>
    @endforeach

</table>
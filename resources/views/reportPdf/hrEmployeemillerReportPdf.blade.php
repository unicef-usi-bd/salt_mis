<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Number of Employees</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>SL</th>
        <th>Total Number of Employees</th>
        <th>Number of Full-Time Employees</th>
        <th>Number of Part-Time Employees</th>
        <th>Number of Technical People</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($employeeList as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->Total_Employee}}</td>
            <td>{{$row->Full_time_total_employee}}</td>
            <td>{{$row->Parttime_total_employee}}</td>
            <td>{{$row->total_tech_employee }}</td>
        </tr>
    @endforeach

</table>
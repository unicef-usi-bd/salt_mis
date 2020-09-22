<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List of Mill</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl</th>
        <th>Name Mill </th>
        <th>Total Number of Employees </th>
        <th>Number of Full-Time Employees </th>
        <th>Number of Part-Time Employees</th>
        <th>Number of Technical People</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($totalMiller as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->MILL_NAME}}</td>
            <td>{{$row->tot_emp}}</td>
            <td>{{$row->fulltime_emp}}</td>
            <td>{{$row->parttime_enp}}</td>
            <td>{{$row->tot_tech_person}}</td>
        </tr>
    @endforeach

</table>
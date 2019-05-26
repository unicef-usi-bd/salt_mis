<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List of Miller</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl.</th>
        <th>Millers Name</th>
        <th>Total Number of Employee </th>
        <th>Number of full time Employee </th>
        <th>Number of part time Employee</th>
        <th>Number of Technical Person e</th>
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
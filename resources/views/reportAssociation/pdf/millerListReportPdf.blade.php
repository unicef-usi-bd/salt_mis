<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Miller Employee List For HR</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Millers Name</th>
        <th>Total No of Employee</th>
        <th>No of Full Time Employee</th>
        <th>No of Part Time Employee</th>
        <th>No of Technical Person</th>

    </tr>
    @foreach($MillerList as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->MILL_NAME}}</td>
            <td>{{$row->TOTMALE_EMP + $row->TOTFEM_EMP}} </td>
            <td>{{$row->FULLTIMEMALE_EMP + $row->FULLTIMEFEM_EMP}} </td>
            <td>{{$row->PARTTIMEMALE_EMP + $row->PARTTIMEFEM_EMP}} </td>
            <td>{{$row->TOTMALETECH_PER + $row->TOTFEMTECH_PER}} </td>
        </tr>
    @endforeach

</table>
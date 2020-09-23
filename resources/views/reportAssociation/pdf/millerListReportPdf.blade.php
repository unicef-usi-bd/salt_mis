<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List of Mill</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Name of Mill </th>
        <th>Total Number of Employees</th>
        <th>Numnber of Full-Time Employees</th>
        <th>Number of Part-Time Employees</th>
        <th>Number of Technical People</th>

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
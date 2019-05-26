<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Association Sales Report</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Number of Millers</th>
        <th>Items Type</th>
        <th>Items Name</th>
        <th>Division</th>
        <th>District</th>
        <th>Sales Amount </th>
    </tr>

    </tr>
    @foreach($assocSale as $sl =>  $row)
        <tr>
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->cnt_miller}}</td>
            <td>{{$row->ITEM_TYPE_NAME}}</td>
            <td>{{$row->ITEM_NAME}}</td>
            <td>{{$row->DIVISION_NAME}}</td>
            <td>{{$row->DISTRICT_NAME}}</td>
            <td>{{abs($row->QTY)}}</td>
        </tr>
        </tr>
    @endforeach

</table>
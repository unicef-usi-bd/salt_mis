<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Sale Item Stock Report</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        th>Item Type</th>
        <th>Item Name</th>
        <th>Stock Volume</th>

    </tr>
    @foreach($itemStock as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->LOOKUPCHD_NAME}}</td>
            <td>{{$row->ITEM_NAME}}</td>
            <td>{{$row->QTY}}</td>
        </tr>
    @endforeach

</table>
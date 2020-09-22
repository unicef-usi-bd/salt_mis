<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Total Purchase</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Name of Mill </th>
        <th>Item Type</th>
        <th>Item Name</th>
        <th>Purchase Date</th>
        <th>Purchased Quantity (KG)</th>

    </tr>
    @foreach($purchaseSaltTotal as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->ASSOCIATION_NAME}}</td>
            <td>{{$row->LOOKUPCHD_NAME}}</td>
            <td>{{$row->ITEM_NAME}}</td>
            <td>{{ date('d-M-Y',strtotime($row->TRAN_DATE))}}</td>
            <td>{{$row->QTY}}</td>
        </tr>
    @endforeach

</table>
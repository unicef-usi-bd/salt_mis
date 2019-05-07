<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Purchase Chemical Total Stock</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Item Type</th>
        <th>Item Name</th>
        <th>Purchase Stock Volume</th>

    </tr>
    @foreach($purchaseChemicalTotalStock as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->LOOKUPCHD_NAME}}</td>
            <td>{{$row->ITEM_NAME}}</td>
            <td>{{$row->STOCK_QTY}}</td>
        </tr>
    @endforeach

</table>
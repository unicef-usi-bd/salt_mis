<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Sale</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>SL</th>
        <th>Item Type</th>
        <th>Item Name</th>
        <th>Name of Client</th>
        <th>Sale Amount (KG)</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($saleClintList as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->ITEM_TYPE_NAME}}</td>
            <td>{{$row->ITEM_NAME}}</td>
            <td>{{$row->TRADER_NAME}}</td>
            <td>{{abs($row->QTY)}}</td>
        </tr>
    @endforeach

</table>
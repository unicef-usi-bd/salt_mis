<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List of Clint</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>SL</th>
        <th>Item Name</th>
        <th>Type of Seller</th>
        <th>Name of Seller</th>
        <th>Division</th>
        <th>District</th>
        <th>Total Amount (KG)</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($clintList as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->ITEM_NAME}}</td>
            <td>{{$row->seller_type}}</td>
            <td>{{$row->TRADING_NAME}}</td>
            <td>{{ $row->DIVISION_NAME }}</td>
            <td>{{ $row->DISTRICT_NAME }}</td>
            <td>{{ abs($row->QTY) }}</td>
        </tr>
    @endforeach

</table>

<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <h4>Chemical Stock</h4>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl.</th>
        <th>Item Name</th>
        <th>Total Purchase Amount</th>
    </tr>
    <?php $sl=0;?>
    @foreach($purchaseChemicalStocks as $purchaseChemicalStock)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$purchaseChemicalStock->ITEM_NAME}}</td>
            <td>{{ number_format($purchaseChemicalStock->STOCK_QTY, 2) }}</td>

        </tr>
    @endforeach

</table>
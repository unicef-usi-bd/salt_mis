<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <h4>Monitor Supplier</h4>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl.</th>
        <th>Process Type</th>
        <th>Stock Amount</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($purchaseChemicalStocks as $purchaseChemicalStock)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$purchaseChemicalStock->LOOKUPCHD_NAME}}</td>
            <td>{{$purchaseChemicalStock->STOCK_QTY}}</td>

        </tr>
    @endforeach
    @foreach($purchaseTotalSaltStocks as $purchaseTotalSaltStock)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$purchaseTotalSaltStock->LOOKUPCHD_NAME}}</td>
            <td>{{$purchaseTotalSaltStock->STOCK_QTY}}</td>

        </tr>
    @endforeach
</table>
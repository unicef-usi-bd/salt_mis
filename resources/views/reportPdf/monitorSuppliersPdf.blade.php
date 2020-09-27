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
        <th>SL</th>
        <th>Type of Supplier</th>
        <th>Name of Supplier</th>
        <th>Purchase Amount (KG)</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($monitorSuppliers as $monitorSupplier)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$monitorSupplier->LOOKUPCHD_NAME}}</td>
            <td>{{$monitorSupplier->TRADER_NAME}}</td>
            <td>{{$monitorSupplier->QTY}}</td>

        </tr>
    @endforeach

</table>
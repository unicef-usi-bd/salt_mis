<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <h4>Chemical Purchase</h4>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl.</th>
        <th>Item Name</th>
        <th>Total Purchase Amount</th>
    </tr>
    <?php $sl=0;?>
    @foreach($purchaseChemicals as $purchaseChemical)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$purchaseChemical->ITEM_NAME}}</td>
            <td>{{ number_format($purchaseChemical->QTY, 2) }}</td>

        </tr>
    @endforeach

</table>
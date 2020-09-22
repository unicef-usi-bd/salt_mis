<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Total Purchase</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Item Name</th>
        <th>Total Purchases Amount </th>

    </tr>
    <?php $sl = 0; ?>

    @foreach($purchaseTotalSalt as $purchaseSalt)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$purchaseSalt->ITEM_NAME}}</td>
            <td>{{ number_format($purchaseSalt->QTY, 2) }}</td>

        </tr>
    @endforeach

</table>
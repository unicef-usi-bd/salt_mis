<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Monitor Supplier</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Type of Supplier</th>
        <th>Name of Supplier</th>
        <th>Purchases Amount (KG)</th>
    </tr>
    <?php $sl = 0; ?>


    @foreach($purchaseTotalSaltStock as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->LOOKUPCHD_NAME}}</td>
            <td>{{$row->TRADER_NAME}}</td>
            <td>{{$row->QTY}}</td>
        </tr>
    @endforeach
</table>
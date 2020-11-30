<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List of Supplier</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>SL</th>
        <th>Name of Supplier</th>
        <th>Division</th>
        <th>District</th>
        <th>Total Amount (KG) </th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($supplierMillerList as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->TRADING_NAME}}</td>
            <td>{{$row->DIVISION_NAME}}</td>
            <td>{{$row->DISTRICT_NAME}}</td>
            <td>{{$row->QTY}}</td>
        </tr>
    @endforeach

</table>


<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Item Stock</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl.</th>
        <th>Items Type </th>
        <th>Items Name</th>
        <th>Stock Volume</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($itemStock as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{ $row->LOOKUPCHD_NAME }}</td>
            <td>{{ $row->Process_Type }}</td>
            <td>{{ number_format($row->QTY-$row->SOLD_QTY, 2) }}</td>
        </tr>
    @endforeach

</table>
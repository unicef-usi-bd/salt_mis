<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Monitor Client</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl.</th>
        <th>Client Type</th>
        <th>Client Name </th>
        <th>Sale Volume</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($monitorClintList as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->LOOKUPCHD_NAME}}</td>
            <td>{{$row->TRADER_NAME}}</td>
            <td>{{abs($row->QTY) }}</td>
        </tr>
    @endforeach

</table>
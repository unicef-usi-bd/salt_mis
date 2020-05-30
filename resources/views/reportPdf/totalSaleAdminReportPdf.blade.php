<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Total Sale</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl.</th>
        <th>Number of Millers</th>
        <th>Items Type</th>
        <th>Items Name</th>
        <th>Division</th>
        <th>District</th>
        <th>Sales Amount</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($totalSale as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->cnt_miller}}</td>
            <td>{{$row->ITEM_TYPE_NAME}}</td>
            <td>{{$row->ITEM_NAME}}</td>
            <td>{{$row->DIVISION_NAME}}</td>
            <td>{{$row->DISTRICT_NAME}}</td>
            <td>{{number_format(abs($row->QTY, 2))}}</td>
        </tr>
    @endforeach

</table>
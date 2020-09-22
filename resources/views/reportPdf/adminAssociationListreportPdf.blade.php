<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List of Association</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl</th>
        <th>Name of Association </th>
        <th>Total Raw salt Purchase </th>
        <th>Total Chemical Purchase </th>
        <th>Total Processed Salt sale</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($associationList as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->ASSOCIATION_NAME}}</td>
            <td>{{$row->tot_purchase}}</td>
            <td>{{$row->tot_chmical_pr}}</td>
            <td>{{abs($row->tot_sales)}}</td>
        </tr>
    @endforeach

</table>
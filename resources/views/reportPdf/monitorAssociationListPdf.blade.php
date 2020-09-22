<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Monitor Association</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <td>Name of Association </td>
        <th>Number of Mills</th>

    </tr>
    <?php $sl = 0; ?>

    @foreach($monitorAssociationLists as $monitor)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$monitor->ASSOCIATION_NAME}}</td>
            <td>{{$monitor->Total_mill}}</td>

        </tr>
    @endforeach

</table>
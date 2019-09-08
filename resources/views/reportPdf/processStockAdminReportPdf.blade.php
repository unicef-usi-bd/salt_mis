<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Process Stock</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl.</th>
        <th>Mill Name</th>
        <th>Process Type</th>
        <th>Batch No</th>
        <th>ProductionAmount</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($processStock as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{ $row->ASSOCIATION_NAME }}</td>
            <td>{{$row->Process_Type}}</td>
            <td>{{$row->BATCH_NO}}</td>
            <td>{{$row->QTY}}</td>
        </tr>
    @endforeach

</table>
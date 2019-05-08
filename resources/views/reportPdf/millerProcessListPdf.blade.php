<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <h4>Monitor Supplier</h4>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>Sl.</th>
        <th>Process Type</th>
        <th>Batch No</th>
        <th>Production Amount</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($millerProcessLists as $millerProcessList)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$millerProcessList->Process_Type}}</td>
            <td>{{$millerProcessList->BATCH_NO}}</td>
            <td>{{$millerProcessList->QTY}}</td>

        </tr>
    @endforeach

</table>
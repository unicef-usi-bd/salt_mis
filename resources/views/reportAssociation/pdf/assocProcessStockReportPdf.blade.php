<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Process Stock</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Number of Mill</th>
        <th>Process Type</th>
        <th>Total Number of Batch</th>
        <th>Production Amount (KG)</th>
    </tr>

    </tr>
    @foreach($processStock as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{ $row->MILL_NO }}</td>
            <td>{{ $row->TRAN_TYPE=='W'? 'Wash & Crush' : 'Iodized' }}</td>
            <td>{{ $row->BATCH_NO }}</td>
            <td>{{ number_format($row->QTY, 2) }}</td>
        </tr>
    @endforeach

</table>
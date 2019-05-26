<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Process Stock Report</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>No. of Millers</th>
        <th>Process Type</th>
        <th>Batch No</th>
        <th>Production Amount</th>
        <th>Stock</th>
    </tr>

    </tr>
    @foreach($processStock as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endforeach

</table>
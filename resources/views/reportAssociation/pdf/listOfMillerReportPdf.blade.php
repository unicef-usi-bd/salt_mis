<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List Of Miller Report</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Item Type</th>
        <th>Item Name</th>
        <th>Purchases Volume</th>
        <th>Sales Volume</th>

    </tr>
    @foreach($millerList as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endforeach

</table>
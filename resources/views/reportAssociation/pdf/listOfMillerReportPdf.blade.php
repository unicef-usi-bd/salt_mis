<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List of Mill</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Name of Mill </th>
        {{--<th>Item Type</th>--}}
        {{--<th>Item Name</th>--}}
        {{--<th>Purchases Volume</th>--}}
        {{--<th>Sales Volume</th>--}}

    </tr>
    @foreach($millerList as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{ $row->MILL_NAME }}</td>
            {{--<td>{{ $row->LOOKUPCHD_NAME }}</td>--}}
            {{--<td>{{ $row->ITEM_NAME }}</td>--}}
            {{--<td>{{ $row->purchase }}</td>--}}
            {{--<td>{{ $row->reduce }}</td>--}}

        </tr>
    @endforeach

</table>
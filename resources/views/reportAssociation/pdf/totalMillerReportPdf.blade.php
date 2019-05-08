<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Miller List</p>
</div>


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Mill Name</th>
        <th>Active Status</th>

    </tr>
    @foreach($totalMiller as $sl =>  $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->MILL_NAME}}</td>
            {{--<td>{{$row->ACTIVE_FLG}}</td>--}}
            <td>
                {{--@if($row->ACTIVE_FLG == 1)--}}
                    {{--<span>Active</span>--}}
                {{--@else--}}
                    {{--<span>Inactive</span>--}}
                {{--@endif--}}
                @if($row->ACTIVE_FLG == 1)
                    <span>Active</span>
                @endif
                @if($row->ACTIVE_FLG == 0)
                    <span>Inactive</span>
                @endif
            </td>
        </tr>
    @endforeach

</table>
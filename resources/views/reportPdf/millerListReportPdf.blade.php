<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Miller List</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <td>Miller Type</td>
        <th>Millers Name</th>
        <th>Status</th>

    </tr>
    <?php $sl = 0; ?>

    @foreach($millerLists as $miller)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$miller->LOOKUPCHD_NAME }}</td>
            <td>{{$miller->MILL_NAME}}</td>
            <td>
                @if($miller->ACTIVE_FLG == 1)
                    <span>Active</span>
                @else
                    <span>Inactive</span>
                @endif
            </td>

        </tr>
    @endforeach

</table>
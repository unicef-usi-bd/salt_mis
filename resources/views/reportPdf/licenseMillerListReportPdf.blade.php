<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List Of Licence</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Association Name</th>
        <th>Millers Name</th>
        <th>License Type</th>
        <th>Issuer Name</th>
        <th>Issuing Date </th>
        <th>Renewal Date</th>
        <th>Status</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($listLicenseMiller as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->ASSOCIATION_NAME}}</td>
            <td>{{$row->MILL_NAME}}</td>
            <td>{{$row->license_type}}</td>
            <td>{{$row->issuer_name}}</td>
            <td>{{$row->ISSUING_DATE}}</td>
            <td>{{$row->RENEWING_DATE}}</td>
            <td>@if($row->ACTIVE_FLG == 1)
                    <span>Active</span>
                @else
                    <span>Inactive</span>
                @endif
            </td>
        </tr>
    @endforeach

</table>
<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Mill-Wise List of QC</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Batch No</th>
        <th>QC By</th>
        <th>Agency Name</th>
        <th>Test Result</th>
        {{--<th>Attached File</th>--}}
    </tr>

    <?php $sl = 0; ?>

    @foreach($qcReports as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            {{--<td>{{$row->MILL_NAME}}</td>--}}
            <td>{{$row->BATCH_NO}}</td>
            <td>{{$row->quality_control_by}}</td>
            <td>{{$row->agency_name}}</td>
            <td>
                @if($qualityControlResultRange->SODIUM_CHLORIDE_MAX >= $row->SODIUM_CHLORIDE && $qualityControlResultRange->SODIUM_CHLORIDE_MIN <= $row->SODIUM_CHLORIDE && $qualityControlResultRange->MOISTURIZER_MAX >= $row->MOISTURIZER && $qualityControlResultRange->MOISTURIZER_MIN <= $row->MOISTURIZER && $qualityControlResultRange->PPM_MAX >= $row->IODINE_CONTENT && $qualityControlResultRange->PPM_MIN <= $row->IODINE_CONTENT && $qualityControlResultRange->PH_MAX >= $row->PH && $qualityControlResultRange->PH_MIN <= $row->PH)
                    <span >Pass</span>
                @else
                    <span>Fail</span>
                @endif
            </td>
        </tr>
    @endforeach

</table>
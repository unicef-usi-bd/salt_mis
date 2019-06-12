<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List of Miller QC Report</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <th>Millers Name</th>
        <th>Batch NO</th>
        <th>QC BY</th>
        <th>Agency Name</th>
        <th>Test Result</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($qcReportsMiller as $row)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$row->MILL_NAME}}</td>
            <td>{{$row->BATCH_NO}}</td>
            <td>{{$row->quality_control_by}}</td>
            <td>{{$row->agency_name}}</td>
            <td>
                @if($qualityControlResultRangeMiller->SODIUM_CHLORIDE_MAX >= $row->SODIUM_CHLORIDE && $qualityControlResultRangeMiller->SODIUM_CHLORIDE_MIN <= $row->SODIUM_CHLORIDE && $qualityControlResultRangeMiller->MOISTURIZER_MAX >= $row->MOISTURIZER && $qualityControlResultRangeMiller->MOISTURIZER_MIN <= $row->MOISTURIZER && $qualityControlResultRangeMiller->PPM_MAX >= $row->IODINE_CONTENT && $qualityControlResultRangeMiller->PPM_MIN <= $row->IODINE_CONTENT && $qualityControlResultRangeMiller->PH_MAX >= $row->PH && $qualityControlResultRangeMiller->PH_MIN <= $row->PH)
                    <span >Pass</span>
                @else
                    <span>Fail</span>
                @endif
            </td>
        </tr>
    @endforeach

</table>
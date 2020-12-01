
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row addexcelbutton" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('qc-miller-list-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Mill-Wise List of QC</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Name of Mill </th>
                <th>Batch No</th>
                <th>QC By</th>
                <th>Agency Name</th>
                <th>Test Result</th>
            </tr>

            </thead>

            <tbody>
            @foreach($MillerList as $sl =>  $row)
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
            </tbody>
        </table>
    </div>
</div>


<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('qc-report-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Mill-Wise List of QC </h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>SL</th>
                {{--<th>Millers Name</th>--}}
                <th>Batch No</th>
                <th>QC By</th>
                <th>Agency Name</th>
                <th>Test Result</th>
                <th>Attached File</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($qcReports as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
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
                    <td class="text-center">
                        @if(!empty($row->file_path) && file_exists($row->file_path))
                            <a href="{{ url($row->file_path) }}" target="_blank" ><i class="fa fa-2x fa-file-pdf-o"></i></a>
                        @endif
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>

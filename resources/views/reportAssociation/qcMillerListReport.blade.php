
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('qc-miller-list-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Association</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Millers Name</th>
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
                    <td>{{$row->mill_name}}</td>
                    <td>{{$row->BATCH_NO}}</td>
                    <td>{{$row->QC_BY}}</td>
                    <td>{{$row->AGENCY_NAME}}</td>
                    <td>{{$row->QC_TESTNAME}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

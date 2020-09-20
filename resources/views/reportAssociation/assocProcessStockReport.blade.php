
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('assoc-process-stock-pdf/'.$starDate.'/'. $endDate) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
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
                <th>No. of Millers</th>
                <th>Process Type</th>
                <th>Batch No</th>
                <th>Production Amount</th>
            </tr>

            </thead>

            <tbody>
            @foreach($processStock as $sl =>  $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ $row->MILL_NO }}</td>
                    <td>{{ $row->TRAN_TYPE=='W'? 'Wash & Crush' : 'Iodized' }}</td>
                    <td>{{ $row->BATCH_NO }}</td>
                    <td>{{ number_format($row->QTY, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

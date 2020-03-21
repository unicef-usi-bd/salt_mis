<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('item-stock-miller-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Item Stock</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Items Type </th>
                <th>Items Name</th>
                <th>Stock Volume</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($itemStock as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ $row->LOOKUPCHD_NAME }}</td>
                    <td>{{ $row->Process_Type }}</td>
                    <td>{{ number_format($row->QTY-$row->SOLD_QTY, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

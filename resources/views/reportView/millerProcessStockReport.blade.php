
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('miller-process-stock-pdf/'.$starDate.'/'.$endDate) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Process Stock</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Mill Name</th>
                <th>Process Type</th>
                <th>Stock Amount</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($purchaseTotalSaltStocks as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->ASSOCIATION_NAME}}</td>
                    <td>{{$row->Process_Type}}</td>
                    <td>{{$row->QTY}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

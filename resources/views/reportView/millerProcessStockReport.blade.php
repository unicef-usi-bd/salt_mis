
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
                <th>SL</th>
                <th>Name of Mill</th>
                <th>Process Type</th>
                <th>Stock Amount (KG)</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($purchaseTotalSaltStocks as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->ASSOCIATION_NAME}}</td>
                    <td>{{$row->Process_Type}}</td>
                    {{--<td>{{$row->QTY}}</td>--}}
                    <td>{{number_format($row->QTY, 2 )}}</td>
                </tr>
            @endforeach
            @if(sizeof($purchaseTotalSaltStocks)==0)
                <tr>
                    <th class="text-danger" colspan="4">
                        <h5>Data not found !</h5>
                    </th>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>

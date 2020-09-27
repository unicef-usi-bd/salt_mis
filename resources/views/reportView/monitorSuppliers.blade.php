
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('monitor-supplier-pdf/'.$starDate.'/'.$endDate) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Monitor Supplier</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>SL</th>
                <th>Type of Supplier</th>
                <th>Name of Supplier</th>
                <th>Purchase Amount (KG)</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($monitorSuppliers as $monitorSupplier)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$monitorSupplier->LOOKUPCHD_NAME}}</td>
                    <td>{{$monitorSupplier->TRADER_NAME}}</td>
                    <td>{{$monitorSupplier->QTY}}</td>
                </tr>
            @endforeach
            @if(sizeof($monitorSuppliers)==0)
                <tr>
                    <th class="text-danger" colspan="5">
                        <h5>Data not found !</h5>
                    </th>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>

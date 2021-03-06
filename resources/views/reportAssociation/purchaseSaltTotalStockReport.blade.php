
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row addexcelbutton" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('purchase-salt-total-stock-pdf') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Total Purchase Stock</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Item Type</th>
                <th>Item Name</th>
                <th>Purchase Quantity (KG)</th>
            </tr>

            </thead>

            <tbody>
            @foreach($purchaseSaltTotalStock as $sl =>  $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->LOOKUPCHD_NAME}}</td>
                    <td>{{$row->ITEM_NAME}}</td>
                    <td>{{$row->STOCK_QTY}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

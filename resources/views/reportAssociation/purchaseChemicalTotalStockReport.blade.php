
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row addexcelbutton" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('purchase-chemical-total-stock-pdf/'.$millTypeAdmin) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Purchase Stock</h4>
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
                <th>Stock Quantity (KG) </th>
            </tr>

            </thead>

            <tbody>
            @foreach($purchaseChemicalTotalStock as $sl =>  $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->LOOKUPCHD_NAME}}</td>
                    <td>{{$row->ITEM_NAME}}</td>
                    <td>{{sprintf('%0.2f',$row->STOCK_QTY)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

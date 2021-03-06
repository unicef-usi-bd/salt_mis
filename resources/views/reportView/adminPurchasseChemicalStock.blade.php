
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row addexcelbutton" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('chemical-purchase-stock-pdf/'.$millTypeAdmin) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Purchase Stocks</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>SL</th>
                <th>Item Name</th>
                <th>Total Purchase Amount (KG)</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($purchaseChemicalStocks as $purchaseChemicalStock)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$purchaseChemicalStock->ITEM_NAME}}</td>
                    <td>{{number_format($purchaseChemicalStock->STOCK_QTY, 2)}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

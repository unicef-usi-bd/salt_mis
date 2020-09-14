
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('total-sale-admin-pdf/'.$processType) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Total Sale</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Items Type</th>
                <th>Items Name</th>
                <th>Division</th>
                <th>District</th>
                <th>Client Name</th>
                <th>Sales Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php $sl=0;?>
            @foreach($totalSale as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->ITEM_TYPE_NAME}}</td>
                    <td>{{$row->ITEM_NAME}}</td>
                    <td>{{$row->DIVISION_NAME}}</td>
                    <td>{{$row->DISTRICT_NAME}}</td>
                    <td>{{$row->TRADER_NAME}}</td>
                    <td>{{abs($row->QTY)}}</td>
                </tr>
            @endforeach
            @if(sizeof($totalSale)==0)
                <tr>
                    <td class="text-danger center" colspan="5">Data not found !</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>

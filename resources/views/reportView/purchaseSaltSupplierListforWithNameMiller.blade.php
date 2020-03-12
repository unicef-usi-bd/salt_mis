
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('purchase-salt-supplier-miller-type-pdf/'.$divisionId.'/'.$districtId) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>List Of Supplier</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Supplier type</th>
                <th>Supplier Name</th>
                <th>Division</th>
                <th>District</th>
                <th>Total Volume</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($supplierMillerLisType as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->supplier_type}}</td>
                    <td>{{$row->TRADING_NAME}}</td>
                    <td>{{$row->DIVISION_NAME}}</td>
                    <td>{{$row->DISTRICT_NAME}}</td>
                    <td>{{$row->QTY}}</td>
                </tr>
            @endforeach
            @if(sizeof($supplierMillerLisType)==0)
                <tr>
                    <th class="text-danger" colspan="6">
                        <h5>Data not found !</h5>
                    </th>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>

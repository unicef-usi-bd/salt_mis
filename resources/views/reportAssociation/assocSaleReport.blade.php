
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('association-sale-pdf/'.$divisionId.'/'.$districtId) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
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
                <th>Number of Millers</th>
                <th>Items Type</th>
                <th>Items Name</th>
                <th>Division</th>
                <th>District</th>
                <th>Sales Amount</th>

            </tr>

            </thead>

            <tbody>
            @foreach($assocSale as $sl =>  $row)
                <tr>
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->cnt_miller}}</td>
                    <td>{{$row->ITEM_TYPE_NAME}}</td>
                    <td>{{$row->ITEM_NAME}}</td>
                    <td>{{$row->DIVISION_NAME}}</td>
                    <td>{{$row->DISTRICT_NAME}}</td>
                    <td>{{abs($row->QTY)}}</td>
                </tr>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
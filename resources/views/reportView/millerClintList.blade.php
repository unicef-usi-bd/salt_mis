
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('clint-list-miller-pdf/'.$divisionId.'/'.$districtId) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>List Of Clint</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            {{--<tr>--}}
            {{--<th rowspan="2">No. of Established FIACs </th>--}}
            {{--<th colspan="12">No. of Farmers Visited FIAC</th>--}}
            {{--<th rowspan="2">Total Nos.</th>--}}
            {{--</tr>--}}
            <tr>
                <th>Sl.</th>
                <th>seller type</th>
                <th>seller name</th>
                <th>Division</th>
                <th>District</th>
                <th>Total Volume</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($clintList as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->seller_type}}</td>
                    <td>{{$row->TRADING_NAME}}</td>
                    <td>{{ $row->DIVISION_NAME }}</td>
                    <td>{{ $row->DISTRICT_NAME }}</td>
                    <td>{{ abs($row->QTY) }}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>

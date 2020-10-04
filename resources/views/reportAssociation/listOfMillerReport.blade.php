
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('list-of-miller-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>List of Mill</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Name of Mill </th>
                {{--<th>Item Name</th>--}}
                {{--<th>Purchases Volume</th>--}}
                {{--<th>Sales Volume</th>--}}

            </tr>

            </thead>

            <tbody>
            @foreach($millerList as $sl =>  $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ $row->MILL_NAME }}</td>
                    {{--<td>{{ $row->LOOKUPCHD_NAME }}</td>--}}
                    {{--<td>{{ $row->ITEM_NAME }}</td>--}}
                    {{--<td>{{ $row->purchase }}</td>--}}
                    {{--<td>{{ $row->reduce }}</td>--}}

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

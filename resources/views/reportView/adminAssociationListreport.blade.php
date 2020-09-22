
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('admin-association-list-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>List of Association</h4>
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
                <th>Sl</th>
                <th>Name of Association </th>
                <th>Total Raw salt Purchase </th>
                <th>Total Chemical Purchase </th>
                <th>Total Processed Salt sale</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($associationList as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->ASSOCIATION_NAME}}</td>
                    <td>{{$row->tot_purchase}}</td>
                    <td>{{$row->tot_chmical_pr}}</td>
                    <td>{{abs($row->tot_sales)}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>

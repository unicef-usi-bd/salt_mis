
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('monitor-association-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Monitor Association</h4>
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
                <td>Name of Association </td>
                <th>Number Of Millers</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($monitorAssociationLists as $monitor)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$monitor->ASSOCIATION_NAME }}</td>
                    <td>{{$monitor->Total_mill}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

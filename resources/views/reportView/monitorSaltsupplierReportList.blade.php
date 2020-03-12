
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('monitor-salt-report-pdf/'.$starDate.'/'.$endDate) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Monitor List</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl.</th>
                <th>Supplier type</th>
                <th>Supplier name</th>
                <th>Purchases volume</th>
            </tr>
            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($purchaseTotalSaltStock as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->LOOKUPCHD_NAME}}</td>
                    <td>{{$row->TRADER_NAME}}</td>
                    <td>{{$row->QTY}}</td>
                </tr>
            @endforeach
            @if(sizeof($purchaseTotalSaltStock)==0)
                <tr>
                    <th class="text-danger" colspan="4">
                        <h5>Data not found !</h5>
                    </th>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>

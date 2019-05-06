
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('association-total-miller-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
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
                <th>Mill Name</th>
                <th>Active Status</th>
            </tr>

            </thead>

            <tbody>
            @foreach($totalMiller as $sl =>  $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->MILL_NAME}}</td>
                    <td>
                        <?php if ($row->ACTIVE_FLG == 1){ ?>
                        <span class="label label-sm label-info arrowed arrowed-righ">Active</span>
                        <?php }else{ ?>
                        <span class="label label-sm label-danger arrowed arrowed-righ">Inactive </span>
                        <?php } ?>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

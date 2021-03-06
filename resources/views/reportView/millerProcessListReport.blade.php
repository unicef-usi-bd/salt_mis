
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row addexcelbutton" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('miller-process-list-pdf/'.$processType.'/'.$starDate.'/'.$endDate) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>List of Process</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>SL</th>
                <th>Process Type</th>
                <th>Batch No.</th>
                <th>Production Amount (KG)</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($millerProcessLists as $millerProcessList)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$millerProcessList->Process_Type}}</td>
                    <td>{{$millerProcessList->BATCH_NO}}</td>
                    <td>{{$millerProcessList->QTY}}</td>
                </tr>
            @endforeach
            @if(sizeof($millerProcessLists)==0)
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


<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('license-miller-list-pdf/'.$issueby) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
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
                <th>Millers Name</th>
                <th>License Type</th>
                <th>Issuer Name</th>
                <th>Issuing Date</th>
                <th>Renewing Date</th>
            </tr>

            </thead>

            <tbody>
            @foreach($MillerList as $sl =>  $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->MILL_NAME}}</td>
                    <td>{{$row->CERT_NAME}}</td>
                    <td>{{$row->ISSUER}}</td>
                    <td>{{$row->ISSUING_DATE}}</td>
                    <td>{{$row->RENEWING_DATE}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row addexcelbutton" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('miller-under-association-pdf/'.$zone) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>List of Mill</h4>
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
                <th>SL</th>
                <th>Name Mill </th>
                <th>Total Number of Employees </th>
                <th>Number of Full-Time Employees </th>
                <th>Number of Part-Time Employees</th>
                <th>Number of Technical People</th>
            </tr>

            </thead>

            <tbody>
            <?php $sl=0;?>
            @foreach($totalMiller as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->MILL_NAME}}</td>
                    <td>{{$row->tot_emp}}</td>
                    <td>{{$row->fulltime_emp}}</td>
                    <td>{{$row->parttime_enp}}</td>
                    <td>{{$row->tot_tech_person}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>

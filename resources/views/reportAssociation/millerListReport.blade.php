
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row addexcelbutton" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('association-miller-list-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
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
                <th>Total Number of Employees</th>
                <th>Numnber of Full-Time Employees</th>
                <th>Numnber of Part-Time Employees</th>
                <th>Numnber of Technical People</th>
            </tr>

            </thead>

            <tbody>
            @foreach($MillerList as $sl =>  $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->MILL_NAME}}</td>
                    <td>{{$row->TOTMALE_EMP + $row->TOTFEM_EMP}} </td>
                    <td>{{$row->FULLTIMEMALE_EMP + $row->FULLTIMEFEM_EMP}} </td>
                    <td>{{$row->PARTTIMEMALE_EMP + $row->PARTTIMEFEM_EMP}} </td>
                    <td>{{$row->TOTMALETECH_PER + $row->TOTFEMTECH_PER}} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

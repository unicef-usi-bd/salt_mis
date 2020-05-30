
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('total-sale-admin-pdf/'.$processType) }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>Total Sale</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl.</th>
                <th width="100px">Number of Millers</th>
                <th>Items Type</th>
                <th>Items Name</th>
                <th>Division</th>
                <th>District</th>
                <th>Sales Amount</th>
            </tr>

            </thead>

            <tbody>
            @if(sizeof($totalSale)>0)
            @php $sl=0; @endphp
            @foreach($totalSale as $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td class="text-center">{{$row->cnt_miller}}</td>
                    <td>{{$row->ITEM_TYPE_NAME}}</td>
                    <td>{{$row->ITEM_NAME}}</td>
                    <td>{{$row->DIVISION_NAME}}</td>
                    <td>{{$row->DISTRICT_NAME}}</td>
                    <td class="text-right">{{number_format(abs($row->QTY), 2)}}</td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td class="text-danger text-center" colspan="7"><h4>Oops, Data Not Found</h4></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>

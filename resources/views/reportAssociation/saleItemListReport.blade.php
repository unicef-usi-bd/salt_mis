
<style>
    .table th{
        text-align: center;
    }
</style>

<div class="row addexcelbutton" style="margin-bottom: 15px;">
    <a style="margin-right: 15px;margin-bottom: 10px;" href="{{ url('sale-item-list-pdf/') }}" target="_blank" class="btn btn-primary btn-xs pull-right"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
    <div class="col-md-12 center">
        <h4>List of Item</h4>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 table-responsive">
        <table id="simple-table" class="table table-bordered table-hover" style="font-size: 9px;">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Item Type</th>
                <th>Item Name</th>
            </tr>

            </thead>

            <tbody>
            @foreach($itemList as $sl =>  $row)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{$row->IT_TYPE}}</td>
                    <td>{{$row->ITEM_NAME}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

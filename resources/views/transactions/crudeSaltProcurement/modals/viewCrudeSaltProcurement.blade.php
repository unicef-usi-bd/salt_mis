<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
        <h4 class="center text-success">Details </h4>
        {{--<h4 class="center text-success">{{ trans('dashboard.details') }} </h4>--}}
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th class=" ">Crude Salt Type</th>
                    <th> :</th>
                    <td>{{ $crudeSaltShow->ITEM_NAME }} </td>
                    <th class=" ">Source</th>
                    <th> :</th>
                    <td>{{ $crudeSaltShow->LOOKUPCHD_NAME }} </td>

                </tr>
                <tr>
                    <th class=" ">Invoice No</th>
                    <th> :</th>
                    <td>{{ $crudeSaltShow->INVOICE_NO }} </td>
                    <th class=" ">Trading Name</th>
                    <th> :</th>
                    <td>{{ $crudeSaltShow->TRADING_NAME }} </td>
                </tr>
                <tr>
                    <th class=" ">Amount</th>
                    <th> :</th>
                    <td>{{ $crudeSaltShow->RCV_QTY }} </td>
                </tr>
            </table>
        </div>
        <div class="space"></div>
    </div>
</div>
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
                    <th class=" ">Purchase Date</th>
                    <th> :</th>
                    <td>{{ $chemicalPurchaseView->RECEIVE_DATE }} </td>
                    <th class=" ">Procurement Chemical</th>
                    <th> :</th>
                    <td>{{ $chemicalPurchaseView->ITEM_NAME }} </td>

                </tr>
                <tr>
                    <th class=" ">Amount</th>
                    <th> :</th>
                    <td>{{ $chemicalPurchaseView->RCV_QTY }} </td>
                    <th class=" ">Chemical Source</th>
                    <th> :</th>
                    <td>{{ $chemicalPurchaseView->TRADING_NAME }} </td>

                </tr>
                <tr>
                    <th class=" ">REMARKS</th>
                    <th> :</th>
                    <td>{{ $chemicalPurchaseView->REMARKS }} </td>
                </tr>
            </table>
        </div>
        <div class="space"></div>
    </div>
</div>
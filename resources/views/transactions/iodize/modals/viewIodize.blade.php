<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
        <h4 class="center text-success">Details</h4>
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th>Batch Number</th>
                    <th> :</th>
                    <td>{{$viewIodize->BATCH_NO}}</td>
                    <th>Date</th>
                    <th> :</th>
                    <td>{{$viewIodize->BATCH_DATE}}</td>
                </tr>
                <tr>
                    <th>Salt Amount</th>
                    <th> :</th>
                    <td>{{$viewIodize->WASH_CRASH_QTY}}</td>
                    <th>Chemical Amount</th>
                    <th> :</th>
                    <td>{{$viewIodize->REQ_QTY}}</td>
                </tr>
            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
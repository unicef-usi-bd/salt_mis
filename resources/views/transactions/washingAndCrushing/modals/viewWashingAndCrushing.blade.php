<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
        <h4 class="center text-success">{{ trans('dashboard.details') }}</h4>
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th>Batch No.</th>
                    <th> :</th>
                    <td>{{$viewWashingAndCrushing->BATCH_NO}}</td>
                    <th>Date</th>
                    <th> :</th>
                    <td>{{date("d-m-Y", strtotime($viewWashingAndCrushing->BATCH_DATE))}}</td>
                </tr>
                <tr>
                    <th>Crude Salt Type </th>
                    <th> :</th>
                    <td>{{$viewWashingAndCrushing->ITEM_NAME}}</td>
                    <th>Amount (KG)</th>
                    <th> :</th>
                    <td>{{$viewWashingAndCrushing->REQ_QTY}}</td>

                </tr>
                <tr>
                    <th>Remarks</th>
                    <th> :</th>
                    <td>{{$viewWashingAndCrushing->REMARKS}}</td>

                </tr>
            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
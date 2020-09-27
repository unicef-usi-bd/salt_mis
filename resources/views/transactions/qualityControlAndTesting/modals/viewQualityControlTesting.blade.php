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
                    <th>Purchase Date</th>
                    <th> :</th>
                    <td>{{date('d-m-Y',strtotime($viewQualityConteol->QC_DATE))}}</td>
                    <th>Quality Control By</th>
                    <th> :</th>
                    <td>{{$viewQualityConteol->qc}}</td>
                </tr>
                <tr>
                    <th>Agency</th>
                    <th> :</th>
                    <td>{{$viewQualityConteol->agency}}</td>
                    <th>Batch No.</th>
                    <th> :</th>
                    <td>{{$viewQualityConteol->BATCH_NO}}</td>
                </tr>
            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
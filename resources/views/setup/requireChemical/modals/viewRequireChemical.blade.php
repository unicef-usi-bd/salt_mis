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
                    <th>Chemical Type</th>
                    <th> :</th>
                    <td>{{$viewRequiredPerkg->ITEM_NAME}}</td>
                    <th>Salt Amount</th>
                    <th> :</th>
                    <td>{{$viewRequiredPerkg->SALT_AMOUNT}}</td>
                </tr>
                <tr>
                    <th>Chemical Amount</th>
                    <th> :</th>
                    <td>{{$viewRequiredPerkg->CHEMICAL_AMOUNT}}</td>
                    <th>Wastage Amount</th>
                    <th> :</th>
                    <td>{{$viewRequiredPerkg->WASTAGE_AMOUNT}}</td>
                </tr>
                <tr>
                    <th>Active Status</th>
                    <th> :</th>
                    <td>
                        @if($viewRequiredPerkg->ACTIVE_FLG==1)
                            <span class="label label-md label-info arrowed arrowed-righ"> Active </span>
                        @else
                            <span class="label label-md label-danger arrowed arrowed-righ"> Inactive </span>
                        @endif
                    </td>
                </tr>

            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
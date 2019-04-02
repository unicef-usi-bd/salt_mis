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
                    <th>Item Type </th>
                    <th> :</th>
                    <td>{{$viewItem->LOOKUPCHD_NAME}}</td>
                    <th>Item Name</th>
                    <th> :</th>
                    <td>{{$viewItem->ITEM_NAME}}</td>
                </tr>

                <tr>
                    <th>Active Status</th>
                    <th> :</th>
                    <td>
                        @if($viewItem->ACTIVE_FLG==1)
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
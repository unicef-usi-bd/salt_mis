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
                    <th class=" ">Chemical Type</th>
                    <th> :</th>
                    <td>{{ $showRequireChemicalPerKgchd->ITEM_NAME}} </td>
                    <th class=" ">Chemical Amount</th>
                    <th> :</th>
                    <td>{{ $showRequireChemicalPerKgchd->USE_QTY}} gm</td>
                </tr>
                <tr>
                    <th class=" ">Salt Amount</th>
                    <th> :</th>
                    <td>{{ $showRequireChemicalPerKgchd->CRUDE_SALT}} KG</td>
                    <th>Status</th>
                    <th> :</th>
                    <td>
                        @if($showRequireChemicalPerKgchd->ACTIVE_FLG==1)
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
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
                    <th>Crude Salt Type </th>
                    <th> :</th>
                    <td>{{$viewCrudSaltDetail->ITEM_NAME}}</td>
                    <th>Chloride content (as NaCl), %m/m</th>
                    <th> :</th>
                    <td>{{$viewCrudSaltDetail->SODIUM_CHLORIDE}}</td>
                </tr>
                <tr>
                    <th>Moisture, %m/m</th>
                    <th> :</th>
                    <td>{{$viewCrudSaltDetail->MOISTURIZER}}</td>
                    <th>Iodine content, mg/kg</th>
                    <th> :</th>
                    <td>{{$viewCrudSaltDetail->PPM}}</td>

                </tr>
                <tr>
                    <th>pH Value</th>
                    <th> :</th>
                    <td>{{$viewCrudSaltDetail->PH}}</td>
                    <th>Status</th>
                    <th> :</th>
                    <td>
                        @if($viewCrudSaltDetail->ACTIVE_FLG==1)
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
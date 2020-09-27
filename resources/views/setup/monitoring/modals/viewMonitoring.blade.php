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
                    <th class=" ">Agency Name</th>
                    <th> :</th>
                    <td>{{ trans($viewMonitoring->LOOKUPCHD_NAME) }} </td>
                    <th class=" ">Monitoring Date</th>
                    <th> :</th>
                    <td>{{ trans(date('d-m-Y',strtotime($viewMonitoring->MOMITOR_DATE))) }} </td>

               </tr>
                <tr>
                    <th class=" ">Remarks</th>
                    <th> :</th>
                    <td>{{ trans($viewMonitoring->REMARKS) }} </td>

                </tr>

            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
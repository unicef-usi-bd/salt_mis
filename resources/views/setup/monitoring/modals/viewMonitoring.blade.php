<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
        <h4 class="center text-success">View Monitoring Details </h4>
        {{--<h4 class="center text-success">{{ trans('dashboard.details') }} </h4>--}}
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th class="center fixedWidth">Agency Name</th>
                    <th class="center fixedWidth">Monitoring Date</th>
                    <th class="center fixedWidth">Remarks</th>
               </tr>
                <tr>
                    <th>{{ trans($viewMonitoring->LOOKUPCHD_NAME) }} </th>
                    <th>{{ trans($viewMonitoring->MOMITOR_DATE) }} </th>
                    <th>{{ trans($viewMonitoring->REMARKS) }} </th>
                 </tr>

            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
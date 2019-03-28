<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
        <h4 class="center text-success">{{ trans('dashboard.details') }} </h4>
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th>{{ trans('lookupGroupIndex.group_data_name') }} </th>
                    <th> :</th>
                    <td>{{$lookupGroupData->group_data_name}}</td>
                    <th>{{ trans('lookupGroupIndex.abbreviation') }}   </th>
                    <th> :</th>
                    <td>{{$lookupGroupData->group_data_abbr}}</td>

                </tr>
                <tr>
                    <th>{{ trans('lookupGroupIndex.user_define_id') }} </th>
                    <th> :</th>
                    <td>{{$lookupGroupData->user_define_id}}</td>
                    <th>{{ trans('lookupGroupIndex.status') }}</th>
                    <th> :</th>
                    <td>
                        @if($lookupGroupData->active_status==1)
                            <span class="label label-md label-info arrowed arrowed-righ"> Active </span>
                        @else
                            <span class="label label-md label-danger arrowed arrowed-righ"> Inactive </span>
                        @endif
                    </td>

                </tr>
                <tr>
                    <th>{{ trans('lookupGroupIndex.description') }} </th>
                    <th> :</th>
                    <td>{{$lookupGroupData->description}}</td>
                </tr>
            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
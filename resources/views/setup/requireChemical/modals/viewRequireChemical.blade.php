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
                    {{--<td>{{$union->cost_center_name}}</td>--}}
                    <th>Salt Name</th>
                    <th> :</th>
                    {{--<td>{{$union->union_name}}</td>--}}
                </tr>
                <tr>
                    <th>Status</th>
                    <th> :</th>
                    {{--<td>{{$union->union_name_bn}}</td>--}}
                    {{--<th>{{ trans('union.code') }} </th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>--}}
                        {{--{{$union->union_code}}--}}
                    {{--</td>--}}
                </tr>
                {{--<tr>--}}
                    {{--<th>{{ trans('union.active_status') }}</th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>--}}
                        {{--@if($union->active_status==1)--}}
                            {{--<span class="label label-md label-info arrowed arrowed-righ"> Active </span>--}}
                        {{--@else--}}
                            {{--<span class="label label-md label-danger arrowed arrowed-righ"> Inactive </span>--}}
                        {{--@endif--}}
                    {{--</td>--}}
                {{--</tr>--}}

            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
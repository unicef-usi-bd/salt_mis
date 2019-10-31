

<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
        <h4 class="center text-success">Expired Mill Information </h4>
        <div class="row table-responsive">
            <table class="table">
                <tr style="margin-left: 200%;">
                    <th>Renewing Date </th>
                    <th> :</th>
                    <td style="background-color: red;  font-weight: bolder; color: white;">{{$millInfo->RENEWING_DATE}}</td>
                </tr>
                <tr>
                    <th>Mill Name</th>
                    <th> :</th>
                    <td>{{$millInfo->MILL_NAME}}</td>
                    <th>Process Type</th>
                    <th> :</th>
                    <td>{{$millInfo->ProcessType}}</td>

                </tr>

                <tr>
                    <th>Zone </th>
                    <th> :</th>
                    <td>{{$millInfo->ZONE_NAME}}</td>
                    <th>Millers ID </th>
                    <th> :</th>
                    <td>{{$millInfo->MILLERS_ID}}</td>


                </tr>
                <tr>
                    <th>Type Of Owner</th>
                    <th> :</th>
                    <td>
                        {{$millInfo->ownerType}}
                    </td>
                    {{--<th>{{ trans('user.address') }}</th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>--}}
                        {{--{{$userView->address}}--}}
                    {{--</td>--}}

                </tr>
                {{--<tr>--}}
                    {{--<th>{{ trans('user.cost_center') }}</th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>--}}
                        {{--{{$userView->cost_center_name}}--}}
                    {{--</td>--}}
                    {{--<th>{{ trans('user.remark') }}</th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>--}}
                        {{--{{$userView->remarks}}--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<th>{{ trans('user.image') }}</th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>--}}
                        {{--<img src="{{asset($userView->user_image)}}" class="image-responsive" height="80px" width="90px">--}}
                    {{--</td>--}}
                    {{--<th>{{ trans('user.signature') }}</th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>--}}
                        {{--<img src="{{ asset($userView->user_signature) }}" height="80px" width="90px">--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<th>{{ trans('user.status') }} </th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>--}}
                        {{--@if($userView->active_status==1)--}}
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

<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="col-md-12">
    <div class="error-container">
        <h4 class="center text-success">{{ trans('user.details') }}</h4>
        <div class="row table-responsive">
            <table class="table">
                <tr>
                    <th>{{ trans('user.user_full_name') }}</th>
                    <th> :</th>
                    <td>{{$userView->user_full_name}}</td>
                    <th>{{ trans('user.user_name') }} </th>
                    <th> :</th>
                    <td>{{$userView->username}}</td>

                </tr>
                <tr>
                    <th>{{ trans('user.designation') }} </th>
                    <th> :</th>
                    <td>{{$userView->designation}}</td>
                    <th>{{ trans('user.email') }} </th>
                    <th> :</th>
                    <td>{{$userView->email}}</td>


                </tr>
                <tr>
                    <th>{{ trans('user.contact_no') }}</th>
                    <th> :</th>
                    <td>
                        {{$userView->contact_no}}
                    </td>
                    <th>{{ trans('user.address') }}</th>
                    <th> :</th>
                    <td>
                        {{$userView->address}}
                    </td>

                </tr>
                <tr>
                    <th>Centre</th>
                    <th> :</th>
                    <td>
                        {{$userView->ASSOCIATION_NAME}}
                    </td>
                    <th>{{ trans('user.remark') }}</th>
                    <th> :</th>
                    <td>
                        {{$userView->remarks}}
                    </td>
                </tr>
                <tr>
                    <th>{{ trans('user.image') }}</th>
                    <th> :</th>
                    <td>
                        <img src="{{asset($userView->user_image)}}" class="image-responsive" height="80px" width="90px">
                    </td>
                    <th>{{ trans('user.signature') }}</th>
                    <th> :</th>
                    <td>
                        <img src="{{ asset('/'.$userView->user_signature) }}" height="80px" width="90px">
                    </td>
                </tr>
                <tr>
                    <th>{{ trans('user.status') }} </th>
                    <th> :</th>
                    <td>
                        @if($userView->active_status==1)
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
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
                    <th>{{ trans('emailTemplete.email_type_name') }} </th>
                    <th> :</th>
                    <td>{{$emailTemplate->group_data_name}}</td>
                    <th>{{ trans('emailTemplete.subject') }}</th>
                    <th> :</th>
                    <td>{{$emailTemplate->email_subject}}</td>

                </tr>
                <tr>
                    <th>{{ trans('lookupGroupIndex.description') }}</th>
                    <th> :</th>
                    <td>{!! $emailTemplate->email_body !!}</td>
                    <th>{{ trans('cigGroup.active_status') }}</th>
                    <th> :</th>
                    <td>
                        @if($emailTemplate->active_status==1)
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
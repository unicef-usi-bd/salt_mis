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
                    <th>Certificate Name </th>
                    <th> :</th>
                    <td>{{$issuerView->CERTIFICATE_NAME}}</td>
                    <th>Issuer Name</th>
                    <th> :</th>
                    <td>{{$issuerView->LOOKUPCHD_NAME}}</td>
                </tr>
                <tr>
                    <th>Certificate Type</th>
                    <th> :</th>
                    <td>
                        @if($issuerView->CERTIFICATE_TYPE==1)
                            <span class="label label-md label-info arrowed arrowed-righ">Mandatory </span>
                        @else
                            <span class="label label-md label-danger arrowed arrowed-righ"> Not Mandatory </span>
                        @endif
                    </td>

                </tr>

                <tr>
                    <th>Active Status</th>
                    <th> :</th>
                    <td>
                        @if($issuerView->ACTIVE_FLG==1)
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
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
                    <th class=" ">Trading Name</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->TRADING_NAME) }} </td>
                    <th class=" ">Trader Name</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->TRADER_NAME) }} </td>

                </tr>
                <tr>
                    <th class=" ">Supplier ID</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->SUPPLIER_ID) }} </td>
                    <th class=" ">Trade licence No</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->LICENCE_NO) }} </td>

                </tr>
                <tr>
                    <th class=" ">Division Name</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->DIVISION_NAME) }} </td>
                    <th class=" ">District Name</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->DISTRICT_NAME) }} </td>

                </tr>
                <tr>
                    <th class=" ">Upazila/Thana Name</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->UPAZILA_NAME) }} </td>
                    <th class=" ">Union Name</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->UNION_NAME) }} </td>

                </tr>
                <tr>
                    <th class=" ">Phone Number</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->PHONE) }} </td>
                    <th class=" ">Email</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->EMAIL) }} </td>

                </tr>
                <tr>
                    <th class=" ">Bazar Name</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->BAZAR_NAME) }} </td>
                    <th class=" ">Remarks</th>
                    <th> :</th>
                    <td>{{ trans($viewSupplierProfile->REMARKS) }} </td>

                </tr>

                <tr>
                    <th class="">Supplier Type</th>
                    <th> :</th>
                    <td>{{ $viewSupplierProfile->LOOKUPCHD_NAME }}</td>
                </tr>

            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
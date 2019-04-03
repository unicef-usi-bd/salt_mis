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
                    <td>{{ $viewSellerDistributor->TRADING_NAME }} </td>
                    <th class=" ">Trader Name</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->TRADER_NAME }} </td>

                </tr>
                <tr>
                    <th class=" ">Supplier ID</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->SELLER_ID }} </td>
                    <th class=" ">Trade licence No</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->LICENCE_NO }} </td>

                </tr>
                <tr>
                    <th class=" ">Division Name</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->DIVISION_NAME }} </td>
                    <th class=" ">District Name</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->DISTRICT_NAME }} </td>

                </tr>
                <tr>
                    <th class=" ">Upazila/Thana Name</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->UPAZILA_NAME }} </td>
                    <th class=" ">Union Name</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->UNION_NAME }} </td>

                </tr>
                <tr>
                    <th class=" ">Phone Number</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->PHONE }} </td>
                    <th class=" ">Email</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->EMAIL }} </td>

                </tr>
                <tr>
                    <th class=" ">Bazar Name</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->BAZAR_NAME }} </td>
                    <th class=" ">Remarks</th>
                    <th> :</th>
                    <td>{{ $viewSellerDistributor->REMARKS }} </td>

                </tr>

            </table>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th >Coverage Division</th>
                    <th>Coverage District</th>
                    <th >Coverage Upizala/Thana</th>
                </tr>
                </thead>
                <tbody>
                @foreach($editsellerProfilearray as $seller)
                    <tr>
                        <td>
                                <span class="block input-icon input-icon-right">
                                    {{ $seller->DIVISION_NAME }}
                                </span>
                        </td>
                        <td>
                                <span class="block input-icon input-icon-right">
                                    {{ $seller->DISTRICT_NAME }}

                                </span>
                        </td>

                        <td>
                                <span class="block input-icon input-icon-right">
                                    {{ $seller->UPAZILA_NAME }}
                                </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
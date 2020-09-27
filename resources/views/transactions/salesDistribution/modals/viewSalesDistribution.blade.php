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
                    <th>Seller Type</th>
                    <th> :</th>
                    <td>{{$viewSalersDistributor->LOOKUPCHD_NAME}}</td>
                    <th>Trading Name
                    </th>
                    <th> :</th>
                    <td>{{$viewSalersDistributor->TRADING_NAME}}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <th> :</th>
                    <td>{{date('d-m-Y',strtotime($viewSalersDistributor->SALES_DATE))}}</td>
                </tr>
                <tr>
                    <th>Driver Name</th>
                    <th> :</th>
                    <td>{{$viewSalersDistributor->DRIVER_NAME}}</td>
                    <th>Vehicle No.</th>
                    <th> :</th>
                    <td>{{$viewSalersDistributor->VEHICLE_NO}}</td>
                </tr>
                <tr>
                    <th>Vehicle License</th>
                    <th> :</th>
                    <td>{{$viewSalersDistributor->VEHICLE_LICENSE}}</td>
                    <th>Transport Name</th>
                    <th> :</th>
                    <td>{{$viewSalersDistributor->TRANSPORT_NAME}}</td>
                </tr>
                <tr>
                    <th>Mobile No.</th>
                    <th> :</th>
                    <td>{{$viewSalersDistributor->MOBILE_NO}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th >Processed Salt Type</th>
                    <th>Item Name (Package)</th>
                    <th >Quantity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($viewSalersDistributorChd as $saler)
                    <tr>
                        <td>
                                <span class="block input-icon input-icon-right">
                                    {{ $saler->ITEM_NAME }}
                                </span>
                        </td>
                        <td>
                                <span class="block input-icon input-icon-right">
                                    {{ $saler->LOOKUPCHD_NAME }}

                                </span>
                        </td>

                        <td>
                                <span class="block input-icon input-icon-right">
                                    {{ $saler->PACK_QTY }} pcs
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
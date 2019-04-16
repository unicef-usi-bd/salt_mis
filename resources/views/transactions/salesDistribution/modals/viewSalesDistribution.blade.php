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
                    <th>Item Nmae</th>
                    <th> :</th>
                    <td>{{$viewSalersDistributor->ITEM_NAME}}</td>
                    {{--<th>Date</th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>{{$viewSalersDistributor->SALES_DATE}}</td>--}}
                </tr>
                {{--<tr>--}}
                    {{--<th>Amount </th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>{{$viewSalersDistributor->LOOKUPCHD_NAME}}</td>--}}
                    {{--<th>Quantity</th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>{{$viewSalersDistributor->PACK_QTY}} pcs</td>--}}

                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<th>Remarks</th>--}}
                    {{--<th> :</th>--}}
                    {{--<td>{{$viewWashingAndCrushing->REMARKS}}</td>--}}

                {{--</tr>--}}
            </table>
        </div>

        <div class="space"></div>
    </div>
</div>
<div class="col-md-12">
    <form  action="{{ url('/sales-distribution') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Seller
                        Type</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess SELLER_TYPE" class="form-control SELLER_TYPE"
                        name="SELLER_TYPE" data-placeholder=" -Select-">
                   <option value="">-Select-</option>
                    @foreach($sellerType as $seller)
                        <option value="{{$seller->LOOKUPCHD_ID}}"> {{$seller->LOOKUPCHD_NAME}}</option>
                    @endforeach
                </select>
            </span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Date</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess SALES_DATE" readonly placeholder=" " name="SALES_DATE" class="form-control col-xs-10 col-sm-5 date-picker" value="{{date('m/d/Y')}}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Trading
                        Name</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select id="form-field-select-3 inputSuccess CUSTOMER_ID" class="form-control tradeId"
                                name="CUSTOMER_ID" data-placeholder="Select Trading Name">
                            {{--@foreach($traderName as $row)--}}
                                {{--<option value="{{ $row->CUSTOMER_ID }}">{{ $row->TRADER_NAME }}</option>--}}
                            {{--@endforeach--}}
                        </select>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 15px;">
            <h4 style="color: #1B6AAA;">Transport Details</h4>
            <hr>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Driver Name</b><span
                                style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" id="inputSuccess DRIVER_NAME" placeholder="Example:- Driver Name Here"
                               name="DRIVER_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Vehicle
                            License</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" id="inputSuccess VEHICLE_LICENSE" placeholder="Example:- Vehicle License Here"
                               name="VEHICLE_LICENSE" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Mobile
                            No.</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" id="inputSuccess MOBILE_NO" placeholder="Example:- Mobile No. Here"
                               name="MOBILE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Driving
                            Licence</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" id="inputSuccess VEHICLE_NO" placeholder="Example:- Driving Licence Here"
                               name="VEHICLE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Transport
                            Fare</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input autocomplete="off" type="text" id="inputSuccess TRANSPORT_NAME" placeholder="Example:- Transport Fare Here"
                               name="TRANSPORT_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span
                                style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <textarea rows="3" placeholder="Example:- Remarks Here" name="REMARKS" class="form-control col-xs-10 col-sm-5"/></textarea>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12" style="margin-top: 15px;">
            <div class="col-md-4">
                <h4 class="pull-left" style="">Wash & Crushing Stock : <span class="currentStockWashCrush" data-quantity="{{ number_format($washingStock, 2) }}" style="color:red;">{{ number_format($washingStock, 2) }}</span> KG</h4>
            </div>
            <div class="col-md-4"><span class="alertMsgStock"></span></div>
            <div class="col-md-4">
                <h4 class="pull-right">Iodized Stock : <span class="currentStockIodize" data-quantity="{{ number_format($iodizeStock, 2) }}" style="color:red;">{{ number_format($iodizeStock, 2) }}</span> KG</h4>
            </div>
            <table class="table table-bordered fundAllocation">
                <thead>
                <tr>
                    <th style="width: 255px;"> Processed Salt Type<span style="color:red;"> *</span></th>
                    <th style="width: 255px;">Brand Name<span style="color: red;"></span></th>
                    {{--<th style="width: 255px;">Date<span style="color:red;"> </span></th>--}}
                    <th style="width: 255px;">Item Name (Package)<span style="color:red;"> *</span></th>
                    <th style="width: 255px;">Quantity (PCS)<span style="color:red;"> *</span></th>
                    <th style="width: 255px;">Total (KG)<span style="color:red;"> </span></th>

                    <th style="width: 30px;">
                        <span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span>
                    </th>
                </tr>
                </thead>
                <tbody class="salesTable">
                <tr class="rowFirst">
                    <td>
                        <span class="block input-icon input-icon-right" style="width: 180px;">
                            <select class="form-control saltType" id="ITEM_ID" name="ITEM_ID[]">
                                <option value="">Select</option>
                                @foreach($saltId as $row)
                                    <option value="{{ $row->ITEM_NO }}"> {{$row->ITEM_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </td>
                    <td>
                        <span class="block input-icon input-icon-right" style="width: 180px;">
                            <select class="form-control" id="brand_id" name="brand_id[]">
                                <option value="">Select</option>
                                @foreach($brandName as $row)
                                    <option value="{{$row->brand_id}}"> {{$row->brand_name}}</option>
                                @endforeach
                            </select>
                        </span>
                    </td>
                    <td>
                        <span class="block input-icon input-icon-right" style="width: 180px;">
                            <select class="form-control packType chosen-select" id="PACK_TYPE" name="PACK_TYPE[]">
                                <option value="">Select</option>
                                @foreach($saltPackTypes as $row)
                                    <option value="{{$row->LOOKUPCHD_ID.','.$row->DESCRIPTION}}"> {{$row->LOOKUPCHD_NAME}}</option>
                                @endforeach
                             </select>
                        </span>
                        <input type="hidden" placeholder=" " name="packNo" class="form-control col-xs-10 col-sm-5 pack"
                               value=""/>
                    </td>
                    <td>
                        <span class="block input-icon input-icon-right">
                            <input autocomplete="off" type="text" id="inputSuccess PACK_QTY" placeholder=" " name="PACK_QTY[]"
                                   class="form-control col-xs-10 col-sm-5 crudeSaltAmount"
                                   onkeypress="return numbersOnly(this, event)" value=""/>

                        </span>
                    </td>
                    <td>
                        <span class="block input-icon input-icon-right">
                            <input autocomplete="off" type="text" placeholder="" name="total" readonly
                                   class="form-control col-xs-10 col-sm-5 totalQty" value=""/>
                        </span>
                    </td>
                    <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix" style="margin-left: 150px;">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn test">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>

@include('masterGlobal.chosenSelect')
@include('masterGlobal.getDistrict')
@include('masterGlobal.getUpazila')
@include('masterGlobal.getUnion')
@include('masterGlobal.datePicker')
<script>
    //    Add For Multiple Row Dynamically
    $(document).ready(function () {
        $('.rowAdd').click(function () {
            let getTr = $('tr.rowFirst:first');
            //alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.salesTable').append("<tr class='removableRow'>" + getTr.html() + "</tr>");
            let defaultRow = $('tr.removableRow:last');
            defaultRow.find('.result').text('');
            defaultRow.find('.stockWashCrash').text('');
            $('.chosen-select').chosen(0);
        });
    });

    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        $(this).closest("tr.removableRow").remove();
    });

    $(document).on('change', '.saltType', function () {
        let thisRow = $(this).closest('tr');
        let saltTypeId = parseInt(thisRow.find('.saltType').val());
        console.log(saltTypeId);
    });

    $(document).on('change', '.packType', function () {
        let thisRow = $(this).closest('tr');
        checkValidation(thisRow);
    });

    $(document).on('keyup', '.crudeSaltAmount', function () {
        let thisRow = $(this).closest('tr');
        checkValidation(thisRow);
    });

//    Frontend Stock validations
    function checkValidation(thisRow) {
        let saltTypeId = parseInt(thisRow.find('.saltType').val());
        if(saltTypeId===7){
            let saltAmount = eachRowCalculation(saltTypeId);
            let stockScope = $('.currentStockWashCrush');
            let currentStock = parseFloat(stockScope.attr('data-quantity').replace(/,/g, ''));
            if(saltAmount>currentStock) {
                stockAlertHandler('Wash & Crushed');
                thisRow.find('.crudeSaltAmount').val('');
                thisRow.find('.totalQty').val('');
                return false;
            }
            let remainStock = currentStock-saltAmount;
            stockScope.html(remainStock.toFixed(2));
        } else if(saltTypeId===8){
            let saltAmount = eachRowCalculation(saltTypeId);
            let stockScope = $('.currentStockIodize');
            let currentStock = parseFloat(stockScope.attr('data-quantity').replace(/,/g, ''));
            if(saltAmount>currentStock) {
                stockAlertHandler('Iodized');
                thisRow.find('.crudeSaltAmount').val('');
                thisRow.find('.totalQty').val('');
                return false;
            }
            let remainStock = currentStock-saltAmount;
            stockScope.html(remainStock.toFixed(2));
        }
    }

//    For Error Message Show
    function stockAlertHandler(message=null) {
        let alertMessage = $('.alertMsgStock');
        let duration = 7000;
        alertMessage.empty().hide();
        if(message===null) return false;
        message = `<div class="alert alert-warning alert-dismissible" role="alert">
                      <strong>Alert !</strong> ${message} salt stock limited.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>`;
        alertMessage.delay(duration).append(message).show().fadeOut('very slow');
        return true;
    }

//    For Each Row element calculation
    function eachRowCalculation($saltType) {
        let thisRow;
        let eachSaltType;
        let saltAmount = 0;
        $('tbody.salesTable').find('tr').each(function () {
            let packType=0;
            let packets=0;
            thisRow = $(this);
            eachSaltType = parseInt(thisRow.find('.saltType').val());
            if($saltType===eachSaltType){
                packType = parseFloat(thisRow.find('.packType').val().split(',')[1] || 0);
                packets = parseFloat(thisRow.find('.crudeSaltAmount').val() || 0);
                thisRow.find('.totalQty').val(packType * packets);
                saltAmount += packType * packets;
            }
        });
        return saltAmount;
    }


    $(document).on("change", ".SELLER_TYPE", function () {
        let sellerTypeId = $(this).val();
        let tradeScope = $('.tradeId');
        let option = '<option value="">-Select-</option>';
        $.ajax({
            type: 'GET',
            url: 'trading-list',
            data: {'sellerTypeId': sellerTypeId},
            success: function (data) {
                for (let i = 0; i < data.length; i++) {
                    option = option + '<option value="' + data[i].CUSTOMER_ID + '">' + data[i].TRADER_NAME + '</option>';
                }
                tradeScope.html(option).trigger("chosen:updated");
            }
        })
    });
</script>



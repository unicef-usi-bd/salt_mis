<div class="col-md-12">

    {{--<div id="success" class="alert alert-block alert-success" style="display: none;">--}}
    {{--<span id="successMessage"></span>--}}
    {{--<button type="button" class="close" data-dismiss="alert">--}}
    {{--<i class="ace-icon fa fa-times"></i>--}}
    {{--</button>--}}
    {{--</div>--}}

    {{--<div id="error" class="alert alert-block alert-danger" style="display: none;">--}}
    {{--<span id="errorMessage"></span>--}}
    {{--</div>--}}
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>

    {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
    <form id="myform" action="{{ url('/sales-distribution') }}" method="post" class="form-horizontal" role="form">

            @csrf
            {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Seller Type</b><span style="color: red;"> *</span></label>
                    <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess SELLER_TYPE" class="form-control SELLER_TYPE" name="SELLER_TYPE" data-placeholder="Select Seller Type">
                   <option value="">--Select One--</option>
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
                        <input type="text" id="inputSuccess SALES_DATE" readonly placeholder=" " name="SALES_DATE" class="form-control col-xs-10 col-sm-5 date-picker" value="{{date('m/d/Y')}}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Trading Name</b><span style="color: red;"> *</span></label>
                    <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess CUSTOMER_ID" class="form-control CUSTOMER_ID" name="CUSTOMER_ID" data-placeholder="Select Trading Name">
                 <option value="">--Select One--</option>
                </select>
            </span>
                    </div>
                </div>

                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Phone Number</b><span style="color: red;"> </span> </label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<input type="text" id="inputSuccess PHONE" placeholder="Example: Phone Number here" name="PHONE" class="form-control col-xs-10 col-sm-5" value=""/>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        <div class="col-md-12" style="margin-top: 15px;">
            <h4  style="color: #1B6AAA;">Transport Details</h4>
            <hr>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Driver Name</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess DRIVER_NAME" placeholder="Example: Driver Name here" name="DRIVER_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Vehicle License</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess VEHICLE_LICENSE" placeholder="Example: Vehicle License here" name="VEHICLE_LICENSE" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Mobile Number</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess MOBILE_NO" placeholder="Example: Mobile Number here" name="MOBILE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Vehicle No</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess VEHICLE_NO" placeholder="Example: Vehicle No here" name="VEHICLE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Transport Name</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess TRANSPORT_NAME" placeholder="Example: Transport Name here" name="TRANSPORT_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <textarea rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-10 col-sm-5" /></textarea>
                    </div>
                </div>
            </div>

        </div>

        {{--<div class="col-md-12" style="margin-top: -30px;">--}}
        {{--<h2 class="left" style="margin-top: 30px;margin-bottom: 30px;">Address</h2>--}}
        {{--<hr style="margin-top: -25px;">--}}


        {{--</div>--}}

        {{--<div class="col-md-12">--}}
        {{--<hr>--}}

        {{--</div>--}}

        <div class="col-md-12" style="margin-top: 15px;">
            <div class="alert alert-danger alert-dismissible msg" style="display: none;">

            </div>
            <h4  style="color: #1B6AAA;"></h4>
            <hr>
            <table class="table table-bordered fundAllocation">
                <thead>
                <tr>
                    <th style="width: 255px;">Salt Type<span style="color:red;"> *</span></th>
                    {{--<th style="width: 255px;">Date<span style="color:red;"> </span></th>--}}
                    <th style="width: 255px;">Salt Package<span style="color:red;"> *</span></th>
                    <th style="width: 255px;">Quantity<span style="color:red;"> *</span></th>
                    <th style="width: 255px;">Total<span style="color:red;"> </span></th>
                    <th style="width: 255px;">Stock<span style="color:red;"> </span></th>

                    <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                </tr>
                </thead>
                <tbody class="newRow">
                <tr class="rowFirst">
                    <td>
                                <span class="block input-icon input-icon-right" style="width: 255px;">
                                    <select class="form-control saltType" id="ITEM_ID" name="ITEM_ID[]">
                                        <option value="">Select</option>
                                        @foreach($saltId as $row)
                                            <option value="{{$row->ITEM_NO}}"> {{$row->ITEM_NAME}}</option>
                                        @endforeach
                                    </select>
                                </span>
                    </td>

                    <td>
                        <span class="block input-icon input-icon-right" style="width: 255px;">
                        <select class="form-control packType" id="PACK_TYPE" name="PACK_TYPE[]">
                            <option value="">Select</option>
                            @foreach($saltPackId as $row)
                                <option value="{{$row->LOOKUPCHD_ID}}"> {{$row->LOOKUPCHD_NAME}}</option>
                            @endforeach
                         </select>
                    </span>
                        <input type="hidden" placeholder=" " name="packNo" class="form-control col-xs-10 col-sm-5 pack" value=""/>
                        {{--<input type="text" class="packSize" value="{{$pckSize->DESCRIPTION}}">--}}
                    </td>
                    {{--<td>--}}
                        {{--<input type="hidden" placeholder=" " name="packNo" class="form-control col-xs-10 col-sm-5 pack" value=""/>--}}
                    {{--</td>--}}
                    <td>
                        <span class="block input-icon input-icon-right">

                                <input type="text" id="inputSuccess PACK_QTY" placeholder=" " name="PACK_QTY[]" class="form-control col-xs-10 col-sm-5 crudeSaltAmount" value=""/>

                        </span>
                    </td>
                    <td>
                        <span class="block input-icon input-icon-right">
                            <input type="text" placeholder="" name="total" readonly class="form-control col-xs-10 col-sm-5 totalQty" value=""/>
                        </span>
                    </td>

                    <td>
                        <span class="block input-icon input-icon-right">

                                {{--<input type="text" id="inputSuccess " placeholder=" " name="" class="form-control col-xs-10 col-sm-5" value="" readonly="readonly"/>--}}
                            <span class="col-sm-12" style="margin-top: 6px;font-weight: bold;">(Stock have: <span class="stockWashCrash hidden"></span><span class="result"></span>KG)</span>
                            {{--<span class="col-sm-12" style="margin-top: 6px;font-weight: bold;">(Stock have: <span class="stockIodize"></span><span class="result"></span>)</span>--}}

                        </span>
                    </td>

                    <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                </tr>
                </tbody>
            </table>
        </div>

    <!-- <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('union.active_status') }}</b></label>
                <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="active_status">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
                </div>
            </div> -->

        <div class="clearfix" style="margin-left: 150px;">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn test">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'unions' }}">--}}
                <button type="submit" class="btn btn-primary">
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
{{--@include('masterGlobal.formValidation')--}}
<script>
    //    Add For Multiple Row Dynamically
    $(document).ready(function(){
        $('.rowAdd').click(function(){
            var getTr = $('tr.rowFirst:first');
            //alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            var defaultRow = $('tr.removableRow:last');
            defaultRow.find('.result').text('');
            defaultRow.find('.stockWashCrash').text('');
            $('.chosen-select').chosen(0);
        });
    });
    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        $(this).closest("tr.removableRow").remove();
    });


//for showing amount of salt in database using on change
    $('.stockWashCrash').hide();
    //$('.stockIodize').hide();
    $(document).on('change','.saltType',function(){
        var thisRow = $(this).closest('tr');
        var saltTypeId = thisRow.find('.saltType').val();
        var $washAndCrushId = '<?php echo $washAndCrushId; ?>';
        var centerId = '<?php echo Auth::user()->center_id; ?>';
        var $iodizeId = '<?php echo $iodizeId; ?>';
       // alert($washAndCrushId);

        if(saltTypeId == $washAndCrushId){
            $.ajax({
                type : 'GET',
                url : 'washing-crashing-stock',
                data : {'centerId':centerId},
                success: function (data) {
                  //  console.log(data);
                   var data = JSON.parse(data);
                    //$('.stockWashCrash').html(data).show();
                    thisRow.find('.stockWashCrash').html(data).show();
                    thisRow.find('.result').html(data);
                    thisRow.find('.crudeSaltAmount').val('');
                }
            })
        }
        if(saltTypeId == $iodizeId){
            $.ajax({
                type : 'GET',
                url : 'iodize-stock',
                data : {'centerId':centerId},
                success: function (data) {
                    var data = JSON.parse(data);
                    thisRow.find('.stockWashCrash').html(data).show();
                    thisRow.find('.result').html(data);
                    thisRow.find('.crudeSaltAmount').val('');
                }
            })
        }

    });

    $(document).on('change','.packType',function () {
        $('.pack_Id').text('');
        var packId = $(this).val();
//        var option = '<option value="">Select pack</option>';
//        var option = $('.pack_Id').text();
        //alert(packId);
        $.ajax({
            type:'GET',
            url:'get-packsize',
            data:{'packId':packId},
            success: function (data) {
                var data = JSON.parse(data);
                $('.pack').val(data.DESCRIPTION);
                console.log(data);
                //$('.pack_Id').show();
//                $('.packSize').html(data).show();
//                for (var i = 0; i < data.length; i++){
//                    option = option + '<option value="'+ data[i].DESCRIPTION +'">'+ data[i].DESCRIPTION+'</option>';
//                }
//                $('.pack_Id').text(option);
//                //$('.pack_Id').html(data.DESCRIPTION);
//                $('.pack_Id').trigger("chosen:updated");

            }
        });
    });

    $(document).on('keyup','.crudeSaltAmount',function () {
        var amount = parseInt($(this).val()) || 0;
        var packId = $('.pack').val();
        var result = parseInt(amount * packId);
        $('.totalQty').val(result);
        var saltStock = $('.stockWashCrash').text();
        var remainStock = saltStock - result;

        if(saltStock < result){
            $('.stockWashCrash').hide();
            $('.msg').html('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning !</strong> Stock Out Of bound.').fadeIn();
            $('.result').text(0);
            if(result === 0){
                $('.stockWashCrash').show();
            }
        }else{
            $('.stockWashCrash').hide();
            $('.result').text(remainStock);
        }
    });



    $(document).on("change",".SELLER_TYPE",function(){
        var sellerTypeId = $(this).val();
        var option = '<option value="">Select Trading Name</option>';
        $.ajax({
            type : 'GET',
            url : 'trading-list',
            data : {'sellerTypeId':sellerTypeId},
            success: function (data) {
//                var data = JSON.parse(data);
                for (var i = 0; i < data.length; i++){
                    option = option + '<option value="'+ data[i].CUSTOMER_ID +'">'+ data[i].TRADER_NAME+'</option>';
                }

                $('.CUSTOMER_ID').html(option);
                $('.CUSTOMER_ID').trigger("chosen:updated");
            }
        })
    });

    $(document).ready(function () {
        $.validator.addMethod(
            "regex",
            function(value, element, regexp)
            {
                if (regexp.constructor != RegExp)
                    regexp = new RegExp(regexp);
                else if (regexp.global)
                    regexp.lastIndex = 0;
                return this.optional(element) || regexp.test(value);
            },
            "Please check your input."
        );

        $('#myform').validate({ // initialize the plugin
            errorClass: "my-error-class",
            //validClass: "my-valid-class",
            rules: {
                SELLER_TYPE: {
                    required: true,
                },
                CUSTOMER_ID: {
                    required: true,
                },
                SALES_DATE:{
                    required: true,
                },
                DRIVER_NAME:{
                    required: true,
                },
                VEHICLE_LICENSE:{
                    required: true,
                },
                VEHICLE_NO:{
                    required: true,
                },
                TRANSPORT_NAME:{
                    required: true,
                },
                MOBILE_NO:{
                    required: true,
                    maxlength:11,
                    minlength:11,
                    regex:/^(?:\+?88)?01[15-9]\d{8}$/,
                },
                "ITEM_ID[]":{
                    required: true,
                },
                "PACK_TYPE[]":{
                    required: true,
                },
                "PACK_QTY[]":{
                    required: true,
                }
            }
        });

    });
</script>



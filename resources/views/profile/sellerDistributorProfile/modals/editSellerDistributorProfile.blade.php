<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>

    {{--<div id="error" class="alert alert-block alert-danger" style="display: none;">--}}
    {{--<span id="errorMessage"></span>--}}
    {{--</div>--}}

    {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
    <form action="{{ url('/seller-distributor-profile/'.$editSellerProfile->CUSTOMER_ID) }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf
            @method('PUT')
            {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Seller Type</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess SELLER_TYPE_ID" class="chosen-select form-control" name="SELLER_TYPE_ID"  data-placeholder="Select or search data">
                   <option value=""></option>
                    @foreach($sellerType as $row)
                        <option value="{{ $row->LOOKUPCHD_ID }}" @if($row->LOOKUPCHD_ID==$editSellerProfile->SELLER_TYPE_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                    @endforeach
                </select>
            </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Trading Name</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess TRADING_NAME" placeholder="Example: Trading Name here" name="TRADING_NAME" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->TRADING_NAME }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Trade Lience no</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess LICENCE_NO" placeholder="Example: Amount per KG here" name="LICENCE_NO" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->LICENCE_NO }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Seller Id</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess SELLER_ID" placeholder="Example: Amount per KG here" name="SELLER_ID" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->SELLER_ID }}" readonly/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Trader Name</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess TRADER_NAME" placeholder="Example: Auto Generate" name="TRADER_NAME" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->TRADER_NAME }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Phone Number</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess PHONE" placeholder="Example: Amount per KG here" name="PHONE" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->PHONE }}"/>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="col-md-12" style="margin-top: -30px;">--}}
        {{--<h2 class="left" style="margin-top: 30px;margin-bottom: 30px;">Address</h2>--}}
        {{--<hr style="margin-top: -25px;">--}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b><span style="color: red;"> </span></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control  chosen-select" id="DIVISION_ID" name="DIVISION_ID">
                            <option value="">{{ trans('organization.select_one') }}</option>
                            @foreach($getDivision as $row)
                                <option value="{{ $row->DIVISION_ID }}" @if($editSellerProfile->DIVISION_ID==$row->DIVISION_ID) selected @endif>{{ $row->DIVISION_NAME }}</option>
                            @endforeach
                        </select>
                    </span>

                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b><span style="color: red;"> </span></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control district chosen-select" id="DISTRICT_ID" name="DISTRICT_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editSellerProfile->DISTRICT_ID }}">{{ $editSellerProfile->DISTRICT_NAME }}</option>
                        </select>
                    </span>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1" style="margin-left: -2%;"><b>Upazila/Thana</b><span style="color: red;"> </span></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control upazila chosen-select" id="UPAZILA_ID" name="UPAZILA_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editSellerProfile->UPAZILA_ID }}">{{ $editSellerProfile->UPAZILA_NAME }}</option>
                        </select>
                    </span>

                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1" style="margin-left: -2%;"><b>Union</b><span style="color: red;"> </span></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control union chosen-select" id="UNION_ID" name="UNION_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editSellerProfile->UNION_ID }}">{{ $editSellerProfile->UNION_NAME }}</option>
                        </select>
                    </span>

                </div>
            </div>
        </div>
        {{--</div>--}}

        {{--<div class="col-md-12">--}}
        {{--<hr>--}}
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Bazar</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess BAZAR_NAME" placeholder="Example: Amount per KG here" name="BAZAR_NAME" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->BAZAR_NAME }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1" style="margin-left: -2%;"> <b>Email</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess EMAIL" placeholder="Example: Amount per KG here" name="EMAIL" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->EMAIL }}"/>
                </div>
            </div>
        </div>
        {{--</div>--}}

        <div class="col-md-12" style="margin-top: 15px;">
            <h4  style="color: #1B6AAA;">Coverage Area</h4>
            <hr>
            <table class="table table-bordered fundAllocation">
                <thead>
                <tr>
                    <th style="width: 255px;">Division<span style="color:red;"> </span></th>
                    <th style="width: 255px;">District<span style="color:red;"> </span></th>
                    <th style="width: 255px;">Upazila/Thana</th>
                    {{--<th style="width: 150px;">Problem</th>--}}

                    <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                </tr>
                </thead>
                <tbody class="newRow">
                @foreach($editsellerProfilearray as $seller)
                    <input type="hidden" name="COVERAGE_ID[]" value="{{ $seller->COVERAGE_ID }}">
                <tr class="rowFirst">
                    <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select COV_DIVISION_ID" id="COV_DIVISION_ID" name="COV_DIVISION_ID[]">
                                        <option value="">Select</option>
                                        @foreach($getDivision as $row)
                                            <option value="{{ $row->DIVISION_ID }}" @if($seller->COV_DIVISION_ID==$row->DIVISION_ID) selected @endif>{{ $row->DIVISION_NAME }}</option>
                                        @endforeach
                                    </select>
                                </span>
                    </td>
                    <td>
                               <span class="block input-icon input-icon-right">
                                    <select id="COV_DISTRICT_ID" class="chosen-select form-control districttable" name="COV_DISTRICT_ID[]" data-placeholder="Select or search data">
                                        <option value="{{ $seller->COV_DISTRICT_ID }}">{{ $seller->UPAZILA_NAME }}</option>
                                    </select>
                                </span>
                    </td>
                    <td>
                                <span class="block input-icon input-icon-right">
                                    <select id="COV_UPAZILA_ID" class="form-control chosen-select upazilatable" name="COV_UPAZILA_ID[]" data-placeholder="Select or search data">
                                        <option value="{{ $seller->COV_UPAZILA_ID }}">{{ $seller->UPAZILA_NAME }}</option>
                                     </select>
                                </span>
                    </td>


                    <td><span class="btn btn-danger btn-sm pull-right rowRemove btnRemove" data-fundAllocationChdId="{{ $seller->COVERAGE_ID }}"><i class="fa fa-remove"></i></span></td>
                </tr>
               @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-sm-1 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <textarea style="width: 139%"   rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-10 col-sm-5"  >{{ $editSellerProfile->REMARKS }}</textarea>
                </div>
            </div>
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
{{--@include('masterGlobal.formValidation')--}}
<script>
    //    Add For Multiple Row Dynamically
    $(document).ready(function(){
        $('.rowAdd').click(function(){
            var getTr = $("<tr class=\"rowFirst\">\n" +
                "                            <td>\n" +
                "                                <span class=\"block input-icon input-icon-right\">\n" +
//                "                                 <input type='hidden' name='fund_allocation_chd_id[]' value=''>"+
                "                                    <select class=\"form-control chosen-select COV_DIVISION_ID\" id=\"COV_DIVISION_ID\" name=\"COV_DIVISION_ID[]\" required >\n" +
                "                                        <option value=\"\">Select</option>\n" +
                "                                        @foreach($getDivision as $row)\n" +
                "                                            <option value=\"{{ $row->DIVISION_ID }}\"> {{ $row->DIVISION_NAME }}  </option>\n" +
                "                                        @endforeach\n" +
                "                                    </select>\n" +
                "                                </span>\n" +

                "                            </td>\n" +
                "                            <td>\n" +
                "                                <span class=\"block input-icon input-icon-right\">\n" +
                "                                    <select class=\"form-control chosen-select districttable\" id=\"COV_DISTRICT_ID\" name=\"COV_DISTRICT_ID[]\" required >\n" +

                "                                        <option value=\"\"> Select </option>\n" +
                "                                    </select>\n" +
//              "                                    <input type=\"hidden\" class=\"tech_disabled\" disabled=\"disabled\" name=\"technology_id[]\" value=\"\">\n" +
                "                                </span>\n" +
                "                            </td>\n" +
                "                            <td>\n" +
                "                                <span class=\"block input-icon input-icon-right\">\n" +
                "                                    <select class=\"form-control chosen-select upazilatable\" id=\"COV_UPAZILA_ID\" name=\"COV_UPAZILA_ID[]\" required >\n" +

                "                                        <option value=\"\"> Select </option>\n" +
                "                                    </select>\n" +
//                           "                                    <input type=\"hidden\" class=\"tech_disabled\" disabled=\"disabled\" name=\"technology_id[]\" value=\"\">\n" +
                "                                </span>\n" +
                "                            </td>\n" +
                "                            <td><span class=\"btn btn-danger btn-sm pull-right rowRemove btnRemove\"><i class=\"fa fa-remove\"></i></span></td>\n" +
                "                        </tr>");
//            alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            var defaultRow = $('tr.removableRow:last');

            $('.chosen-select').chosen(0);
        });
    });
    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        $(this).closest("tr.removableRow").remove();
    });

    $(document).on('change', '.COV_DIVISION_ID', function () {
        var thisRow = $(this).closest('tr');
        var divisionId = thisRow.find('.COV_DIVISION_ID').val(); //alert(divisionId);exit();
        //alert(divisionId);
        var option = '<option value="">Select District</option>';
        $.ajax({
            type : "get",
            url  : "supplier-profile/get-district/{id}",
            data : {'divisionId': divisionId},
            success:function (data) {
                for (var i = 0; i < data.length; i++){
                    option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                }
                thisRow.find('.districttable').html(option);
                thisRow.find('.districttable').trigger("chosen:updated");
            }
        });
    });


    $(document).on('change', '.districttable', function () {
        var thisRow = $(this).closest('tr');
        var districtId = thisRow.find('.districttable').val();
        var option = '<option value="">Select Upazila</option>';
        $.ajax({
            type : "get",
            url  : "supplier-profile/get-upazila/{id}",
            data : {'districtId': districtId},
            success:function (data) {
                for (var i = 0; i < data.length; i++){
                    option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                }
                thisRow.find('.upazilatable').html(option);
                thisRow.find('.upazilatable').trigger("chosen:updated");
            }
        });
    });

    $(document).on('click','span.btnRemove',function(){
        var fundAllocationChdId = $(this).attr('data-fundAllocationChdId');

        $.ajax({
            url: "{{ url('fund-allocations-chd-delete') }}",
            type: 'GET',
            data: {'fundAllocationChdId':fundAllocationChdId},
            success: function (data) {


            }

        });
    });

</script>





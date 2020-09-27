<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>

    <form action="{{ url('/seller-distributor-profile/'.$editSellerProfile->CUSTOMER_ID) }}" method="post" class="form-horizontal" role="form">
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
            </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Seller ID</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess SELLER_ID" placeholder="Example: Amount per KG here" name="SELLER_ID" readonly="readonly" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->SELLER_ID }}" readonly/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    <label class="col-sm-12"> <b>Trading Name</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-12">
                        <input autocomplete="off" type="text" id="inputSuccess TRADING_NAME" placeholder="Example: Trading Name here" name="TRADING_NAME" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->TRADING_NAME }}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-sm-12"> <b>Trader Name</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-12">
                        <input autocomplete="off" type="text" id="inputSuccess TRADER_NAME" placeholder="Example: Auto Generate" name="TRADER_NAME" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->TRADER_NAME }}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-sm-12"> <b>Trade Licence No.</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-12">
                        <input autocomplete="off" type="text" id="inputSuccess LICENCE_NO" placeholder="Example: Amount per KG here" name="LICENCE_NO" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->LICENCE_NO }}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-sm-12"> <b>Mobile No.</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-12">
                        <input autocomplete="off" type="text" id="inputSuccess PHONE" placeholder="Example: Amount per KG here" name="PHONE" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->PHONE }}"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="col-md-3">
                    <label for="inputSuccess" class="col-sm-12"><b>Division</b><span style="color: red;"> *</span></label>
                    <div class="col-sm-12">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control  chosen-select division" name="DIVISION_ID">
                            <option value="">{{ trans('organization.select_one') }}</option>
                            @foreach($getDivision as $row)
                                <option value="{{ $row->DIVISION_ID }}" @if($editSellerProfile->DIVISION_ID==$row->DIVISION_ID) selected @endif>{{ $row->DIVISION_NAME }}</option>
                            @endforeach
                        </select>
                    </span>

                    </div>
                </div>
                <div class="col-md-3">
                    <label for="inputSuccess" class="col-sm-12"><b>District</b><span style="color: red;"> *</span></label>
                    <div class="col-sm-12">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control district chosen-select district" name="DISTRICT_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editSellerProfile->DISTRICT_ID }}">{{ $editSellerProfile->DISTRICT_NAME }}</option>
                        </select>
                    </span>

                    </div>
                </div>
                <div class="col-md-3">
                    <label for="inputSuccess" class="col-sm-12" style="margin-left: -2%;"><b>Thana/Upazila</b><span style="color: red;"> *</span></label>
                    <div class="col-sm-12">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control chosen-select upazila" name="THANA_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editSellerProfile->THANA_ID }}">{{ $editSellerProfile->THANA_NAME }}</option>
                        </select>
                    </span>

                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12 col-md-offset-2">
                <div class="col-md-4">
                    <label class="col-sm-12 " > <b>Bazar</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-12">
                        <input autocomplete="off" type="text" id="inputSuccess BAZAR_NAME" placeholder="Example: Amount per KG here" name="BAZAR_NAME" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->BAZAR_NAME }}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="col-sm-12" style="margin-left: -2%;"> <b>Email</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-12">
                        <input autocomplete="off" type="text" id="inputSuccess EMAIL" placeholder="Example: Amount per KG here" name="EMAIL" class="form-control col-xs-10 col-sm-5" value="{{ $editSellerProfile->EMAIL }}"/>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-12" style="margin-top: 15px;">
            <h4  style="color: #1B6AAA;">Coverage Area</h4>
            <hr>
            <table class="table table-bordered fundAllocation">
                <thead>
                <tr>
                    <th style="width: 255px;">Division<span style="color:red;"> </span></th>
                    <th style="width: 255px;">District<span style="color:red;"> </span></th>
                    <th style="width: 255px;">Thana/Upazila</th>
                    {{--<th style="width: 150px;">Problem</th>--}}

                    <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                </tr>
                </thead>
                <tbody class="newRow">
                @foreach($editsellerProfilearray as $seller)
                    <tr class="rowFirst">
                        <input type="hidden" name="COVERAGE_ID[]" value="{{ $seller->COVERAGE_ID }}">
                        <td>
                            <span class="block input-icon input-icon-right">
                                <select class="form-control chosen-select division" name="COV_DIVISION_ID[]">
                                    <option value="">Select</option>
                                    @foreach($getDivision as $row)
                                        <option value="{{ $row->DIVISION_ID }}" @if($seller->COV_DIVISION_ID==$row->DIVISION_ID) selected @endif >{{ $row->DIVISION_NAME }}</option>
                                    @endforeach
                                </select>
                            </span>
                        </td>
                        <td>
                           <span class="block input-icon input-icon-right">
                                <select class="chosen-select form-control district" name="COV_DISTRICT_ID[]" data-placeholder="Select or search data">
                                    <option value="{{ $seller->COV_DISTRICT_ID }}">{{ $seller->DISTRICT_NAME }}</option>
                                </select>
                            </span>
                        </td>
                        <td>
                            <span class="block input-icon input-icon-right">
                                <select class="form-control chosen-select upazila" name="COV_THANA_ID[]" data-placeholder="Select or search data">
                                    <option value="{{ $seller->COV_THANA_ID }}">{{ $seller->UPAZILA_NAME }}</option>
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

<script>
    //    Add For Multiple Row Dynamically
    $(document).ready(function(){
        $('.rowAdd').click(function(){
            let getTr = $('tr.rowFirst:first');
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            let defaultRow = $('tr.removableRow:last');
            $('.chosen-select').chosen(0);
            defaultRow.find('.chosen-select').val('').trigger('chosen:updated');
            defaultRow.find('input').val('');
        });
    });
    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        let thisRow = $(this).closest('tr');
        if(!thisRow.is(':last-child')) thisRow.remove();
    });
</script>






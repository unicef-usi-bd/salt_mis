<div id="millers" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" class="form-horizontal" role="form" >
                {{--<div class="col-md-6">--}}
                <input type="hidden" name="centerId" class="center" value="{{ Auth::user()->center_id }}">
                <div class="form-group" style="margin-left: 75px">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Report Type</b></label>
                        <div class="col-sm-5">
                            <span class="block input-icon input-icon-right">
                               <select  class="chosen-select chosen-container reportMiller" name="PROCESS_TYPE_ID" data-placeholder="Select">
                                   <option value="">Select One</option>
                                   <optgroup label="Purchase Salt">
                                       <option value="purchase-salt-supplier-miller">List of Supplier </option>
                                       <option value="purchase-salt-list">List of Item </option>
                                       <option value="miller-purchase-salt-stock">Purchase</option>
                                       <option value="monitor-salt-report">Monitor Supplier</option>
                                       <option value="purchase-salt-amount/{itemType}">Total Purchase Stock</option>
                                   </optgroup>
                                   <optgroup label="Purchase Chemical">
                                       <option value="purchase-salt-supplier-miller-type">List of Supplier </option>
                                       <option value="chemical-item-list">List of Item </option>
                                       <option value="chemical-purchase-report">Purchase</option>
                                       <option value="monitor-supplier">Monitor Supplier</option>
                                       <option value="miller-chemical-purchase-stock">Chemical Stock</option>
                                 </optgroup>
                                   <optgroup label="Process">
                                       <option value="miller-process-list-report">List of Process </option>
                                       <option value="miller-process-stock-report">Process  Stock</option>
                                   </optgroup>
                                   <optgroup label="Sale">
                                       <option value="clint-list-miller">List of Client</option>
                                       <option value="sales-item-report">List of Item</option>
                                       <option value="sale-clint-list-miller">Sale</option>
                                       <option value="monitor-clint-list-miller">Monitor Client</option>
                                       <option value="item-stock-miller">Item Stock</option>
                                 </optgroup>
                                   <optgroup label="License">
                                       <option value="miller-license-report/{zone}">List of License </option>
                                  </optgroup>
                                   <optgroup label="QC">
                                       <option value="qc-report/{zone}">List of QC </option>
                                  </optgroup>
                                   <optgroup label="HR">
                                       <option value="hr-employee-miller">List of HR </option>
                                  </optgroup>


                               </select>
                            </span>
                        </div>
                    </div>
                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Issuer</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="DIVISION_ID" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Internal </b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select id="DISTRICT_ID" class="chosen-select chosen-container district" name="DISTRICT_ID" data-placeholder="Select">--}}
                                   {{--<option value="">Select</option>--}}

                               {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Supplier</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}
                                    {{--<option value=""></option>--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Crude Salt Item</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}
                                    {{--<option value=""></option>--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Chemical Item</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}
                                    {{--<option value=""></option>--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Wash & Crash</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}
                                    {{--<option value=""></option>--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Iodized</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}
                                    {{--<option value=""></option>--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Client</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}
                                    {{--<option value=""></option>--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Raw Salt</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}
                                    {{--<option value=""></option>--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}



                {{--</div>--}}

                {{--<div class="col-md-6">--}}

                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Purchase Range</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select id="DISTRICT_ID" class="chosen-select chosen-container district" name="DISTRICT_ID" data-placeholder="Select">--}}
                                   {{--<option value="">Select</option>--}}

                               {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Renew Date</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<input type="date" name="renew_date" class="chosen-select chosen-container">--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Fail Date</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<input type="date" name="renew_date" class="chosen-select chosen-container">--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Monitor</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select id="DISTRICT_ID" class="chosen-select chosen-container district" name="DISTRICT_ID" data-placeholder="Select">--}}
                                   {{--<option value="">Select</option>--}}

                               {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Self </b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select id="DISTRICT_ID" class="chosen-select chosen-container district" name="DISTRICT_ID" data-placeholder="Select">--}}
                                   {{--<option value="">Select</option>--}}

                               {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Finished Salt Item</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}
                                    {{--<option value=""></option>--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="DIVISION_ID" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select id="DISTRICT_ID" class="chosen-select chosen-container district" name="DISTRICT_ID" data-placeholder="Select">--}}
                                   {{--<option value="">Select</option>--}}

                               {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select id="ACTIVE_FLG" class="chosen-select chosen-container" name="ACTIVE_FLG" data-placeholder="Select">--}}
                                   {{--<option value="1">Active</option>--}}
                                   {{--<option value="0">Inactive</option>--}}
                               {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                {{--</div>--}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>{{ trans('soeReport.date_between') }}</b></label>
                        <div class="col-sm-8">
                                <span class="block input-icon input-icon-right ">
                                    {{--<input type="text" name="from_date" readonly value="" class="width-100 date-picker" />--}}
                                    <input type="text" id="reportrange"  name="reportrange" class="width-65 millReportrange " />

                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Item</b><span style="color: red;"> </span></label>
                        <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess RECEIVE_NO" class="itemTypeMiller chosen-select form-control width-65" name="RECEIVE_NO" data-placeholder="Select Crude Salt Type">
                               <option value="">-Select One-</option>
                                <option value="0">All Purchase</option>
                                @foreach($crudeSaltTypes as $chemical)
                                    <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Process Type</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select class="chosen-select  processType width-65" name="process_type" data-placeholder="Select">
                                   <option value="">-Select-</option>
                                   <option value="0">Wash And Crush</option>
                                   <option value="1">Iodized </option>
                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>
                        <div class="col-xs-8">
                            <span class="block input-icon input-icon-right">
                                <select id="DIVISION_ID" class="DIVISION_ID form-control divisionId chosen-select width-65" name="DIVISION_ID" data-placeholder="Select or search data">
                                    <option value="">Select Division</option>
                                    @foreach($getDivision as $row)
                                        <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                    @endforeach
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b></label>
                        <div class="col-xs-8">
                        <span class="block input-icon input-icon-right">
                            <select id="DISTRICT_ID" class="districtId form-control chosen-select district width-65" name="DISTRICT_ID" data-placeholder="Select or search data">
                                <option value="">Select District</option>
                            </select>
                        </span>
                        </div>
                    </div>
                    <div class="form-group" style="margin-left:22px;width: 334px;">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Renew Date</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-8">
                            <input type="text" name="RECEIVE_DATE" id="RECEIVE_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 date-picker" />
                        </div>
                    </div>
                    <div class="form-group" style="margin-left:22px;width: 334px;">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Fail Date</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-8">
                            <input type="text" name="RECEIVE_DATE" id="RECEIVE_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 end-date" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Purchase order</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select class=" width-65" name="ACTIVE_FLG">
                                   <option value="">--Select--</option>
                                   <option value="0">Higher Purchase</option>
                                   <option value="1">Lower Purchase</option>
                                   <option value="2">Higher Sale</option>
                                   <option value="3">Lower Sale</option>
                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> Association Name</b> <span style="color: red;"> </span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                                <select id="form-field-select-3 inputSuccess ZONE_ID" class="zoneMiller form-control width-65 " name="ZONE_ID" data-placeholder="Select or search data">
                                    <option value="">Select Association Name</option>
                                    <option value="0">Select All</option>
                                    @foreach($associationList as $association)
                                        <option value="{{$association->ZONE_ID}}"> {{$association->ZONE_NAME}}</option>
                                    @endforeach
                                </select>
                             </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> Issuer</b> <span style="color: red;"> </span></label>
                        <div class="col-md-8">
                            <span class="block input-icon input-icon-right">
                                <select class="issuerMiller width-65 form-control chosen-select " id="ISSURE_ID" name="ISSURE_ID"  >
                                    <option value="">Select</option>
                                    @foreach($issueBy as $row)
                                        <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                    @endforeach
                                 </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> Clint</b> <span style="color: red;"> </span></label>
                        <div class="col-md-8">
                            <span class="block input-icon input-icon-right">
                                <select class="customerId width-65 form-control chosen-select " id="CUSTOMER_ID" name="CUSTOMER_ID"  >
                                    <option value="">Select</option>
                                    @foreach($clintNameList as $row)
                                        <option value="{{ $row->CUSTOMER_ID }}">{{ $row->TRADER_NAME }}</option>
                                    @endforeach
                                 </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> Finished Salt Item</b> <span style="color: red;"> </span></label>
                        <div class="col-md-8">
                            <span class="block input-icon input-icon-right">
                                <select class="itemTypeId width-65 form-control chosen-select " id="ITEM_TYPE" name="ITEM_TYPE"  >
                                    <option value="">Select</option>
                                    <option value="0">Select All</option>
                                    @foreach($finishSaltItem as $row)
                                        <option value="{{ $row->ITEM_TYPE }}">{{ $row->ITEM_NAME }}</option>
                                    @endforeach
                                 </select>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <div class="clearfix">
                <div class="col-md-offset-3 col-md-9" style="margin-left: 40%!important;">
                    <button type="reset" class="btn">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        {{ trans('dashboard.reset') }}
                    </button>
                    <button type="submit" center-type="miller" class="btn btn-primary btnReport">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Show Report
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
@include('masterGlobal.districtReport')
{{--@include('masterGlobal.datePicker')--}}
<script type="text/javascript" src="{{ 'assets/js/moment.min.js' }}"></script>
<script type="text/javascript" src="{{'assets/js/daterangepicker.js'}}"></script>
<link rel="stylesheet" type="text/css" href="{{'assets/css/daterangepicker.css'}}" />
<script>
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('.millReportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('.millReportrange').daterangepicker({

            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });

    $(document).ready(function () {
        var minDate = "<?php echo session('startDate'); ?>";
        var maxDate = "<?php echo session('endDate'); ?>";
        $('.date-picker').datepicker({
            uiLibrary: 'bootstrap',
            minDate: new Date(minDate),
            maxDate: new Date(maxDate)

        });
    });
    $(document).ready(function () {
        $('.end-date').datepicker({
            uiLibrary: 'bootstrap'
        });
    });

</script>
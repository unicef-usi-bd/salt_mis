<div id="bscic" class="tab-pane fade in active">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" class="form-horizontal" role="form" >
                {{--<div class="col-md-6">--}}
                <input type="hidden" name="centerId" class="center" value="{{ Auth::user()->center_id }}">
                <div class="form-group" style="margin-left: 75px">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Report Type</b></label>
                        <div class="col-sm-5">
                            <span class="block input-icon input-icon-right">
                               <select  class="chosen-select chosen-container reportBasic" name="PROCESS_TYPE_ID" data-placeholder="Select">
                                   <option value="">-Select-</option>
                                   <optgroup label="Association">
                                       <option value="association-list">List of Total Association </option>
                                       <option value="miller-list/{activStatus}">Type of Miller</option>
                                       <option value="monitor-association">Monitor Association</option>
                                       <option value="admin-association-list">List of Association </option>
                                   </optgroup>
                                   <optgroup label="Purchase Salt">
                                       <option value="purchase-salt-list">List of Item </option>
                                       <option value="purchase-salt-amount">Total Purchase</option>
                                       <option value="purchase-salt-stock">Purchase Stock</option>
                                   </optgroup>
                                   <optgroup label="Purchase Chemical">
                                       <option value="chemical-item-list">List of Item </option>
                                       {{--<option value="">List of Supplier  </option>--}}
                                       <option value="chemical-purchase-report">Purchase</option>
                                       <option value="chemical-purchase-stock">Purchase Stock</option>
                                       {{--<option value="">Monitor Supplier</option>--}}
                                       {{--<option value="">Chemical Stock</option>--}}

                                  </optgroup>
                                   <optgroup label="Process">
                                       <option value="process-stock-admin">Process  Stock</option>
                                       {{--<option value="">List of  Stock</option>--}}
                                  </optgroup>
                                   <optgroup label="Sale">
                                       <option value="total-sale-admin">Total Sale</option>
                                       <option value="sales-item-report-all">List of Item</option>
                                       {{--<option value="">Item Stock</option>--}}
                                  </optgroup>
                                   <optgroup label="License">
                                       {{--<option value="">List of Miller </option>--}}
                                       <option value="miller-license-report/{zone}">List of License </option>
                                  </optgroup>
                                   <optgroup label="QC">
                                       {{--<option value="">List of Miller </option>--}}
                                       <option value="qc-report/{zone}">List of QC </option>
                                  </optgroup>
                                   <optgroup label="HR">
                                       <option value="admin-hr-employee-miller">List of Miller </option>
                                       {{--<option value="">List of HR </option>--}}
                                  </optgroup>
                                   {{--<optgroup label="Miller">--}}
                                       {{--<option value="">Total Miller </option>--}}
                                       {{--<option value="">Type of Miller </option>--}}
                                       {{--<option value="">Monitor Miller </option>--}}
                                       {{--<option value="">List Of Miller </option>--}}
                                  {{--</optgroup>--}}

                               </select>
                            </span>
                        </div>
                    </div>

                <div class="col-md-6">
                    <div class="form-group millerDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Mill Name</b><span style="color: red;"> </span></label>
                        <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess MILL_ID" class="millTypeAdmin chosen-select form-control width-65" name="MILL_ID" data-placeholder="Select Crude Salt Type">
                               <option value="">-Select-</option>
                                <option value="0">All Mill</option>
                                @foreach($millInfo as $row)
                                    <option value="{{$row->MILL_ID}}"> {{$row->MILL_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                        </div>
                    </div>
                    <div class="form-group processTypeDiv">
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
                <div class="form-group statusAdminDiv">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status</b></label>
                    <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select class="statusBasic width-65" name="ACTIVE_FLG">
                                   <option value="">-Select-</option>
                                   <option value="0">Select All</option>
                                   <option value="1">Active</option>
                                   <option value="2">Inactive</option>
                               </select>
                            </span>
                    </div>
                </div>
                    <div class="form-group adminReportrangeDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>{{ trans('soeReport.date_between') }}</b></label>
                        <div class="col-sm-8">
                                <span class="block input-icon input-icon-right ">
                                    {{--<input autocomplete="off" type="text" name="from_date" readonly value="" class="width-100 date-picker" />--}}
                                    <input autocomplete="off" type="text" id="reportrange"  name="reportrange" class="width-65 basicReportrange " />

                                </span>
                        </div>
                    </div>
                    <div class="form-group itemTypeAdminDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Item</b><span style="color: red;"> </span></label>
                        <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess RECEIVE_NO" class="itemTypeBasic chosen-select form-control width-65" name="RECEIVE_NO" data-placeholder="Select Crude Salt Type">
                               <option value="">-Select-</option>
                                <option value="0">-Select-</option>
                                @foreach($crudeSaltTypes as $chemical)
                                    <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                        </div>
                    </div>
                    <div class="form-group divisionIdDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>
                        <div class="col-xs-8">
                            <span class="block input-icon input-icon-right">
                                <select class="form-control chosen-select width-65 division" name="DIVISION_ID" data-placeholder="Select or search data">
                                    <option value="">-Select-</option>
                                    @foreach($getDivision as $row)
                                        <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                    @endforeach
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group districtIdDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b></label>
                        <div class="col-xs-8">
                        <span class="block input-icon input-icon-right">
                            <select class=" form-control chosen-select district width-65" name="DISTRICT_ID" data-placeholder="Select or search data">
                                <option value="">-Select-</option>
                            </select>
                        </span>
                        </div>
                    </div>
                    <div class="form-group renewDateDiv" style="margin-left:22px;width: 334px;">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Renew Date</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-8">
                            <input autocomplete="off" type="text" name="RECEIVE_DATE" id="RECEIVE_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 date-picker" />
                        </div>
                    </div>
                    <div class="form-group failDateDiv" style="margin-left:22px;width: 334px;">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Fail Date</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-8">
                            <input autocomplete="off" type="text" name="RECEIVE_DATE" id="RECEIVE_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 end-date" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    {{--<div class="form-group purchaseOrderDiv">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Purchase order</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select class=" width-65" name="ACTIVE_FLG">--}}
                                   {{--<option value="">--Select--</option>--}}
                                   {{--<option value="0">Higher Purchase</option>--}}
                                   {{--<option value="1">Lower Purchase</option>--}}
                                   {{--<option value="2">Higher Sale</option>--}}
                                   {{--<option value="3">Lower Sale</option>--}}
                               {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group zoneAdminDiv">--}}
                        {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> Association Name</b> <span style="color: red;"> </span></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="form-field-select-3 inputSuccess ZONE_ID" class="zoneBasic form-control width-65 " name="ZONE_ID" data-placeholder="Select or search data">--}}
                                    {{--<option value="">Select Association Name</option>--}}
                                    {{--<option value="0">Select All</option>--}}
                                    {{--@foreach($associationList as $association)--}}
                                        {{--<option value="{{$association->ZONE_ID}}"> {{$association->ZONE_NAME}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                             {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group issuerAdminDiv">
                        <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> Issuer</b> <span style="color: red;"> </span></label>
                        <div class="col-md-8">
                            <span class="block input-icon input-icon-right">
                                <select class="issuerBasic width-65 form-control chosen-select " id="ISSURE_ID" name="ISSURE_ID"  >
                                    <option value="">-Select-</option>
                                    @foreach($issueBy as $row)
                                        <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                    @endforeach
                                 </select>
                            </span>
                        </div>
                    </div>
                </div>




                {{--</div>--}}
            </form>
            <br>
            <div class="clearfix">
                <div class="col-md-offset-3 col-md-9" style="margin-left: 40%!important;">
                    <button type="reset" class="btn" id="resetbtn">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        {{ trans('dashboard.reset') }}
                    </button>
                    <button type="submit" center-type="basic" class="btn btn-primary btnReport">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Show Report
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
@include('masterGlobal.districtReport')
<script type="text/javascript" src="{{ 'assets/js/moment.min.js' }}"></script>
<script type="text/javascript" src="{{'assets/js/daterangepicker.js'}}"></script>
<link rel="stylesheet" type="text/css" href="{{'assets/css/daterangepicker.css'}}" />
<script>
    $(document).on('click','#resetbtn', function () {
        $('.chosen-single span').val("");
        $('.chosen-single span').html("");
        $('#reportrange').html("");
        $('#reportrange').val("");
    });
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('.basicReportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('.basicReportrange').daterangepicker({

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

    $(document).ready(function(){
        $('.statusAdminDiv').hide();
        $('.adminReportrangeDiv').hide();
        $('.itemTypeAdminDiv').hide();
        $('.divisionIdDiv').hide();
        $('.districtIdDiv').hide();
        $('.renewDateDiv').hide();
        $('.failDateDiv').hide();
        $('.purchaseOrderDiv').hide();
        $('.zoneAdminDiv').hide();
        $('.issuerAdminDiv').hide();
        $('.processTypeDiv').hide();
        $('.millerDiv').hide();
    });

    $(document).on('change','.reportBasic',function(){
        $reportUrl = $(this).val();

        if($reportUrl === 'association-list'){
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'miller-list/{activStatus}'){

            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.statusAdminDiv').show();
            $('.adminReportrangeDiv').hide();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'monitor-association'){
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'admin-association-list'){
            $('.statusAdminDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.purchaseOrderDiv').show();
            $('.adminReportrangeDiv').show();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'purchase-salt-list'){
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'purchase-salt-amount'){
            $('.statusAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.itemTypeAdminDiv').show();
            $('.adminReportrangeDiv').hide();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'purchase-salt-stock'){
            $('.statusAdminDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.adminReportrangeDiv').hide();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'chemical-item-list'){
            $('.statusAdminDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.adminReportrangeDiv').hide();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'chemical-purchase-report'){
            $('.statusAdminDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.adminReportrangeDiv').show();
            $('.processTypeDiv').hide();
            $('.millerDiv').show();
        }else if($reportUrl === 'chemical-purchase-stock'){
            $('.statusAdminDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.adminReportrangeDiv').hide();
            $('.processTypeDiv').hide();
            $('.millerDiv').show();
        }else if($reportUrl === 'process-stock-admin'){
            $('.statusAdminDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.adminReportrangeDiv').show();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'total-sale-admin'){
            $('.statusAdminDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.processTypeDiv').show();
            $('.millerDiv').hide();
        }else if($reportUrl === 'sales-item-report-all'){
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'miller-license-report/{zone}'){
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.purchaseOrderDiv').hide();

            $('.renewDateDiv').show();
            $('.failDateDiv').show();
            $('.zoneAdminDiv').show();
            $('.issuerAdminDiv').show();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else if($reportUrl === 'qc-report/{zone}'){
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.zoneAdminDiv').show();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }else{
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.zoneAdminDiv').show();
            $('.processTypeDiv').hide();
            $('.millerDiv').hide();
        }
    });
</script>

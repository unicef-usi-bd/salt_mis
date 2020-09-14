<!-- association report-->
<div id="association" class="tab-pane fade in active">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" class="form-horizontal" role="form" >
                <div class="form-group" >
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Report Type</b></label>
                    <div class="col-sm-5">
                            <span class="block input-icon input-icon-right">
                               <select id="" class="chosen-select chosen-container reportAssociation" name="PROCESS_TYPE_ID" data-placeholder="Select">
                                   <option value="">Select One</option>
                                   <optgroup label="Purchase Salt">
                                       <option value="purchase-salt-item">List of Item </option>
                                       <option value="purchase-salt-total">Total Purchase</option>
                                       <option value="purchase-salt-total-stock">Total Purchase Stock</option>
                                   </optgroup>
                                   <optgroup label="Purchase Chemical">
                                       <option value="purchase-chemical-item">List of Item </option>
                                       <option value="purchase-chemical-total">Purchase</option>
                                       <option value="purchase-chemical-total-stock">Purchase Stock</option>
                                 </optgroup>
                                   <optgroup label="Process">
                                       <option value="assoc-process-stock">Process  Stock</option>
                                   </optgroup>
                                   <optgroup label="Sale">
                                       <option value="association-sale">Total Sale</option>
                                       <option value="sale-item-list">List of Item</option>
                                       <option value="sale-item-stock">Item Stock</option>
                                 </optgroup>
                                   {{--<optgroup label="License">--}}
                                       {{--<option value="license-miller-list">List of Miller </option>--}}
                                  {{--</optgroup>--}}
                                   <optgroup label="QC">
                                       <option value="qc-miller-list">List of Miller </option>
                                  </optgroup>
                                   <optgroup label="HR">
                                       <option value="association-miller-list">List of Miller </option>
                                  </optgroup>
                                   <optgroup label="Miller">
                                       <option value="association-total-miller">Total Miller </option>
                                       <option value="association-miller-type">Type of Miller </option>
                                       {{--<option value="association-monitor-miller">Monitor Miller </option>--}}
                                       <option value="list-of-miller">List Of Miller </option>
                                  </optgroup>

                               </select>
                            </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group adminReportrangeDiv" >
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Date Between</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                                <input autocomplete="off" type="text" id="reportrange"  name="reportrange" class="width-65 assReportrange" /></select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group issuerAdminDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Issuer</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select class="issueby width-65" name="">
                                   <option value="">--Select--</option>
                                   @foreach($issueBy as $row)
                                       <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group divisionIdDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select class="form-control division chosen-select width-65" name="DIVISION_ID" data-placeholder="Select or search data">
                                    <option value="">Select Division</option>
                                    @foreach($getDivision as $row)
                                       <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                   @endforeach
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group districtIdDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select class="form-control chosen-select district width-65" name="DISTRICT_ID" data-placeholder="Select or search data">
                                <option value="">Select District</option>
                            </select>
                            </span>
                        </div>
                    </div>


                    <div class="form-group itemTypeAdminDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Item</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="form-field-select-3 inputSuccess RECEIVE_NO" class="itemTypeAssoc chosen-select form-control width-65" name="RECEIVE_NO" data-placeholder="Select Crude Salt Type">
                                <option value="0">All Purchase</option>
                                   @foreach($crudeSaltTypes as $chemical)
                                       <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                                   @endforeach
                                </select>
                            </span>
                        </div>
                    </div>


                        <div class="form-group millerDiv">
                            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Mill Name</b><span style="color: red;"> </span></label>
                            <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess MILL_ID" class="millTypeAdmin chosen-select form-control width-65" name="MILL_ID" data-placeholder="Select Crude Salt Type">
                               <option value="">-Select One-</option>
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
                                   <option value="0">Select All</option>
                                    @foreach($finishSaltItem as $row)
                                       <option value="{{ $row->ITEM_NO }}">{{ $row->ITEM_NAME }}</option>
                                   @endforeach
                               </select>
                            </span>
                        </div>
                    </div>


                    <div class="form-group statusAdminDiv">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select class="statusAssociation width-65" name="ACTIVE_FLG">
                                   <option value="">--Select--</option>
                                   <option value="2">All</option>
                                   <option value="1">Active</option>
                                   <option value="0">Inactive</option>
                               </select>
                            </span>
                        </div>
                    </div>


                    <div class="form-group renewDateDiv" style="margin-left:22px;width: 334px;">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Renew Date</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="renew_date" id="" readonly value="" class="width-100 renew-date" />
                            </span>
                        </div>
                    </div>
                    <div class="form-group failDateDiv" style="margin-left:22px;width: 334px;">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Fail Date</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="fail_date" id="" readonly value="" class="width-100 fail-date" />
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
                    <button type="submit" center-type="association" class="btn btn-primary btnReport">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Show Report
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
@include('masterGlobal.chosenSelect')
<script type="text/javascript" src="{{ 'assets/js/moment.min.js' }}"></script>
<script type="text/javascript" src="{{'assets/js/daterangepicker.js'}}"></script>
<link rel="stylesheet" type="text/css" href="{{'assets/css/daterangepicker.css'}}" />
<script>
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('.assReportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('.assReportrange').daterangepicker({

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
        $('#ASSOC_DIVISION_ID').on('change',function(){
            var divisionId = $(this).val(); //alert(divisionId);exit();
            var option = '<option value="">Select District</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-district/{id}",
                data : {'divisionId': divisionId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                    }
                    $('.assoc_district').html(option);
                    $('.assoc_district').trigger("chosen:updated");
                }
            });
        });
    });

    $(document).ready(function () {
        var minDate = "<?php echo session('startDate'); ?>";
        var maxDate = "<?php echo session('endDate'); ?>";
        $('.renew-date').datepicker({
            uiLibrary: 'bootstrap',
            minDate: new Date(minDate),
            maxDate: new Date(maxDate)

        });
    });
    $(document).ready(function () {
        $('.fail-date').datepicker({
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
        $('.issuerAdminDiv').hide();
        $('.processTypeDiv').hide();
        $('.millerDiv').hide();
    });

    $(document).on('change','.reportAssociation',function(){
        $reportUrl = $(this).val();
         if($reportUrl === 'purchase-salt-item'){
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
        }else if($reportUrl === 'purchase-salt-total'){
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
        }else if($reportUrl === 'purchase-salt-total-stock'){
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
        }else if($reportUrl === 'purchase-chemical-item'){
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
        }else if($reportUrl === 'purchase-chemical-total'){
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
        }else if($reportUrl === 'purchase-chemical-total-stock'){
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
        }else if($reportUrl === 'assoc-process-stock'){
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
        }else if($reportUrl === 'association-sale'){
            $('.statusAdminDiv').hide();
             $('.itemTypeAdminDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();
            $('.issuerAdminDiv').hide();

            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').show();
            $('.districtIdDiv').show();
            $('.processTypeDiv').show();
             $('.millerDiv').hide();
        }else if($reportUrl === 'sale-item-list'){
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
        }else if($reportUrl === 'sale-item-stock'){
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
         }else if($reportUrl === 'license-miller-list'){
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.zoneAdminDiv').hide();

            $('.renewDateDiv').show();
            $('.failDateDiv').show();
            $('.issuerAdminDiv').show();
             $('.processTypeDiv').hide();
             $('.millerDiv').hide();
        }else if($reportUrl === 'qc-miller-list'){
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.issuerAdminDiv').hide();
            $('.zoneAdminDiv').hide();
             $('.processTypeDiv').hide();
             $('.millerDiv').hide();
        }else if($reportUrl === 'association-miller-list'){
            $('.statusAdminDiv').hide();
            $('.adminReportrangeDiv').hide();
            $('.itemTypeAdminDiv').hide();
            $('.divisionIdDiv').hide();
            $('.districtIdDiv').hide();
            $('.renewDateDiv').hide();
            $('.failDateDiv').hide();
            $('.purchaseOrderDiv').hide();
            $('.issuerAdminDiv').hide();
            $('.zoneAdminDiv').hide();
             $('.processTypeDiv').hide();
             $('.millerDiv').hide();
        }else if($reportUrl === 'association-total-miller'){
             $('.adminReportrangeDiv').hide();
             $('.itemTypeAdminDiv').hide();
             $('.divisionIdDiv').hide();
             $('.districtIdDiv').hide();
             $('.renewDateDiv').hide();
             $('.failDateDiv').hide();
             $('.purchaseOrderDiv').hide();
             $('.issuerAdminDiv').hide();
             $('.zoneAdminDiv').hide();

             $('.statusAdminDiv').show();
             $('.processTypeDiv').hide();
             $('.millerDiv').hide();
         }else if($reportUrl === 'association-miller-type'){
             $('.statusAdminDiv').hide();
             $('.adminReportrangeDiv').hide();
             $('.itemTypeAdminDiv').hide();
             $('.divisionIdDiv').hide();
             $('.districtIdDiv').hide();
             $('.renewDateDiv').hide();
             $('.failDateDiv').hide();
             $('.purchaseOrderDiv').hide();
             $('.issuerAdminDiv').hide();
             $('.zoneAdminDiv').hide();
             $('.processTypeDiv').hide();
             $('.millerDiv').hide();
         }else if($reportUrl === 'association-monitor-miller'){
             $('.statusAdminDiv').hide();
             $('.adminReportrangeDiv').hide();
             $('.itemTypeAdminDiv').hide();
             $('.divisionIdDiv').hide();
             $('.districtIdDiv').hide();
             $('.renewDateDiv').hide();
             $('.failDateDiv').hide();
             $('.purchaseOrderDiv').hide();
             $('.issuerAdminDiv').hide();
             $('.zoneAdminDiv').hide();
             $('.processTypeDiv').hide();
             $('.millerDiv').hide();
         }else {
             $('.statusAdminDiv').hide();
             $('.adminReportrangeDiv').hide();
             $('.itemTypeAdminDiv').hide();
             $('.divisionIdDiv').hide();
             $('.districtIdDiv').hide();
             $('.renewDateDiv').hide();
             $('.failDateDiv').hide();
             $('.purchaseOrderDiv').hide();
             $('.issuerAdminDiv').hide();
             $('.zoneAdminDiv').hide();
             $('.processTypeDiv').hide();
             $('.millerDiv').hide();
         }
    });

</script>

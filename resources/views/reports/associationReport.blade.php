<!-- association report-->
<div id="association" class="tab-pane fade">
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
                                   <optgroup label="License">
                                       <option value="license-miller-list">List of Miller </option>
                                  </optgroup>
                                   <optgroup label="QC">
                                       <option value="qc-miller-list">List of Miller </option>
                                  </optgroup>
                                   <optgroup label="HR">
                                       <option value="association-miller-list">List of Miller </option>
                                  </optgroup>
                                   <optgroup label="Miller">
                                       <option value="association-total-miller">Total Miller </option>
                                       <option value="association-miller-type">Type of Miller </option>
                                       <option value="association-monitor-miller">Monitor Miller </option>
                                       <option value="list-of-miller">List Of Miller </option>
                                  </optgroup>

                               </select>
                            </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Date Between</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                                <input type="text" id="reportrange"  name="reportrange" class="width-65 assReportrange" /></select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
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
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="ASSOC_DIVISION_ID" class="form-control divisionIdd chosen-select width-65" name="DIVISION_ID" data-placeholder="Select or search data">
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
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="DISTRICT_ID" class="districtIdd form-control chosen-select assoc_district width-65" name="DISTRICT_ID" data-placeholder="Select or search data">
                                <option value="">Select District</option>
                            </select>
                            </span>
                        </div>
                    </div>




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
                    {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Item List</b></label>--}}
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



                </div>

                <div class="col-md-6">

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


                    <div class="form-group">
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

                    <div class="form-group">
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
                    <div class="form-group" style="margin-left:22px;width: 334px;">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Renew Date</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="renew_date" id="" readonly value="" class="width-100 renew-date" />
                            </span>
                        </div>
                    </div>
                    <div class="form-group" style="margin-left:22px;width: 334px;">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Fail Date</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="fail_date" id="" readonly value="" class="width-100 fail-date" />
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

</script>
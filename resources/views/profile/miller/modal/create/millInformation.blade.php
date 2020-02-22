<style>
    .my-error-class {
        color: red;
    }
</style>
<div id="mill" class="tab-pane fade in active">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/mill-info') }}" data-clear="false" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Registration Type</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="REG_TYPE_ID" class="chosen-container regTypeId" name="REG_TYPE_ID"
                                       data-placeholder="Select">
                                       <option value="">-Select-</option>
                                   @foreach($registrationType as $row)
                                       <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach
                               </select>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Name of Mill</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="MILL_NAME" class="chosen-container ">
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Process Type</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="" class="chosen-container" name="PROCESS_TYPE_ID" data-placeholder="Select">
                                   <option value="">-Select-</option>
                                   @foreach($processType as $row)
                                       <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach
                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Type of Mill</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="MILL_TYPE_ID" class="chosen-container" name="MILL_TYPE_ID"
                                       data-placeholder="Select">
                                   <option value="">-Select-</option>
                                   @foreach($millType as $row)
                                       <option value="{{ $row->UD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach
                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Capacity (TPA)</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                                <input type="text" name="CAPACITY_ID" onkeypress="return numbersOnly(this, event)" class="chosen-container CAPACITY_ID">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Zone</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="ZONE_ID" class="chosen-container" name="ZONE_ID" data-placeholder="Select">
                                   <option value="">-Select-</option>
                                   @foreach($getZone as $row)
                                       <option value="{{ $row->ZONE_CODE }}">{{ $row->ZONE_NAME }}</option>
                                   @endforeach
                               </select>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Millers ID</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input readonly type="text" name="MILLERS_ID" class="chosen-container millersId">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Miller Logo</b></label>
                        <div class="col-sm-8">
                            <input type="file" id="mill_logo" name="mill_logo"
                                   class="form-control col-xs-10 col-sm-5 user_image" value=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b> Type Of Owner</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select name="OWNER_TYPE_ID" class="chosen-select chosen-container OWNER_TYPE_ID"
                                       data-placeholder="Select or search data">
                                <option value=""></option>
                                   @foreach($ownerType as $row)
                                       <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach

                            </select>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Division</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                                <select name="DIVISION_ID"
                                        class="chosen-select chosen-container division" data-placeholder="Select">
                                    <option value=""></option>
                                    @foreach($getDivision as $row)
                                        <option value="{{ $row->DIVISION_ID }}">{{ $row->DIVISION_NAME }}</option>
                                    @endforeach

                                </select>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>District</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select class="chosen-select chosen-container district"
                                       name="DISTRICT_ID" data-placeholder="Select">
                                   <option value="">Select</option>
                               </select>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Thana/Upazilla</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select class="chosen-select chosen-container thana" name="UPAZILA_ID"
                                       data-placeholder="Select">
                                   <option value="">Select</option>
                               </select>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Active Status</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="ACTIVE_FLG" class="chosen-container" name="ACTIVE_FLG"
                                       data-placeholder="Select">

                                   <option value="1">Active</option>
                                   <option value="0">Inactive</option>
                               </select>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"
                               for="form-field-1-1"><b>Remarks</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                                <textarea rows="3" class="form-control col-sm-8" name="REMARKS"></textarea>
                            </span>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 40%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Save & Next
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{--on change registration typr to merging open this modal--}}
<style>
    .modal-open .modal1 {
        overflow-x: hidden;
        overflow-y: auto;
    }

    .fade.in {
        /*opacity:1;*/
    }

    .modal1 {
        /*display: none;*/
        position: fixed;
        top: 0;
        z-index: 1050;
        /*-webkit-overflow-scrolling: touch;*/
        outline: 0;
    }

    .modal1, .modal-backdrop {
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
<div class="modal1 fade" id="mergeMillModal" role="dialog" style="display: none;">
    {{--<div class="modal fade" id="mergeMillModal" role="dialog">--}}
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Merge Mill Account</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Mill Name</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <?php $sl = 0;?>
                    @foreach($millerToMerge as $row)
                        <tbody>
                        <tr>
                            <td class="center fixedWidth">{{ ++$sl }}</td>
                            <td class="center fixedWidth">{{ $row->MILL_NAME }}</td>
                            <td class="center fixedWidth"><input type="checkbox" class="deactivateMill"
                                                                 name="INACTIVE_FLG" value="{{ $row->MILL_ID }}"></td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="mergeMill" class="btn btn-info" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
{{--on change registration typr to merging open this modal--}}
<script>
    $(document).on('change', 'select.regTypeId', function () {
        var registrationId = $(this).val();
        if (registrationId == 11) {
            $('#mergeMillModal').modal('show');
        } else {
            $('#mergeMillModal').modal('hide');
        }
    });

    //    For Miller Deactivation
    $(document).on("click", ".deactivateMill", function () {
        var millId = $(this).val(); //alert(millId);//exit();
        var checked = ($($(this)).is(':checked')) ? 0 : 1;
        $.ajax({
            type: "get",
            url: "deactivate-mill-profile",
            data: {is_checked: checked, millId: millId},
            success: function (data) {

            }
        });
    });
</script>
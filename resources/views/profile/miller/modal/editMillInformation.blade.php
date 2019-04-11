<div id="mill_tab" class="tab-pane fade in active">
    <div class="row">
        <div class="col-md-12">

            <div class="alert alert-info millmsg"></div>

            <form id="millId"  class="form-horizontal" role="form" >
                <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Name of Mill</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="MILL_NAME" class="chosen-container" value="{{ $editMillData->MILL_NAME }}">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Process Type</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="REG_TYPE_ID" class="chosen-select chosen-container" name="PROCESS_TYPE_ID" data-placeholder="Select">
                                   <option value=""></option>
                                    @foreach($processType as $row)
                                       {{--<option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                       <option value="{{ $row->LOOKUPCHD_ID }}" @if($editMillData->PROCESS_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach

                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Mill</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="MILL_TYPE_IDD" class="chosen-select chosen-container" name="MILL_TYPE_ID" data-placeholder="Select">
                                   <option value=""></option>
                                    @foreach($millType as $row)
                                       <option value="{{ $row->UD_ID }}" @if($editMillData->MILL_TYPE_ID==$row->UD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach

                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Capacity</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="REG_TYPE_ID" class="chosen-select chosen-container" name="CAPACITY_ID" data-placeholder="Select">
                                   <option value=""></option>
                                    @foreach($capacity as $row)
                                       <option value="{{ $row->LOOKUPCHD_ID }}" @if($editMillData->CAPACITY_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach

                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Zone</b></label>
                        <div class="col-sm-8">
                                <span class="block input-icon input-icon-right">
                                   <select id="ZONE_IDD" class="chosen-select chosen-container" name="ZONE_ID" data-placeholder="Select">
                                       <option value=""></option>
                                        @foreach($getZone as $row)
                                           <option value="{{ $row->ZONE_CODE }}" @if($editMillData->ZONE_ID==$row->ZONE_CODE) selected @endif>{{ $row->ZONE_NAME }}</option>
                                       @endforeach

                                   </select>
                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Millers ID</b></label>
                        <div class="col-sm-8">
                                <span class="block input-icon input-icon-right">
                                   <input readonly type="text" name="MILLERS_ID" class="chosen-container millersIdd" value="{{ $editMillData->MILLERS_ID }}">
                                </span>
                        </div>
                    </div>



                </div>

                <div class="col-md-6">

                    <div class="form-group" >
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                                <select id="DIVISION_IDD" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">
                                    <option value=""></option>
                                    @foreach($getDivision as $row)
                                        <option value="{{ $row->DIVISION_ID }}" @if($editMillData->DIVISION_ID==$row->DIVISION_ID) selected @endif>{{ $row->DIVISION_NAME }}</option>
                                    @endforeach

                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="DISTRICT_IDD" class="chosen-select chosen-container districtt" name="DISTRICT_ID" data-placeholder="Select">
                                   <option value="{{ $editMillData->DISTRICT_ID }}">{{ $editMillData->DISTRICT_NAME }}</option>
                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Upazila</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="UPAZILA_IDD" class="chosen-select chosen-container upazilaa" name="UPAZILA_ID" data-placeholder="Select">
                                   <option value="{{ $editMillData->UPAZILA_ID }}">{{ $editMillData->UPAZILA_NAME }}</option>
                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Union</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="UNION_IDD" class="chosen-select chosen-container unionn" name="UNION_ID" data-placeholder="Select">
                                   <option value="{{ $editMillData->UNION_ID }}">{{ $editMillData->UNION_NAME }}</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="ACTIVE_FLG" class="chosen-select chosen-container" name="ACTIVE_FLG" data-placeholder="Select">
                                       @if(isset($editMillData))
                                       <option value="1" @if($editMillData->ACTIVE_FLG=='1') selected  @endif >Active</option>
                                       <option value="0" @if($editMillData->ACTIVE_FLG=='0') selected  @endif >Inactive</option>
                                   @else
                                       <option value="1">Active</option>
                                       <option value="0">Inactive</option>
                                   @endif
                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Remarks</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="REMARKS" value="{{ $editMillData->REMARKS }}" class="chosen-container">
                            </span>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 44%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary btnUpdateMill" onclick="millTab()">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Update & Next
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.millmsg').hide();
    $(document).on('click','.btnUpdateMill',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-mill-info',
            data : $('#millId').serialize(),
            success: function (data) {
                console.log(data);
                $('.millmsg').html('<span>'+ data +'</span>').show();

            }
        })
    })
</script>

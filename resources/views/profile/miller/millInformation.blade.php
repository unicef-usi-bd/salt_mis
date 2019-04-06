<div id="mill" class="tab-pane fade in active">
    <div class="row">
        <div class="col-md-12">

            <form action="{{ url('/mill-info') }}" method="post" class="form-horizontal" role="form" >
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Name of Mill</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="MILL_NAME" class="chosen-container">
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
                                                               <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Mill</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="MILL_TYPE_ID" class="chosen-select chosen-container" name="MILL_TYPE_ID" data-placeholder="Select">
                                                           <option value=""></option>
                                                            @foreach($millType as $row)
                                                               <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
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
                                                               <option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Zone</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="ZONE_ID" class="chosen-select chosen-container" name="ZONE_ID" data-placeholder="Select">
                                                           <option value=""></option>
                                                            @foreach($getZone as $row)
                                                               <option value="{{ $row->ZONE_CODE }}">{{ $row->ZONE_NAME }}</option>
                                                           @endforeach

                                                       </select>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Millers ID</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <input readonly type="text" name="MILLERS_ID" class="chosen-container millersId">
                                                    </span>
                        </div>
                    </div>



                </div>

                <div class="col-md-6">

                    <div class="form-group" >
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                        <select id="DIVISION_ID" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">
                                                            <option value=""></option>
                                                            @foreach($getDivision as $row)
                                                                <option value="{{ $row->DIVISION_ID }}">{{ $row->DIVISION_NAME }}</option>
                                                            @endforeach

                                                        </select>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="DISTRICT_ID" class="chosen-select chosen-container district" name="DISTRICT_ID" data-placeholder="Select">
                                                           <option value="">Select</option>

                                                       </select>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Upazila</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="UPAZILA_ID" class="chosen-select chosen-container upazila" name="UPAZILA_ID" data-placeholder="Select">
                                                           <option value="">Select</option>
                                                       </select>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Union</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="UNION_ID" class="chosen-select chosen-container union" name="UNION_ID" data-placeholder="Select">
                                                           <option value="">Select</option>
                                                        </select>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="ACTIVE_FLG" class="chosen-select chosen-container" name="ACTIVE_FLG" data-placeholder="Select">
                                                           <option value="1">Active</option>
                                                           <option value="0">Inactive</option>
                                                       </select>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Remarks</b></label>
                        <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <input type="text" name="REMARKS" class="chosen-container">
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
                        <button type="submit" class="btn btn-primary">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{ trans('dashboard.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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
                                       <option value="">List of Supplier </option>
                                       <option value="purchase-salt-list">List of Item </option>
                                       <option value="purchase-salt-amount">Purchase</option>
                                       <option value="purchase-salt-stock">Total Purchase Stock</option>
                                   </optgroup>
                                   <optgroup label="Purchase Chemical">
                                       <option value="">List of Supplier </option>
                                       <option value="">List of Item </option>
                                       <option value="">Purchase</option>
                                       <option value="">Monitor Supplier</option>
                                       <option value="">Chemical Stock</option>
                                 </optgroup>
                                   <optgroup label="Process">
                                       <option value="">List of Process </option>
                                       <option value="">Process  Stock</option>
                                   </optgroup>
                                   <optgroup label="Sale">
                                       <option value="">List of Client</option>
                                       <option value="">List of Item</option>
                                       <option value="">Sale</option>
                                       <option value="">Monitor Client</option>
                                       <option value="">Item Stock</option>
                                 </optgroup>
                                   <optgroup label="License">
                                       <option value="">List of License </option>
                                  </optgroup>
                                   <optgroup label="QC">
                                       <option value="">List of QC </option>
                                  </optgroup>
                                   <optgroup label="HR">
                                       <option value="">List of HR </option>
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
<div id="employee" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">

            <div class="col-md-6">

                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('soeReport.report_type') }}</b></label>
                    <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                       <select id="hortexActivityId" class="chosen-select" data-placeholder="Select or search data">
                                                           <option></option>
                                                            <optgroup label="SOE Report">
                                                               <option value="get-soe-report">{{ trans('soeReport.monthly_soe_report') }}</option>
                                                            </optgroup>
                                                       </select>
                                                    </span>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 10%;">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('soeReport.hortex_list') }}</b></label>
                    <div class="col-sm-8">
                                                    <span class="block input-icon input-icon-right">
                                                        <select id="hortexCostCenter" class="chosen-select chosen-container" data-placeholder="Select or search data">
                                                            <option value=""></option>
                                                            {{--@foreach($hortex as $hor)--}}
                                                            {{--<option value="{{ $hor->cost_center_id }}">{{ $hor->cost_center_name }}</option>--}}
                                                            {{--@endforeach--}}

                                                        </select>
                                                    </span>
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group soeDate">
                    <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('soeReport.soe_date') }}</b></label>
                    <div class="col-xs-12 col-sm-8">
                        <input id="hortexSoeDate" class="col-sm-12" type="date" value="">

                    </div>
                </div>

                <button type="submit" cost-center-type="hortex" class="btn btn-info btnShowReport" style="margin-left: 10px;margin-top: 15px;">
                    <i class="ace-icon fa fa-eye bigger-110"></i>
                    {{ trans('soeReport.show_report') }}
                </button>


            </div>
        </div>
    </div>
</div>
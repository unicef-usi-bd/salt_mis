<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12" style="margin-top: 10px">
    <form action="{{ url('/monitoring/'.$editMonitoring->MILLMONITORE_ID) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    {{--<form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">--}}

        @csrf
        @method('PUT')
        <div class="col-md-12" style="padding: 0px;">
            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_name') }}</b><span style="color: red;"> *</span> </label>--}}
                {{--<div class="col-xs-12 col-sm-7">--}}
            {{--<span class="block input-icon input-icon-right">--}}
                {{--<input autocomplete="off" type="text" id="inputSuccess module_name" name="module_name" value="{{ $editModule->MODULE_NAME }}" class="width-100" />--}}
                {{--<input autocomplete="off" type="text" id="inputSuccess module_name" name="module_name" value="1" class="width-100" />--}}
            {{--</span>--}}

                {{--</div>--}}
            {{--</div>--}}

            <div class="form-group">
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_icon') }}</b></label>--}}
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Agency Name </b><span style="color: red;"> *</span></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" name="AGENCY_ID">
                            <option value="">Select One</option>
                            @foreach($agencyName as $row)
                                <option value="{{$row->LOOKUPCHD_ID}}" @if($row->LOOKUPCHD_ID==$editMonitoring->AGENCY_ID) selected @endif> {{$row->LOOKUPCHD_NAME}}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>

            <div class="form-group">
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_icon') }}</b></label>--}}
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Monitoring Date</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="date" name="MOMITOR_DATE" class="form-control" value="{{ $editMonitoring->MOMITOR_DATE }}"/>
                    </span>
                </div>
            </div>
            <div class="form-group">
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_icon') }}</b></label>--}}
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Remarks</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        {{--<input autocomplete="off" type="text" name="REMARKS" value="{{ $editMonitoring->REMARKS }}" id="inputSuccess module_icon" class="width-100" placeholder="Example:- Remarks Here" />--}}
                        <textarea class="form-control col-sm-8" rows="3"  id="inputSuccess DESCRIPTION form-field-8" name="REMARKS" placeholder="Remarks">{{ $editMonitoring->REMARKS }}</textarea>
                    </span>
                </div>
            </div>

        </div>


        <div style="text-align: center;" class="form-group">
            <button type="reset" class="btn" disabled>
                <i class="ace-icon fa fa-undo bigger-110"></i>
                {{ trans('dashboard.reset') }}
            </button>
            <button type="submit" class="btn btn-info">
                <i class="ace-icon fa fa-check bigger-110"></i>
                {{ trans('dashboard.update') }}
            </button>
        </div>
    </form>
</div>

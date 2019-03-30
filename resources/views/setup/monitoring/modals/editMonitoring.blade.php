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
                {{--<input type="text" id="inputSuccess module_name" name="module_name" value="{{ $editModule->MODULE_NAME }}" class="width-100" />--}}
                {{--<input type="text" id="inputSuccess module_name" name="module_name" value="1" class="width-100" />--}}
            {{--</span>--}}

                {{--</div>--}}
            {{--</div>--}}

            <div class="form-group">
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_icon') }}</b></label>--}}
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Agency Name *</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" name="AGENCY_ID">
                            <option value="">Select One</option>
                            @foreach($crudeSaltType as $row)
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
                        <input type="text" name="MOMITOR_DATE" value="{{ $editMonitoring->MOMITOR_DATE }}" id="inputSuccess module_icon" class="width-100"  />

                    </span>
                </div>
            </div>
            <div class="form-group">
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('module.module_icon') }}</b></label>--}}
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Remarks</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="REMARKS" value="{{ $editMonitoring->REMARKS }}" id="inputSuccess module_icon" class="width-100"  />
                    </span>
                </div>
            </div>

        </div>

        <div class="clearfix">
            <div class="col-md-offset-5 col-md-7" style="margin-top: 20px;">
                <button type="reset" class="btn" disabled="disabled">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-info" id="formSubmit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.update') }}
                </button>
            </div>
        </div>
    </form>
</div>

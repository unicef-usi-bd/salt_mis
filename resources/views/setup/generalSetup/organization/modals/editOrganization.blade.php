<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12">
    <form action="{{ url('/organization/'.$editData->org_id) }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
        @csrf
        @method('PUT')

        <div class="col-md-6" style="padding: 0px;">
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" id="inputSuccess org_name" name="org_name" value="{{ $editData->org_name }}" class="width-100" />
            </span>

                </div>
            </div>

            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.org_type') }}</b></label>--}}
                {{--<div class="col-xs-12 col-sm-7">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<select class="form-control" name="lender_status">--}}
                            {{--<option value="">{{ trans('organization.select_one') }}</option>--}}
                            {{--<option value="1" @if($editData->lender_status=1) selected @endif>Lender</option>--}}
                            {{--<option value="0" @if($editData->lender_status=0) selected @endif>General</option>--}}
                        {{--</select>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.address') }}</b><span style="color: red;"> </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="org_address" value="{{ $editData->org_address }}" id="inputSuccess ogr_address" class="width-100"  />
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.slogan') }}</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="org_slogan" id="inputSuccess org_slogan" value="{{ $editData->org_slogan }}" class="width-100"  />
                    </span>
                </div>
            </div>


            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.logo') }}</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="file" name="org_logo" id="inputSuccess org_logo" value="" class="width-100"  style="margin-top: 7px;"/>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('cigGroup.active_status') }}</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" name="active_status">
                            <option value="">{{ trans('organization.select_one') }}</option>
                            <option value="1" @if($editData->active_status=1) selected @endif>Active</option>
                            <option value="0" @if($editData->active_status=0) selected @endif>Inactive</option>
                        </select>
                    </span>
                </div>
            </div>

        </div>
        <div class="col-md-6" style="padding: 0px;">
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.email') }}</b></label>
                <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text"  name="email_address" id="inputSuccess email_address" value="{{ $editData->email_address }}" class="width-100"  />
             </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.phone') }}</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="phone" id="inputSuccess phone" value="{{ $editData->phone }}" class="width-100"  />
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.website') }}</b><span style="color: red;"> </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="website" id="inputSuccess website" value="{{ $editData->website }}" class="width-100"  />
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.fax') }}</b><span style="color: red;"> </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="fax" id="inputSuccess fax" value="{{ $editData->fax }}" class="width-100" />
                    </span>
                </div>
            </div>

            {{--<h4 class="text-center text-info" style="margin-top: 25px;font-weight: bold;">{{ trans('organization.bank_info') }}</h4>--}}

            {{--<div class="form-group" style="margin-top: 15px;">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.bank_name') }}</b></label>--}}
                {{--<div class="col-xs-12 col-sm-7">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<select class="form-control bank" id="bank_id" name="bank_id">--}}
                            {{--<option value="">{{ trans('organization.select_one') }}</option>--}}
                            {{--@foreach($banks as $bank)--}}
                                {{--<option value="{{ $bank->bank_id }}" @if($editData->bank_id==$bank->bank_id) selected @endif>{{ $bank->bank_name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.branch_name') }}</b></label>--}}
                {{--<div class="col-xs-12 col-sm-7">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<select class="form-control branch" id="branch_id" name="branch_id" data-placeholder="{{ trans('organization.select_one') }}">--}}
                            {{--<option value="{{ $editData->branch_id }}">{{ $editData->bank_branch_name }}</option>--}}
                        {{--</select>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.account_no') }}</b> </label>--}}
                {{--<div class="col-xs-12 col-sm-7">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<input type="text" name="account_no" value="{{ $editData->account_no }}" id="inputSuccess account_no" class="width-100"  />--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('organization.route_no') }}</b></label>--}}
                {{--<div class="col-xs-12 col-sm-7">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<input type="text" name="route_no" id="inputSuccess route_no" value="{{ $editData->route_no }}" class="width-100"  />--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>

        <div class="clearfix">
            <div class="col-md-offset-5 col-md-7" style="margin-top: 20px;">
                <button type="reset" class="btn" disabled>
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
{{--@include('masterGlobal.formValidation')--}}
@include('masterGlobal.formValidationEdit')
@include('masterGlobal.getBankBranchesEvent')
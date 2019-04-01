<div class="col-md-12">
<!-- PAGE CONTENT BEGINS -->
    <form action="{{ url('/cost-center/'.$editData->cost_center_id) }}" method="post" class="form-horizontal checkValidation" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"> <b>{{ trans('costCenterType.cost_center_type_name') }}</b> <span style="color: red;"> *</span></label>
            <div class="col-xs-12 col-sm-7">
                <span class="block input-icon input-icon-right">
                    <select class="form-control addInputField" id="cost_center_type" name="cost_center_type">
                        <option value="">Select One</option>
                        @foreach($costTypes as $costType)
                            <option value="{{ $costType->cost_center_type_id }}" @if($costType->cost_center_type_id==$editData->cost_center_type) selected @endif> {{ $costType->cost_center_type_name }} </option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>

        @if($editData->cost_center_type==4)
        <div class="form-group showSelector">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('association') }}</b></label>
            <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <select class="form-control cost_center_status_type" name="cost_center_status_type">
                    <option value="">Select One</option>
                    @foreach($upzilaType as $upzila)
                        <option value="{{ $upzila->lookup_group_data_id }}" @if($upzila->lookup_group_data_id==$editData->cost_center_status_type) selected @endif >{{ $upzila->group_data_name }}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>
        @else
            <div class="form-group hidden showSelector">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('lookupGroupIndex.name') }}</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control cost_center_status_type" name="cost_center_status_type">
                            <option value="">Select One</option>
                            @foreach($upzilaType as $upzila)
                                <option value="{{ $upzila->lookup_group_data_id }}" @if($upzila->lookup_group_data_id==$editData->cost_center_status_type) Selected @endif >{{ $upzila->group_data_name }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
        @endif

        <script>
            $( ".addInputField" ).change(function() {
                var getValue = $(this).val();
                if(getValue==4){
                    $('.showSelector').removeClass( "hidden" );
                } else {
                    $('.showSelector').addClass( "hidden" );
                    $('.cost_center_status_type').val(0);
                }
            });
        </script>

        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"> <b>{{ trans('lookupGroupIndex.name') }} </b><span style="color: red;"> *</span></label>
            <div class="col-xs-12 col-sm-7">
                <span class="block input-icon input-icon-right">
                    <input type="text" id="inputSuccess cost_center_name" name="cost_center_name" value="{{ $editData->cost_center_name }}" class="width-100" />
                </span>

            </div>
        </div>

        <div class="form-group" style="margin-top: 15px;">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('bank.bank_name') }}</b><span style="color: red;"> *</span></label>
            <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control bank" id="bank_id" name="bank_id">
                            <option>Select One</option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank->bank_id }}" @if($bank->bank_id==$editData->bank_id) selected @endif>{{ $bank->bank_name }}</option>
                            @endforeach
                        </select>
                    </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('bankBranch.branch_name') }}</b><span style="color: red;"> *</span></label>
            <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control branch" id="branch_id" name="branch_id">
                            <option value="{{ $editData->branch_id }}">{{ $editData->bank_branch_name }}</option>
                        </select>
                    </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('cigGroup.bank_account') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="account_no" value="{{ $editData->account_no }}" id="inputSuccess account_no" class="width-100"  />
                    </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('bankBranch.route_no') }}</b></label>
            <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="route_no" id="inputSuccess route_no" value="{{ $editData->route_no }}" class="width-100"  />
                    </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('cigGroup.active_status') }}</b></label>
            <div class="col-xs-12 col-sm-7">
                <span class="block input-icon input-icon-right">
                    <select class="form-control" name="active_status">
                        <option value="">Select One</option>
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </span>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn" disabled>
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-info" id="formSubmit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>

    </form>
    @include('masterGlobal.formValidation')
    @include('masterGlobal.getBankBranchesEvent')
</div>
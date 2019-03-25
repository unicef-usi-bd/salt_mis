<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>
    {{--<form action="{{ url('/users') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">--}}
    <form class="form-horizontal frmContent" name="formData" method="POST">
        @csrf

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.user_full_name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess" placeholder="{{ trans('user.example_full_nameen') }}" name="user_full_name" class="form-control col-sm-8" value="{{ old('username') }}"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.full_namebn') }}</b></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess" placeholder="{{ trans('user.example_full_namebn') }}" name="user_full_name_bn" class="form-control col-sm-8" value="{{ old('username') }}"/>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.user_name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess username" placeholder="{{ trans('user.example_user_name') }}" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 " value="{{ old('username') }}"/>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.email') }}</b><span style="color: red;"> </span></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess email" placeholder="{{ trans('user.example_email') }}" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} col-xs-10 col-sm-5" value="{{ old('email') }}"/>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.password') }}</b> <span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                    <input type="password" id="inputSuccess password" placeholder="{{ trans('user.example_password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} col-xs-10 col-sm-5" value=""/>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.address') }}</b></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess address" placeholder="{{ trans('user.example_address') }}" name="address" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.contact_no') }}</b></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess contact_no" placeholder="{{ trans('user.example_contact_no') }}" name="contact_no" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>

           <!--  <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess remarks" placeholder="Example:- Remarks Here " name="remarks" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div> -->

        </div>

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.image') }}</b></label>
                <div class="col-sm-8">
                    <input type="file" name="user_image" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.signature') }}</b></label>
                <div class="col-sm-8">
                    <input type="file" name="user_signature" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.user_group') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess user_group" class="chosen-select form-control user_group" name="user_group_id" data-placeholder="Select or search data">
                                <option value=""> </option>
                                @foreach($userGroups as $userGroup)
                                    <option value="{{$userGroup->USERGRP_ID}}"> {{$userGroup->USERGRP_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.group_level') }}</b></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess user_group_level" class=" form-control user_group_level" name="user_group_level_id" data-placeholder="Select or search data">
                                <option value="">Select One</option>
                            </select>
                        </span>
                </div>
            </div>


            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.cost_center') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select id="form-field-select-3 inputSuccess cost_center_id" class="chosen-select form-control" name="cost_center_id" data-placeholder="Select or search data">
                            <option value=""> </option>
                            @foreach($costCenters as $costCenter)
                                <option value="{{$costCenter->cost_center_id}}"> {{$costCenter->cost_center_name}}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.designation') }}</b><span style="color: red;"> </span></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select id="form-field-select-3 inputSuccess designation_id" class="chosen-select form-control" name="designation_id" data-placeholder="Select or search data">
                            <option value=""> </option>
                            @foreach($designations as $designation)
                            <option value="{{$designation->lookup_group_data_id}}"> {{$designation->group_data_name}}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>

            <!-- <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status </b></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select id="inputSuccess active_status" class="form-control" name="active_status">
                            <option value="">Select One</option>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </span>
                </div>
            </div> -->

             <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.remark') }}</b></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess remarks" placeholder="{{ trans('user.example_remarks_here') }}" name="remarks" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>


            {{--<div class="form-group" style="margin-top: 15px;">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Bank Name</b><span style="color: red;"> *</span></label>--}}
                {{--<div class="col-xs-12 col-sm-8">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<select class="form-control bank" id="bank_id" name="bank_id">--}}
                            {{--<option>Select One</option>--}}
                            {{--@foreach($banks as $bank)--}}
                                {{--<option value="{{ $bank->bank_id }}">{{ $bank->bank_name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Branch</b><span style="color: red;"> *</span></label>--}}
                {{--<div class="col-xs-12 col-sm-8">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<select class="form-control branch" id="branch_id" name="branch_id">--}}
                            {{--<option>Select One</option>--}}
                        {{--</select>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Account no.</b><span style="color: red;"> *</span> </label>--}}
                {{--<div class="col-xs-12 col-sm-8">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<input type="text" name="account_no" value="{{ old('account_no') }}" id="inputSuccess account_no" class="width-100"  />--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Route no.</b></label>--}}
                {{--<div class="col-xs-12 col-sm-8">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<input type="text" name="route_no" id="inputSuccess route_no" value="{{ old('route_no') }}" class="width-100"  />--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>


        <hr>
        <div class="clearfix">
            <div class="center col-md-12" style="margin-top: 25px;">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'users' }}">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            $('.user_group').on('change',function(){
                var groupId = $(this).val();
                var option = '<option>Select One</option>';
                $.ajax({
                    type : "get",
                    url  : "get-user-group-levels",
                    data : {'group_id': groupId},
                    success:function (data) {
//                        console.log(data);exit();
                        for (var i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].UG_LEVEL_ID +'">'+ data[i].UGLEVE_NAME+'</option>';
                        }
                        $('.user_group_level').html(option);
                        $('.user_group_level').trigger("chosen:updated");
//                        alert(data);
                    }
                });
            });
        });
    </script>
</div>
@include('masterGlobal.chosenSelect')
{{--@include('masterGlobal.formValidation')--}}
@include('masterGlobal.getBankBranchesEvent')




<div class="col-md-12">
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>
    <form id="myform" action="{{ url('/users/'.$editData->id) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.user_full_name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess" placeholder="{{ trans('user.example_full_nameen') }}" name="user_full_name" class="form-control col-sm-8" value="{{ $editData->user_full_name }}"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.full_namebn') }}</b></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess" placeholder="{{ trans('user.example_full_namebn') }}" name="user_full_name_bn" class="form-control col-sm-8" value="{{ $editData->user_full_name_bn }}"/>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.user_name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess username" placeholder="{{ trans('user.example_user_name') }}" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 " value="{{ $editData->username }}" />
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.email') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8 email_grp">
                    <input type="text" id="inputSuccess email" placeholder="{{ trans('user.example_email') }}" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 email" value="{{ $editData->email }}"/>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.password') }}</b> </label>
                <div class="col-sm-8">
                    <input type="password" id="inputSuccess password" placeholder="{{ trans('user.example_password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} col-xs-10 col-sm-5"/>
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
                    <input type="text" id="inputSuccess address" placeholder="{{ trans('user.example_address') }}" name="address" class="form-control col-xs-10 col-sm-5" value="{{ $editData->address }}"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.contact_no') }}</b></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess contact_no" placeholder="{{ trans('user.example_contact_no') }}" name="contact_no" class="form-control col-xs-10 col-sm-5" value="{{ $editData->contact_no }}"/>
                </div>
            </div>

           <!--  <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess remarks" name="remarks" class="form-control col-xs-10 col-sm-5" value="{{ $editData->remarks }}"/>
                </div>
            </div> -->

            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.active_status') }}</b></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select id="inputSuccess active_status" class="form-control" name="active_status">
                            <option value="">Select One</option>
                            <option value="1" @if($editData->active_status==1) selected @endif >Active</option>
                            <option value="0" @if($editData->active_status==0) selected @endif >Inactive</option>
                        </select>
                    </span>
                </div>
            </div>
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
                            <select id="privileges" onclick="craateUserJsObject.ShowPrivileges();" class="form-control user_group" name="user_group_id" data-placeholder="Select User Group">
                                <option value="">-Select One-</option>
                                @foreach($userGroups as $userGroup)
                                    <option value="{{$userGroup->USERGRP_ID}}" @if($userGroup->USERGRP_ID==$editData->user_group_id) selected @endif> {{$userGroup->USERGRP_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                </div>
            </div>

            <div class="form-group" >
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.group_level') }}</b><span style="color: red;"> </span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess user_group_level" class=" form-control user_group_level" name="user_group_level_id" data-placeholder="Select Group Level">
                                <option value="">-Select One-</option>
                                @foreach($userGroupLevels as $userGroupLevel)
                                <option value="{{ $userGroupLevel->UG_LEVEL_ID }}" @if($editData->user_group_level_id==$userGroupLevel->UG_LEVEL_ID) selected @endif>{{ $userGroupLevel->UGLEVE_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                </div>
            </div>

            {{--<div class="form-group resources"  >--}}
                {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Center</b><span style="color: red;"></span></label>--}}
                {{--<div class="col-sm-8">--}}
                        {{--<span class="block input-icon input-icon-right">--}}
                            {{--<select id="form-field-select-3 inputSuccess center_id" class=" form-control" name="center_id" data-placeholder="Select Center">--}}
                                {{--<option value="">-Select One- </option>--}}
                                {{--@foreach($associationCenter as $center)--}}
                                    {{--<option value="{{ $center->ASSOCIATION_ID }}" @if($center->ASSOCIATION_ID==$editData->center_id) selected @endif>{{ $center->ASSOCIATION_NAME }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="form-group resources"  >
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Center</b><span style="color: red;"></span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess center_id" class=" form-control" name="center_id" data-placeholder="Select Center">
                                @foreach($associationCenter as $center)
                                    <option value="<?php echo $center->ASSOCIATION_ID ?>" @if($center->ASSOCIATION_ID==$editData->center_id) selected @endif><?php echo $center->ASSOCIATION_NAME ?></option>
                                    <?php $miller = DB::select(DB::raw("SELECT a.ASSOCIATION_ID,a.ASSOCIATION_NAME from ssm_associationsetup a where a.PARENT_ID = $center->ASSOCIATION_ID "));?>
                                    @foreach($miller as $row)
                                        <option value="{{$row->ASSOCIATION_ID}}" @if($row->ASSOCIATION_ID==$editData->center_id) selected @endif> {{$row->ASSOCIATION_NAME}}</option>
                                    @endforeach

                                @endforeach
                            </select>
                        </span>
                </div>
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.cost_center') }}</b><span style="color: red;"> *</span></label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<select id="form-field-select-3 inputSuccess cost_center_id" class="chosen-select form-control" name="cost_center_id" data-placeholder="Select or search data">--}}
                            {{--<option value=""> </option>--}}
                            {{--@foreach($costCenters as $costCenter)--}}
                                {{--<option value="{{$costCenter->cost_center_id}}" @if($costCenter->cost_center_id==$editData->cost_center_id) selected @endif> {{ $costCenter->cost_center_name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.designation') }}</b><span style="color: red;"> </span></label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<select id="form-field-select-3 inputSuccess designation_id" class="chosen-select form-control" name="designation_id" data-placeholder="Select or search data">--}}
                            {{--<option value=""> </option>--}}
                            {{--@foreach($designations as $designation)--}}
                                {{--<option value="{{ $designation->lookup_group_data_id}}" @if($designation->lookup_group_data_id==$editData->designation_id) selected @endif> {{ $designation->group_data_name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group" style="margin-top: 15px;">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Bank Name</b><span style="color: red;"> *</span></label>--}}
                {{--<div class="col-xs-12 col-sm-8">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<select class="form-control bank" id="bank_id" name="bank_id">--}}
                            {{--<option>Select One {{ $editData->bank_id }} </option>--}}
                            {{--@foreach($banks as $bank)--}}
                                {{--<option value="{{ $bank->bank_id }}" @if($bank->bank_id==$editData->bank_id) selected @endif >{{ $bank->bank_name }}</option>--}}
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
                            {{--<option value="{{ $editData->branch_id }}">{{ $editData->bank_branch_name }}</option>--}}
                        {{--</select>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Account no.</b><span style="color: red;"> *</span> </label>--}}
                {{--<div class="col-xs-12 col-sm-8">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<input type="text" name="account_no" value="{{ $editData->account_no }}" id="inputSuccess account_no" class="width-100"  />--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Route no.</b></label>--}}
                {{--<div class="col-xs-12 col-sm-7">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<input type="text" name="route_no" id="inputSuccess route_no" value="{{ $editData->route_no }}" class="width-100"  />--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}
             <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.remark') }}</b></label>
                <div class="col-sm-8">
                    {{--<input type="text" id="inputSuccess remarks" name="remarks" placeholder="{{ trans('user.example_remarks_here') }}" class="form-control col-xs-10 col-sm-5" value="{{ $editData->remarks }}"/>--}}
                    <textarea class="form-control col-xs-10 col-sm-5" name="remarks" rows="3">{{ $editData->remarks }}</textarea>
                </div>
            </div>
        </div>

        <hr>
        <div class="clearfix">
            <div class="col-md-offset-4 col-md-4" style="margin-top: 25px;">
                <button type="reset" class="btn" disabled="disabled">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-info">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.update') }}
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
        var Privileges = jQuery('#privileges');
        var select = this.value;
        Privileges.change(function () {
            if ($(this).val() == 21 || $(this).val() == 22) {
                $('.resources').show();
            }
            else $('.resources').hide();
        });

        $(document).ready(function () {
            $.validator.addMethod(
                "regex",
                function(value, element, regexp)
                {
                    if (regexp.constructor != RegExp)
                        regexp = new RegExp(regexp);
                    else if (regexp.global)
                        regexp.lastIndex = 0;
                    return this.optional(element) || regexp.test(value);
                },
                "Please check your input."
            );

            $('#myform').validate({ // initialize the plugin
                errorClass: "my-error-class",
                //validClass: "my-valid-class",
                rules: {
                    user_full_name: {
                        required: true,
                        maxlength:100
                    },
                    username: {
                        required: true,
                        maxlength: 100
                    },
                    email:{
                        required: true,
                        email: true,
                    },
//                    messages:{
//                        email: {
//                        remote: jQuery.format("{0} is already in use!")
//                    }
//                },
                    password:{
                        required: true,
                        minlength:6
                    },
                    contact_no:{
                        required: true,
                        maxlength:11,
                        minlength:11,
                        regex:/^(?:\+?88)?01[15-9]\d{8}$/,
                    },
                    user_group_id:{
                        required: true,
                    },
                    user_group_level_id:{
                        required: true,
                    },
                    center_id:{
                        required: true,
                    }
                }
            });

        });

        $(document).on('focusout','.email',function () {
            //alert('hi');
            var email = $('.email').val();
            //alert(email);
            $.ajax({
                type: 'GET',
                url:'email-duplicate',
                data:{'email':email},
                async: false,
                success:function (data){
                    if(data=='yes')
                    {
                        $('.emailId').text('');
                        $('.email_grp').append('<span class="emailId" style="color: red">This email already exists</span>');
                    }
                    else
                        $('.emailId').text('');
                }
            });
        });
    </script>
<!--    --><?php
//    //MySQL class: http://mbe.ro/2009/08/30/fast-and-easy-php-mysql-class/
//    //require('../shared/db-class.php');
//    $email = $_REQUEST["email"];
//    //$email = 'test@gmail.com'; // Just for testing.
//    $validate = new mysql();
//    $checkemail = $validate->query("SELECT * FROM users WHERE email = '$email'");
//    if (count($checkemail) == 1){
//        $valid = "false";
//    } else {
//        $valid = "true";
//    }
//    echo $valid;
//    ?>

</div>

{{--@include('masterGlobal.formValidationEdit')--}}
@include('masterGlobal.chosenSelect')
@include('masterGlobal.getBankBranchesEvent')




<div class="col-md-12">
    <form action="{{ url('/users') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.user_full_name') }}</b><span style="color: red;"></span> </label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="fullname" placeholder="Example:- {{ trans('user.example_full_nameen') }}" name="user_full_name" class="form-control col-sm-8 fullname" value="{{ old('username') }}"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Designation</b></label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess" placeholder="Example:- Designation Here" name="designation" class="form-control col-sm-8" value="{{ old('username') }}"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.user_name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="username" placeholder="Example:-{{ trans('user.example_user_name') }}" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 username" value="{{ old('username') }}"/>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif</div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.email') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8 email_grp">
                    <input autocomplete="off" type="text" id="inputSuccess email" placeholder="Example:- {{ trans('user.example_email') }}" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 email" value="{{ old('email') }}"/>
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
                    <input autocomplete="off" type="password" id="inputSuccess password" placeholder="Example:- {{ trans('user.example_password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 password" value=""/>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.re_password') }}</b> <span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                    <input autocomplete="off" id="password-confirm" type="password" class="form-control required" name="password_confirmation" placeholder="Example:- Confirm Password Here"/>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.contact_no') }}.</b><span style="color: red;"> </span></label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess contact_no" placeholder="Example:- {{ trans('user.example_contact_no') }}." name="contact_no" class="form-control col-xs-10 col-sm-5 contact_no" value=""/>
                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.image') }}</b></label>
                <div class="col-sm-8">
                    <input type="file" id="user_image" name="user_image" class="form-control col-xs-10 col-sm-5 user_image" value=""/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.signature') }}</b></label>
                <div class="col-sm-8">
                    <input type="file" id="user_signature" name="user_signature" class="form-control col-xs-10 col-sm-5 user_signature" value=""/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.user_group') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="privileges" onclick="craateUserJsObject.ShowPrivileges();" class=" form-control user_group" name="user_group_id" data-placeholder="Select User Group">
                                <option value="">-Select-</option>
                                @foreach($userGroups as $userGroup)
                                    <option value="{{$userGroup->USERGRP_ID}}"> {{$userGroup->USERGRP_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.group_level') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess user_group_level" class=" form-control user_group_level" name="user_group_level_id" data-placeholder="Select Group Level">
                                <option value="">-Select-</option>
                            </select>
                        </span>
                </div>
            </div>

            <div class="form-group resources"  style=" display: none;">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Mills Name</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess center_id" class="form-control" name="center_id" data-placeholder="Select Center">
                                <option value="">-Select-</option>
                                @foreach($associationCenter as $center)
                                    <option value="<?php echo $center->ASSOCIATION_ID ?>"><?php echo $center->ASSOCIATION_NAME ?></option>
                                    @php

                                    $miller = DB::table('ssm_associationsetup as sas')
                                    ->select('sas.ASSOCIATION_ID', 'sas.ASSOCIATION_NAME', 'sas.MILL_ID', 'smi.ACTIVE_FLG', 'smi.FINAL_SUBMIT_FLG')
                                    ->leftJoin('ssm_mill_info as smi', 'sas.MILL_ID', '=', 'smi.MILL_ID' )
                                    ->where('sas.PARENT_ID', '=', $center->ASSOCIATION_ID)
                                    ->where('smi.ACTIVE_FLG', '=', 1)
                                    ->where('smi.FINAL_SUBMIT_FLG', '=', 1)
                                    ->get();

                                    @endphp
                                    @foreach($miller as $row)
                                        <option value="{{$row->ASSOCIATION_ID}}"> {{$row->ASSOCIATION_NAME}}</option>
                                    @endforeach

                                @endforeach
                            </select>
                        </span>
                    <span><p class='result7'></p></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.address') }}</b></label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess address" placeholder="Example:- {{ trans('user.example_address') }}" name="address" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>

             <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.remark') }}</b></label>
                <div class="col-sm-8">
                    <textarea class="form-control col-xs-10 col-sm-5" name="remarks" rows="3"></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="clearfix">
            <div class="center col-md-12" style="margin-top: 25px;">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            $('.user_group').on('change',function(){
                let groupId = $(this).val();
                let option = '<option value="">-Select-</option>';
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

        let Privileges = jQuery('#privileges');
        let select = this.value;

        Privileges.change(function () {
            if ($(this).val() == 22) {
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
        });

        $(document).on('focusout','.email',function () {
            var email = $('.email').val();
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

</div>

@include('masterGlobal.chosenSelect')
@include('masterGlobal.getBankBranchesEvent')
@include('masterGlobal.ajaxFormSubmit')




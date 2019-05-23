<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>
    <form id="myform" action="{{ url('/users') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
        @csrf

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.user_full_name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="fullname" placeholder="{{ trans('user.example_full_nameen') }}" name="user_full_name" class="form-control col-sm-8 fullname" value="{{ old('username') }}"/>
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
                    <input type="text" id="username" placeholder="{{ trans('user.example_user_name') }}" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 username" value="{{ old('username') }}"/>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif</div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.email') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8 email_grp">
                    <input type="text" id="inputSuccess email" placeholder="{{ trans('user.example_email') }}" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 email" value="{{ old('email') }}"/>
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
                    <input type="password" id="inputSuccess password" placeholder="{{ trans('user.example_password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 password" value=""/>
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
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.contact_no') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess contact_no" placeholder="{{ trans('user.example_contact_no') }}" name="contact_no" class="form-control col-xs-10 col-sm-5 contact_no" value=""/>

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
                    <input type="file" name="user_image" class="form-control col-xs-10 col-sm-5 user_image" value=""/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.signature') }}</b></label>
                <div class="col-sm-8">
                    <input type="file" name="user_signature" class="form-control col-xs-10 col-sm-5 user_signature" value=""/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.user_group') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="privileges" onclick="craateUserJsObject.ShowPrivileges();" class=" form-control user_group" name="user_group_id" data-placeholder="Select User Group">
                                <option value="">-Select One-</option>
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
                                <option value="">-Select One-</option>
                            </select>
                        </span>
                </div>
            </div>

            {{--<div class="form-group resources"  style=" display: none;">--}}
                {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Center</b><span style="color: red;">*</span></label>--}}
                {{--<div class="col-sm-8">--}}
                        {{--<span class="block input-icon input-icon-right">--}}
                            {{--<select id="form-field-select-3 inputSuccess center_id" class="form-control" name="center_id" data-placeholder="Select Center">--}}
                                {{--<option value="">-Select One-</option>--}}
                                {{--@foreach($associationCenter as $center)--}}
                                    {{--<option value="{{$center->ASSOCIATION_ID}}"> {{$center->ASSOCIATION_NAME}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</span>--}}
                    {{--<span><p class='result7'></p></span>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="form-group resources"  style=" display: none;">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Center</b><span style="color: red;">*</span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess center_id" class="form-control" name="center_id" data-placeholder="Select Center">

                                @foreach($associationCenter as $center)
                                    <option value="<?php echo $center->ASSOCIATION_ID ?>"><?php echo $center->ASSOCIATION_NAME ?></option>
<!--                                        --><?php //$miller = DB::select(DB::raw("SELECT a.ASSOCIATION_ID,a.ASSOCIATION_NAME from ssm_associationsetup a where a.PARENT_ID = $center->ASSOCIATION_ID "));?>
                                        <?php
                                    $miller = DB::select(DB::raw("SELECT a.ASSOCIATION_ID,a.ASSOCIATION_NAME ,a.MILL_ID,mi.ACTIVE_FLG,me.FINAL_SUBMIT_FLG
                                                                                from ssm_associationsetup a
                                                                                left join ssm_mill_info mi on mi.MILL_ID = a.MILL_ID
                                                                                left join ssm_millemp_info me on me.MILL_ID = a.MILL_ID
                                                                                where a.PARENT_ID = $center->ASSOCIATION_ID
                                                                                and mi.ACTIVE_FLG = 1
                                                                                and me.FINAL_SUBMIT_FLG = 1 "));
                                        ?>
                                        @foreach($miller as $row)
                                        <option value="{{$row->ASSOCIATION_ID}}"> {{$row->ASSOCIATION_NAME}}</option>
                                        @endforeach

                                @endforeach
                            </select>
                        </span>
                    <span><p class='result7'></p></span>
                </div>
            </div>


            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.cost_center') }}</b><span style="color: red;"> *</span></label>--}}
                {{--<div class="col-sm-8">--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                        {{--<select id="form-field-select-3 inputSuccess cost_center_id" class="chosen-select form-control" name="cost_center_id" data-placeholder="Select or search data">--}}
                            {{--<option value=""> </option>--}}
                            {{--@foreach($costCenters as $costCenter)--}}
                                {{--<option value="{{$costCenter->cost_center_id}}"> {{$costCenter->cost_center_name}}</option>--}}
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
                            {{--<option value="{{$designation->lookup_group_data_id}}"> {{$designation->group_data_name}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

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
                    {{--<input type="text" id="inputSuccess remarks" placeholder="{{ trans('user.example_remarks_here') }}" name="remarks" class="form-control col-xs-10 col-sm-5" value=""/>--}}
                    <textarea class="form-control col-xs-10 col-sm-5" name="remarks" rows="3"></textarea>
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
                {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'users' }}">--}}
                    {{--<i class="ace-icon fa fa-check bigger-110"></i>--}}
                    {{--{{ trans('dashboard.submit') }}--}}
                {{--</button>--}}
                <button type="submit" id="validate" class="btn btn-primary validate">
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
                        maxlength: 100,
                    },
                    email:{
                        required: true,
                        email: true
                    },
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

//        $(document).on('submit', function(e){
//            var email = $('.email').val();
//           // span.text('');
//            e.preventDefault(); // <=================== Here
//            $.ajax({
//                url: 'email-duplicate',
//                async: 'false',
//                cache: 'false',
//                type: 'GET',
//                data:{'email':email},
//                //data: form.serialize(),
//                success: function(data) {
//                    if (data == 'yes') {
//                        // ============================ Not here, this would be too late
//                        $('.emailId').text('');
//                        $('.email_grp').append('<span class="emailId" style="color: red">This email already exists</span>');
//                    }
//                    else if (data == 'no') {
//                        $('.emailId').text('');
//                    }
//                }
//            });
//        });

        //===========image validation============
        $(".user_image").bind('change',function () {
            var fileSize = this.files[0].size;
            var maxSize = 25000;//25kb; // alert(maxSize);
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
            var filename = $('input[type=file]').val().split('\\').pop();

            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Only  "+fileExtension.join(', ')+" formats are allowed");
                $(".user_image").val('');
            }
            if (fileSize>maxSize){
                alert("File size exceeds maximum size");
                $(".user_image").val('');
            }
        });
        $(".user_signature").bind('change',function () {
            var fileSize = this.files[0].size;
            var maxSize = 25000;//25kb; // alert(maxSize);
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
            var filename = $('input[type=file]').val().split('\\').pop();

            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Only  "+fileExtension.join(', ')+" formats are allowed");
                $(".user_signature").val('');
            }
            if (fileSize>maxSize){
                alert("File size exceeds maximum size");
                $(".user_signature").val('');
            }
        });
    </script>

</div>

@include('masterGlobal.chosenSelect')
{{--@include('masterGlobal.formValidation')--}}
@include('masterGlobal.getBankBranchesEvent')




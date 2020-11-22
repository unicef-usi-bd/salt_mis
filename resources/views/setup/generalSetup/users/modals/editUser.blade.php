<div class="col-md-12">
    <form id="myform" action="{{ url('/users/'.$editData->id) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="col-md-6">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.user_full_name') }}</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess" placeholder="{{ trans('user.example_full_nameen') }}" name="user_full_name" class="form-control col-sm-8" value="{{ $editData->user_full_name }}"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Designation</b></label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess" placeholder="Designation Here" name="designation" class="form-control col-sm-8" value="{{ $editData->designation }}"/>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.user_name') }}</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess username" placeholder="{{ trans('user.example_user_name') }}" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 " value="{{ $editData->username }}" />
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
                    <input autocomplete="off" type="text" id="inputSuccess email" placeholder="{{ trans('user.example_email') }}" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} col-xs-10 col-sm-5 email" value="{{ $editData->email }}"/>
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
                    <input autocomplete="off" type="password" id="inputSuccess password" placeholder="{{ trans('user.example_password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} col-xs-10 col-sm-5"/>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.re_password') }}</b> <span style="color: red;"> </span></label>
                <div class="col-sm-8">
                    <input autocomplete="off" id="password-confirm" type="password" class="form-control required" name="password_confirmation" placeholder="Confirm Password"/>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.contact_no') }}.</b></label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess contact_no" placeholder="{{ trans('user.example_contact_no') }}" name="contact_no" class="form-control col-xs-10 col-sm-5" value="{{ $editData->contact_no }}"/>
                </div>
            </div>



            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.active_status') }}</b></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select id="inputSuccess active_status" class="form-control" name="active_status">
                            <option value="">-Select-</option>
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
                    <input type="file" id="user_image" name="user_image" class="form-control col-xs-10 col-sm-5 user_image" value="" onchange="loadFile(event)"/>
                </div>
                <div style="margin-top: 40px; margin-left: 120px;">
                    <img id="output"  style="width: 50px;height: 50px; margin-left: 40px;" src="{{ asset('/'.$editData->user_image) }}" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.signature') }}</b></label>
                <div class="col-sm-8">
                    <input type="file" id="user_signature" name="user_signature" class="form-control col-xs-10 col-sm-5 user_signature" value="" onchange="loadFile1(event)"/>
                </div>
                <div style="margin-top: 40px; margin-left: 120px;">
                    <img id="output1"  style="width: 50px;height: 50px; margin-left: 40px;" src="{{ asset('/'.$editData->user_signature) }}" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.user_group') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="privileges" onclick="craateUserJsObject.ShowPrivileges();" class="form-control user_group" name="user_group_id" data-placeholder="Select User Group">
                                <option value="">-Select-</option>
                                @foreach($userGroups as $userGroup)
                                    <option value="{{$userGroup->USERGRP_ID}}" @if($userGroup->USERGRP_ID==$editData->user_group_id) selected @endif> {{$userGroup->USERGRP_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                </div>
            </div>

            <div class="form-group" >
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('user.group_level') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess user_group_level" class=" form-control user_group_level" name="user_group_level_id" data-placeholder="Select Group Level">
                                <option value="">-Select-</option>
                                @foreach($userGroupLevels as $userGroupLevel)
                                <option value="{{ $userGroupLevel->UG_LEVEL_ID }}" @if($editData->user_group_level_id==$userGroupLevel->UG_LEVEL_ID) selected @endif>{{ $userGroupLevel->UGLEVE_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                </div>
            </div>


            <div class="form-group resources" style="display: @if($editData->user_group_id==22) block @else none @endif">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Mill Name</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select id="form-field-select-3 inputSuccess center_id" class=" form-control millName" name="center_id" data-placeholder="Select Center">
                            <option value="">-Select-</option>
                            @foreach($associationCenter as $center)
                                <option value="<?php echo $center->ASSOCIATION_ID ?>" disabled @if($center->ASSOCIATION_ID==$editData->center_id)  @endif><?php echo $center->ASSOCIATION_NAME ?></option>
                                <?php $miller = DB::select(DB::raw("SELECT a.ASSOCIATION_ID,a.ASSOCIATION_NAME from ssm_associationsetup a where a.PARENT_ID = $center->ASSOCIATION_ID "));?>
                                @foreach($miller as $row)
                                    <option value="{{$row->ASSOCIATION_ID}}" @if($row->ASSOCIATION_ID==$editData->center_id) selected @endif> {{$row->ASSOCIATION_NAME}}</option>
                                @endforeach

                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
            <div class="center_ID">
                <input type="hidden" name="center_id" value="61">
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.address') }}</b></label>
                <div class="col-sm-8">
                    <input autocomplete="off" type="text" id="inputSuccess address" placeholder="{{ trans('user.example_address') }}" name="address" class="form-control col-xs-10 col-sm-5" value="{{ $editData->address }}"/>
                </div>
            </div>

             <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('user.remark') }}</b></label>
                <div class="col-sm-8">
                    {{--<input autocomplete="off" type="text" id="inputSuccess remarks" name="remarks" placeholder="{{ trans('user.example_remarks_here') }}" class="form-control col-xs-10 col-sm-5" value="{{ $editData->remarks }}"/>--}}
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
                <button type="button" class="btn btn-info" onclick="formSubmit(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.update') }}
                </button>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            $('.user_group').on('change',function(){
                let groupId = $(this).val();
                let option = '<option>-Select-</option>';
                let childScope = $('.user_group_level');
                $.ajax({
                    type : "get",
                    url  : "get-user-group-levels",
                    data : {'group_id': groupId},
                    success:function (data) {
//                        console.log(data);exit();
                        for (let i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].UG_LEVEL_ID +'">'+ data[i].UGLEVE_NAME+'</option>';
                        }
                        childScope.html(option);
                        childScope.trigger("chosen:updated");
                        $('#center_id').val('').trigger("chosen:updated");
//                        alert(data);
                    }
                });
            });
        });
        let Privileges = jQuery('#privileges');
        let select = this.value;
        Privileges.change(function () {
            let userGroupId = parseInt($(this).val());
            if (userGroupId == 22) {
                $('.resources').show();
                $('.center_ID').find('*').prop('disabled', true);
            }else{
                if ($(this).val() == 21) {
                    $('.center_ID').find('*').prop('disabled', false);
                    $('.resources').hide();
                }
            }
        });
        let millName = $('.millName').val();
        $(document).on('change','.millName',function () {
            $('.center_ID').find('*').prop('disabled', true);
        });

        $(document).on('focusout','.email',function () {
            //alert('hi');
            let email = $('.email').val();
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

        let loadFile = function(event) {
            let output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };

        let loadFile1 = function(event) {
            let output = document.getElementById('output1');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>


</div>

@include('masterGlobal.chosenSelect')
@include('masterGlobal.getBankBranchesEvent')
@include('masterGlobal.ajaxFormSubmit')




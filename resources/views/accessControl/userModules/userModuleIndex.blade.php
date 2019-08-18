@extends('master')

@section('mainContent')
    <style>
        .assignMbox{
            margin-top: 15px;
            font-size: 15px;
            border: 1px solid lightgrey;
            padding: 10px 0px 30px 20px;
            border-radius: 5px;
        }
        .module_link{
            list-style-type: none !important;
            margin-top: 6px;
        }
        .ActionHeader span{
            margin-left: 20px;
            font-size: 14px;
        }
        .module_link ul li{
            list-style-type: none !important;
        }
        .moduleTop{
            margin-top: 20px;
        }
        .checkbox_style label input{
            height: 17px;
            width: 17px;
        }
        .checkbox_style label{
            margin-right: 45px;
        }
    </style>
    <div class="page-header">
        <h1>
            {{ trans('module.access_control') }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{ trans('organizationModule.assign_modules') }}
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <div class="col-sm-4">
                <label for="inputSuccess" class="row control-label no-padding-right" for="form-field-1-1" style="padding: 0px 15px 0px 11px;"><b> {{ trans('module.user_group') }}</b><span style="color: red;"> *</span></label>
                <span class="row block input-icon input-icon-right" style="padding:0px 15px 0px 11px;">
                    <select id="form-field-select-3 inputSuccess USERGRP_ID" class="form-control userGroup chosen-select" name="USERGRP_ID" data-placeholder="Select or search data">
                        <option value="">Select One</option>
                        @foreach($userGroups as $userGroup)
                            <option value="{{$userGroup->USERGRP_ID}}"> {{$userGroup->USERGRP_NAME}}</option>
                        @endforeach
                    </select>
                </span>
            </div>

            <div class="col-sm-4">
                <label for="inputSuccess" class="row control-label no-padding-right" for="form-field-1-1" style="padding: 0px 15px 0px 11px;"><b>{{ trans('module.user_group_level') }}</b><span style="color: red;"> *</span></label>
                <span class="row block input-icon input-icon-right"  style="padding: 0px 5px 0px 11px;">
                    <select id="form-field-select-3 inputSuccess UG_LEVEL_ID" class="form-control userGroupLevel chosen-select" name="UG_LEVEL_ID" data-placeholder="Select or search data">
                        <option value="">Select One</option>
                    </select>
                </span>
            </div>

        </div><!-- /.col -->
    </div><!-- /.row -->
    <br>
    <div class="col-md-12 ajaxResult">
    </div>

    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    <!-- Add New Group Modal End -->


    <script>
        $(document).ready(function () {
//            Get User Group level by User Group
            $(document).on("click", ".userGroup", function () {
                var userGroupId = $(this).val();
                var option = '<option value="">Select One</option>';

                $.ajax({
                    type : "get",
                    url  : "user-group-level",
                    data : {'userGroupId': userGroupId},
                    success:function (data) {
                        console.log(data);
                        for (var i = 0; i < data.length; i++){
                            option = option + '<option value="'+ data[i].UG_LEVEL_ID +'">'+ data[i].UGLEVE_NAME+'</option>';
                        }
                        $('.userGroupLevel').html(option);
                    }
                });
            });
//            Get User Group level Permission by User Group Level
            $(document).on("change", ".userGroupLevel", function () {
                var userGroupLevelId = $(this).val();
                var userGroupId = $('.userGroup').val();
                $.ajax({
                    type : "get",
                    url  : "user-group-level-permission",
                    data : {'userGroupLevelId': userGroupLevelId, 'userGroupId': userGroupId},
                    success:function (data) {
                        console.log(data);
                        $('div.ajaxResult').html(data);
                    }

                });
            });

        });

//        Script For User Permission (levelPermission)
        $(document).on("click", ".chkUserPermission", function () {
            var value = $(this).val();
            var checked = ($($(this)).is(':checked')) ? 1 : 0;
            $.ajax({
                type : "get",
                url  : "action-user-permission",
                data: {values: value, is_checked: checked},
                success:function (data) {
                    //console.log(JSON.parse(data));
                console.log(data);
                }
            });
        });

    </script>


@endsection

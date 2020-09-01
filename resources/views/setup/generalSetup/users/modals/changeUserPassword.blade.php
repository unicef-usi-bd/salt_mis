<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>

    <form class="form-horizontal frmContent" name="formData" method="POST">
    {{--<form action="{{ url('/users-change-password/'.$editData->id) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">--}}
        @csrf
        {{--@method('PUT')--}}
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Old Password</b> <span style="color: red;"> *</span></label>
            <div class="col-sm-8">
                <input autocomplete="off" type="password" id="inputSuccess old_password" placeholder="Example:- Old password here" name="old_password" class="form-control col-xs-10 col-sm-5" value=""/>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>New Password</b> <span style="color: red;"> *</span></label>
            <div class="col-sm-8">
                <input autocomplete="off" type="password" id="inputSuccess password" placeholder="Example:- New password here" name="password" class="form-control col-xs-10 col-sm-5" value=""/>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Confirm Password</b> <span style="color: red;"> *</span></label>
            <div class="col-sm-8">
                <input autocomplete="off" type="password" id="inputSuccess password_confirmation" placeholder="Example:- Confirm password here" name="password_confirmation" class="form-control col-xs-10 col-sm-5" value=""/>

            </div>
        </div>

        <hr>
        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'users-change-password-create' }}">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>

</div>

@include('masterGlobal.ajaxFormSubmit')




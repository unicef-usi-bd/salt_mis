<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>

    <form class="form-horizontal frmContent" name="formData" method="POST">
        @csrf
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('emailTemplete.email_type_name') }}</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess email_type_id" class="form-control" name="email_type_id" data-placeholder="Select or search data">
                    <option value="">-Select One-</option>
                    @foreach($emailTypes as $emailType)
                        <option value="{{$emailType->lookup_group_data_id}}"> {{$emailType->group_data_name}}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('emailTemplete.subject') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input type="text" id="inputSuccess email_subject" placeholder="{{ trans('emailTemplete.ex_email_subject') }}" name="email_subject" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.description') }}</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
               <textarea class="form-control" name="email_body" id="editor1" rows="10" cols="80"></textarea>
            </div>
        </div>


       <!--  <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('cigGroup.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="active_status">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
            </div>
        </div>
 -->

        <hr>

        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'email-templates' }}">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>

</div>

@include('masterGlobal.chosenSelect')
@include('masterGlobal.formValidation')

<script src="{{asset('assets/ckEditor/ckeditor.js')}}"></script>


<script>
    $(document).ready(function () {
        CKEDITOR.replace( 'editor1' );
    });

</script>
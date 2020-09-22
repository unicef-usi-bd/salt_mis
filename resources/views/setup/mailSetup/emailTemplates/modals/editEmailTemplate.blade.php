<div class="col-md-12">

    <form action="{{ url('/email-templates/'.$editEmailTemplate->email_template_id) }}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('emailTemplete.email_type_name') }}</b><span style="color: red;"> *</span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess email_type_id" class="form-control" name="email_type_id" data-placeholder="Select or search data">
                    <option value="">-Select-</option>
                    @foreach($emailTypes as $emailType)
                        <option value="{{$emailType->lookup_group_data_id}}" @if($emailType->lookup_group_data_id==$editEmailTemplate->email_type_id) selected @endif> {{$emailType->group_data_name}}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('emailTemplete.subject') }}</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess email_subject" placeholder="{{ trans('emailTemplete.ex_email_subject') }}" name="email_subject" class="form-control col-xs-10 col-sm-5" value="{{$editEmailTemplate->email_subject}}"/>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.description') }}</b></label>
            <div class="col-sm-8">
                <textarea class="form-control" name="email_body" id="editor1" rows="10" cols="80">{{$editEmailTemplate->email_body}}</textarea>
            </div>
        </div>


        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('cigGroup.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="active_status">
                    <option value="">-Select-</option>
                    <option value="1" @if($editEmailTemplate->active_status==1) selected @endif>Active</option>
                    <option value="0" @if($editEmailTemplate->active_status==0) selected @endif>Inactive</option>
                </select>
            </span>
            </div>
        </div>


        <hr>

        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
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

</div>

@include('masterGlobal.chosenSelect')
@include('masterGlobal.formValidationEdit')

<script src="{{asset('assets/ckEditor/ckeditor.js')}}"></script>


<script>
    $(document).ready(function () {
        CKEDITOR.replace( 'editor1' );
    });

</script>

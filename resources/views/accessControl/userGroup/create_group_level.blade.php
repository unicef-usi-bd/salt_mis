{!! Form::model($id, array('url' => '#', 'id'=>'land_category_form', 'class'=>'form-horizontal', 'method' => 'post')) !!}
<!--=============Title for modal===============-->
<div class="modal_top_title">ইউজার গ্রুপ লেবেলের তথ্য যোগ করুন</div>
<!--===========End title for modal=============-->

<!--========Show form post message=============-->
<div class="form-group">
    <div class="col-sm-5 col-sm-offset-3 form_messsage">

    </div>
</div>
<!--========End form post message=============-->

<div class="form-group">
    <label for="UGLEVE_NAME" class="col-sm-3 control-label">ইউজার গ্রুপ লেবেলের নাম<span style="color: red">*</span></label>
    <div class="col-sm-5">
        {!! Form::text('UGLEVE_NAME', Input::old('UGLEVE_NAME'), array('class'=>'form-control form-required')) !!}
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-10">
        <span class="modal_msg pull-left"></span>
        <button type="button" class="btn btn-default btn-sm reset_form">{{ trans('common.form_reset') }}</button>
        <button type="submit" data-action="{{ route('group_level_save', $id) }}" class="btn btn-success btn-sm form_submit">{{ trans('common.form_submit') }}</button>
        <span class="loadingImg"></span>
    </div>
</div>
{!! Form::close() !!}
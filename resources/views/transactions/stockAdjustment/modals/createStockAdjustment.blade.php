<div class="col-md-12">
    <form id="myform" action="{{ url('/stock-adjustment') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        {{--<div class="col-md-12">--}}
        @csrf
        <div class="row">
            <div class="col-md-12" style="margin-top: 15px; margin-left: 50px;">
                {{--<h4  style="color: #1B6AAA; margin-left: 350px;">Test Result</h4>--}}
                <div class="col-md-6">
                    <h4 style="margin-left: 150px;">System Stock</h4>
                </div>
                <div class="col-md-6">
                    <h4>Stock</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>W & C Salt</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-6">
                            <input type="text" name="" id="" placeholder=""  value="{{ $washingStock }}" class="form-control col-xs-5 col-sm-5" readonly />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Iodize Salt</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-6">
                            <input type="text" name="" id="" placeholder=""  value="{{ $iodizeStock }}" class="form-control col-xs-5 col-sm-5" readonly />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="text" name="wc_stock" id="wc_stock" placeholder="" onkeypress="return numbersOnly(this, event)" value="" class="form-control col-xs-5 col-sm-5"  />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="text" name="iodize_stock" id="iodize_stock" placeholder="" onkeypress="return numbersOnly(this, event)" value="" class="form-control col-xs-5 col-sm-5" />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                </div>


            </div>
        </div>

        <div class="clearfix" style="margin-left: -185px;">
            <div class="col-md-offset-3 col-md-9" style="margin-left: 510px;">
                <button type="reset" class="btn test">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'unions' }}">--}}
                <button type="submit" class="btn btn-primary">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>

@include('masterGlobal.chosenSelect')
@include('masterGlobal.datePicker')
@include('masterGlobal.formValidation')

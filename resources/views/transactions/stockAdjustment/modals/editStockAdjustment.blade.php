<div class="col-md-12">
    <form action="{{ url('/stock-adjustment/'.$editStockAdjust->stock_id) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12" style="margin-top: 15px; margin-left: 50px;">
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
                            <input autocomplete="off" type="text" name="system_wc_stock" id="" placeholder=""  value="{{ $editStockAdjust->system_wc_stock }}" class="form-control col-xs-5 col-sm-5" readonly />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Iodize Salt</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-6">
                            <input autocomplete="off" type="text" name="system_iodize_stock" id="" placeholder=""  value="{{ $editStockAdjust->system_iodize_stock }}" class="form-control col-xs-5 col-sm-5" readonly />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input autocomplete="off" type="text" name="wc_stock" id="wc_stock" placeholder=""  value="{{ $editStockAdjust->wc_stock }}" class="form-control col-xs-5 col-sm-5"  />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input autocomplete="off" type="text" name="iodize_stock" id="iodize_stock" placeholder=""  value="{{ $editStockAdjust->iodize_stock }}" class="form-control col-xs-5 col-sm-5" />
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
                <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.update') }}
                </button>
            </div>
        </div>
    </form>
</div>

@include('masterGlobal.chosenSelect')
@include('masterGlobal.datePicker')
@include('masterGlobal.ajaxFormSubmit')



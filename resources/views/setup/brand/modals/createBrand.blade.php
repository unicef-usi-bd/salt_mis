<div class="col-md-12">
    <form action="{{ url('/brand') }}" method="post" class="form-horizontal" id="brandModal" aria-hidden="true" role="dialog">
        @csrf
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>Name</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="brand_name"  class="form-control" value=""/>
                    </span>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-12 center">
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
</div>


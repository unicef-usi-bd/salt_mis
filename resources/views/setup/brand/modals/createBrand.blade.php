<style>
    .my-error-class {
        color:red;
    }
    .my-valid-class {
        color:green;
    }
</style>
<div class="col-md-12">
    <form id="myform" action="{{ url('/brand') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>Brand Name</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="brand_name"  class="form-control" value=""/>
                    </span>
            </div>
        </div>

        <hr>
        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>


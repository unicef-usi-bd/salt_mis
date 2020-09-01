<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12" style="margin-top: 10px">
    <form action="{{ url('/brand/'.$editBrand->brand_id) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>Name</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="brand_name"  class="form-control" value="{{ $editBrand->brand_name }}"/>
                    </span>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-12 center">
                <button type="reset" class="btn" disabled>
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

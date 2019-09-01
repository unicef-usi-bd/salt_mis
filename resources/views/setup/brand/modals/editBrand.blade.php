<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12" style="margin-top: 10px">
    <form action="{{ url('/brand/'.$editBrand->brand_id) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>Name</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="brand_name"  class="form-control" value="{{ $editBrand->brand_name }}"/>
                    </span>
            </div>
        </div>

        <div style="text-align: center;" class="form-group">
            <button type="reset" class="btn" disabled>
                <i class="ace-icon fa fa-undo bigger-110"></i>
                {{ trans('dashboard.reset') }}
            </button>
            <button type="submit" class="btn btn-info">
                <i class="ace-icon fa fa-check bigger-110"></i>
                {{ trans('dashboard.update') }}
            </button>
        </div>
    </form>
</div>

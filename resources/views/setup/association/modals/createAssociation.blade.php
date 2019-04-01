<div class="col-md-12">
    <!-- PAGE CONTENT BEGINS -->
    <form action="{{ url('/association-setup') }}" method="post" class="form-horizontal checkValidation" role="form" enctype="multipart/form-data">
        @csrf

        <script>
            $( ".addInputField" ).change(function() {
                var getValue = $(this).val();
                if(getValue==4){
                    $('.showSelector').removeClass( "hidden" );
                } else {
                    $('.showSelector').addClass( "hidden" );
                    $('.cost_center_status_type').val(0);
                }
            });
        </script>


        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> {{ trans('lookupGroupIndex.name') }}</b> <span style="color: red;"> *</span></label>
            <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" id="inputSuccess cost_center_name" name="cost_center_name" value="{{ old('cost_center_name') }}" placeholder="Enter Lavel Name" class="width-100" />
                <input type="hidden" id="inputSuccess" name="pr_cost_center_id" value="{{ $pr_id }}" class="width-100" />
            </span>
            </div>
        </div>








        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> {{ trans('cigGroup.active_status') }}</b></label>
            <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <select class="form-control" name="active_status">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-info" id="formSubmit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
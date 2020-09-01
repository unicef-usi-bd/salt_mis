<style>
    .my-error-class {
        color:red;
    }
    .my-valid-class {
        color:green;
    }
</style>
<div class="col-md-12">
    <form id="myform" action="{{ url('/item') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Item Type</b><span style="color: red;">* </span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 ITEM_TYPE inputSuccess" class="form-control ITEM_TYPE" name="ITEM_TYPE" >
                    <option>-Select-</option>
                    @foreach($itemTypes as $itemType)
                        <option value="{{ $itemType->LOOKUPCHD_ID }}">{{ $itemType->LOOKUPCHD_NAME }}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>Name</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" id="ITEM_NAME" name="ITEM_NAME"  class="form-control ITEM_NAME" value=""/>
                    </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
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

<script>
    $('#myform').validate({ // initialize the plugin
        errorClass: "my-error-class",
        //validClass: "my-valid-class",
        rules: {
            ITEM_TYPE:{
                required:true,
            },
            ITEM_NAME:{
                required:true,
            }

        }
    });
</script>

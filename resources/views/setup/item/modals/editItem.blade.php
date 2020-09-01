<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12" style="margin-top: 10px">
    <form action="{{ url('/item/'.$editItem->ITEM_NO) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Item Type</b><span style="color: red;">* </span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess" class="form-control" name="ITEM_TYPE">
                    <option>-Select-</option>
                    @foreach($itemTypes as $itemType)
                        <option value="{{ $itemType->LOOKUPCHD_ID }}" @if($editItem->ITEM_TYPE == $itemType->LOOKUPCHD_ID) selected @endif>{{ $itemType->LOOKUPCHD_NAME }}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>Name</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <input autocomplete="off" type="text" name="ITEM_NAME"  class="form-control" value="{{ $editItem->ITEM_NAME }}"/>
                    </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG">
                    <option value="">Select One</option>
                    <option value="1" @if($editItem->ACTIVE_FLG == 1) selected @endif>Active</option>
                    <option value="0" @if($editItem->ACTIVE_FLG == 0) selected @endif>Inactive</option>
                </select>
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

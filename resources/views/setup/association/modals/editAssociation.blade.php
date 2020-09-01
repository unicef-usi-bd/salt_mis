<div class="col-md-12">
<!-- PAGE CONTENT BEGINS -->
    <form action="{{ url('/association-setup/'.$editData->ASSOCIATION_ID) }}" method="post" class="form-horizontal checkValidation" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="inputSuccess" name="PARENT_ID" value="{{ $editData->PARENT_ID }}" />
        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"> <b>Name </b><span style="color: red;"> *</span></label>
            <div class="col-xs-12 col-sm-7">
                <span class="block input-icon input-icon-right">
                    <input autocomplete="off" type="text" id="inputSuccess" name="ASSOCIATION_NAME" value="{{ $editData->ASSOCIATION_NAME }}" class="width-100" />
                </span>

            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b> Zone Name</b> <span style="color: red;"> *</span></label>
            <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess ZONE_ID" class="form-control" name="ZONE_ID" data-placeholder="Select or search data">
                    <option value="">Select Zone Name</option>
                    @foreach($associationList as $association)
                        <option value="{{ $association->ZONE_ID }}" @if($association->ZONE_ID==$editData->ZONE_ID) selected @endif>{{ $association->ZONE_NAME }}</option>
                    @endforeach
                </select>
             </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>{{ trans('cigGroup.active_status') }}</b></label>
            <div class="col-xs-12 col-sm-7">
                <span class="block input-icon input-icon-right">
                    <select class="form-control" name="ACTIVE_FLG">
                        <option value="">Select One</option>
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </span>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn" disabled>
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-info">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Update
                </button>
            </div>
        </div>

    </form>
    {{--@include('masterGlobal.formValidation')--}}
    {{--@include('masterGlobal.getBankBranchesEvent')--}}
</div>

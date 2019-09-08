<div class="col-md-12">
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>
    <form id="myform" action="{{ url('/certificate-map') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Certificate Type List</b></label>
                <div class="col-xs-8">
                    <span class="block input-icon input-icon-right" style="width: 365px; margin-left: 5px;">
                        <select class="form-control chosen-select " name="CERTIFICATE_TYPE_ID" data-placeholder="Select or search data">
                            <option value=""></option>
                            @foreach($certificate as $row)
                                <option value="{{$row->LOOKUPCHD_ID}}"> {{$row->LOOKUPCHD_NAME}}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Issuer List</b></label>
                <div class="col-xs-8">
                    <span class="block input-icon input-icon-right" style="width: 365px; margin-left: 5px;">
                        <select class="form-control chosen-select " name="ISSURE_ID" data-placeholder="Select or search data">
                            <option value=""></option>
                            @foreach($issueBy as $row)
                            <option value="{{$row->LOOKUPCHD_ID}}"> {{$row->LOOKUPCHD_NAME}}</option>
                            @endforeach
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
        </div>


    </form>
</div>
@include('masterGlobal.chosenSelect')
@include('masterGlobal.getDistrict')
@include('masterGlobal.getUpazila')
@include('masterGlobal.getUnion')

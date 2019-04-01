<!-- PAGE CONTENT BEGINS -->
<div class="col-md-12">
    <form action="{{ url('/supplier-profile/'.$editData->SUPP_ID_AUTO) }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
        @csrf
        @method('PUT')

        <div class="col-md-6" style="padding: 0px;">
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Trading Name</b><span style="color: red;"> *</span> </label>
                <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" id="inputSuccess org_name" name="TRADING_NAME" value="{{ $editData->TRADING_NAME }}" class="width-100" />
            </span>

                </div>
            </div>



            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Trade licence No</b><span style="color: red;">* </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="LICENCE_NO" id="inputSuccess org_slogan" value="{{ $editData->LICENCE_NO }}" class="width-100"  />
                    </span>
                </div>
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Division Name</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control  chosen-select" id="DIVISION_ID" name="DIVISION_ID">
                            <option value="">{{ trans('organization.select_one') }}</option>
                            @foreach($getDivision as $row)
                                <option value="{{ $row->DIVISION_ID }}" @if($editData->DIVISION_ID==$row->DIVISION_ID) selected @endif>{{ $row->DIVISION_NAME }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>District Name</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control district chosen-select" id="DISTRICT_ID" name="DISTRICT_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editData->DISTRICT_ID }}">{{ $editData->DISTRICT_NAME }}</option>
                        </select>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Upazila Name</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control upazila chosen-select" id="UPAZILA_ID" name="UPAZILA_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editData->UPAZILA_ID }}">{{ $editData->UPAZILA_NAME }}</option>
                        </select>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Union Name</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control union chosen-select" id="UNION_ID" name="UNION_ID" data-placeholder="{{ trans('organization.select_one') }}">
                            <option value="{{ $editData->UNION_ID }}">{{ $editData->UNION_NAME }}</option>
                        </select>
                    </span>
                </div>
            </div>


        </div>
        <div class="col-md-6" style="padding: 0px;">
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Trader Name</b><span style="color: red;">* </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="TRADER_NAME" value="{{ $editData->TRADER_NAME }}" id="inputSuccess ogr_address" class="width-100"  />
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Phone </b><span style="color: red;"> </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="PHONE" id="inputSuccess website" value="{{ $editData->PHONE }}" class="width-100"  />
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>EMAIL</b><span style="color: red;"> </span> </label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" name="EMAIL" id="inputSuccess fax" value="{{ $editData->EMAIL }}" class="width-100" />
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>Bazar Name</b></label>
                <div class="col-xs-12 col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text"  name="BAZAR_NAME" id="inputSuccess email_address" value="{{ $editData->BAZAR_NAME }}" class="width-100"  />
             </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right"><b>REMARKS</b></label>
                <div class="col-xs-12 col-sm-7">
                    <span class="block input-icon input-icon-right">
                        {{--<input type="text" name="REMARKS" id="inputSuccess phone" value="{{ $editData->REMARKS }}" class="width-100"  />--}}
                        <textarea class="form-control" rows="6" name="REMARKS" placeholder="Remarks here">{{ $editData->REMARKS }}</textarea>
                    </span>
                </div>
            </div>


        </div>

        <div class="clearfix">
            <div class="col-md-offset-5 col-md-7" style="margin-top: 20px;">
                <button type="reset" class="btn" disabled>
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-info" id="formSubmit">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.update') }}
                </button>
            </div>
        </div>

    </form>
</div>
{{--@include('masterGlobal.formValidation')--}}
@include('masterGlobal.formValidationEdit')
@include('masterGlobal.chosenSelect')
@include('masterGlobal.getDistrict')
@include('masterGlobal.getUpazila')
@include('masterGlobal.getUnion')
<div class="col-md-12">
    <form action="{{ url('/bsti-test-standard/'.$editBstiTestStandard->BSTITEST_ID) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Sodium Chloride</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess " placeholder="Example:- Sodium Chloride Percentage here" name="SODIUM_CHLORIDE" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->SODIUM_CHLORIDE }}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Moisturizer</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess" placeholder="Example:- Moisturizer Percentage here" name="MOISTURIZER" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->MOISTURIZER }}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Iodine Content(PPM)</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess" placeholder="Example:- Iodine Content(PPM) here" name="PPM" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->PPM }}"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>PH</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess" placeholder="Example:- PH here" name="PH" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->PH }}"/>
                </div>
            </div>
        <div class="clearfix" style="margin-left: 120px;">
            <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn btn-primary submitBtn">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Update
                </button>

            </div>
        </div>
    </form>
</div>

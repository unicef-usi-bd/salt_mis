<div class="col-md-12">
    <form action="{{ url('/bsti-test-standard/'.$editBstiTestStandard->BSTITEST_ID) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Sodium Chloride</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-6">
                <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- Sodium Chloride Percentage here" name="SODIUM_CHLORIDE" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->SODIUM_CHLORIDE }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Moisturizer</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-6">
                <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- Moisturizer Percentage here" name="MOISTURIZER" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->MOISTURIZER }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Iodine Content(PPM)</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-6">
                <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- Iodine Content(PPM) here" name="PPM" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->PPM }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>PH</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-6">
                <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- PH here" name="PH" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->PH }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Water insoluble matter</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-6">
                <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- PH here" name="water_insoluble_matter" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->water_insoluble_matter }}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Matter soluble in water other than sodium chloride</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-6">
                <input type="text" id="inputSuccess" onkeypress="return numbersOnly(this, event)" placeholder="Example:- PH here" name="matter_soluble_sc" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestStandard->matter_soluble_sc }}"/>
            </div>
        </div>
        <div class="clearfix" style="margin-left: 120px;">
            <div class="col-md-offset-3 col-md-9">
                <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Update
                </button>

            </div>
        </div>
    </form>
</div>

<div class="col-md-12" style="margin-top: 20px;">

    <form action="{{ url('/bsti-test-result-range/'.$editBstiTestResutlRange->BSTITEST_RESULT_ID) }}" method="post" class="form-horizontal" role="form">
        @csrf
        @method('PUT')
        <h4><u>Sodium Chloride</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess SODIUM_CHLORIDE_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="SODIUM_CHLORIDE_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->SODIUM_CHLORIDE_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess SODIUM_CHLORIDE_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="SODIUM_CHLORIDE_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->SODIUM_CHLORIDE_MAX }}"/>
                </div>
            </div>
        </div>
        <h4><u>Moisturizer</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess MOISTURIZER_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="MOISTURIZER_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->MOISTURIZER_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess MOISTURIZER_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="MOISTURIZER_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->MOISTURIZER_MAX }}"/>
                </div>
            </div>
        </div>
        <h4><u>Iodize Content(PPM)</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess PPM_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="PPM_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->PPM_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess PPM_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="PPM_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->PPM_MAX }}"/>
                </div>
            </div>
        </div>
        <h4><u>PH</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess PH_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="PH_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->PH_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess PH_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="PH_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->PH_MAX }}"/>
                </div>
            </div>
        </div>
        <h4><u>Water insoluble matter</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess WIM_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="WIM_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->WIM_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess WIM_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="WIM_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->WIM_MAX }}"/>
                </div>
            </div>
        </div>
        <h4><u>Matter soluble in water other than sodium chloride</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess MSWSC_MIN" onkeypress="return numbersOnly(this, event)" placeholder="" name="MSWSC_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->MSWSC_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" id="inputSuccess MSWSC_MAX" onkeypress="return numbersOnly(this, event)" placeholder="" name="MSWSC_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->MSWSC_MAX }}"/>
                </div>
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

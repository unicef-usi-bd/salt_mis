<div class="col-md-12" style="margin-top: 20px;">
    {{--<hr>--}}
    {{--<h4  style="color: #1B6AAA; text-align: center; margin-left: -200px;">Bsti Test Standard Result Range</h4>--}}
    {{--<hr>--}}
    <form action="{{ url('/bsti-test-result-range/'.$editBstiTestResutlRange->BSTITEST_RESULT_ID) }}" method="post" class="form-horizontal" role="form" id="myform">
        @csrf
        @method('PUT')
        <h4><u>Sodium Chloride</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess SODIUM_CHLORIDE_MIN" placeholder="" name="SODIUM_CHLORIDE_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->SODIUM_CHLORIDE_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess SODIUM_CHLORIDE_MAX" placeholder="" name="SODIUM_CHLORIDE_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->SODIUM_CHLORIDE_MAX }}"/>
                </div>
            </div>
        </div>
        <h4><u>Moisturizer</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess MOISTURIZER_MIN" placeholder="" name="MOISTURIZER_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->MOISTURIZER_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess MOISTURIZER_MAX" placeholder="" name="MOISTURIZER_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->MOISTURIZER_MAX }}"/>
                </div>
            </div>
        </div>
        <h4><u>Iodize Content(PPM)</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess PPM_MIN" placeholder="" name="PPM_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->PPM_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess PPM_MAX" placeholder="" name="PPM_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->PPM_MAX }}"/>
                </div>
            </div>
        </div>
        <h4><u>PH</u></h4>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Minimum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess PH_MIN" placeholder="" name="PH_MIN" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->PH_MIN }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Maximum Length</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess PH_MAX" placeholder="" name="PH_MAX" class="form-control col-xs-10 col-sm-5" value="{{ $editBstiTestResutlRange->PH_MAX }}"/>
                </div>
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
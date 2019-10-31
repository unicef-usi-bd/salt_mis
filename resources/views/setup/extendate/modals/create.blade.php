<div class="col-md-12">
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>

    <form id="myform" action="{{ url('/extended-date') }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf
            {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Miller Name</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess millerName" class="chosen-select form-control" name="MILL_NAME" data-placeholder="Select Mill Name">
                               <option value=""></option>
                                @foreach($millerId as $row)
                                    <option value="{{$row->MILL_ID}}">{{ $row->MILL_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount</b><span style="color: red;"> * </span> </label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<input type="text" id="inputSuccess RCV_QTY" placeholder="Example: Amount here in KG" name="RCV_QTY" class="form-control col-xs-10 col-sm-5" value=""/>--}}
                    {{--</div>--}}
                    {{--<i style="margin-top: 10px; font-weight:bolder;font-size: larger;" >ltr</i>--}}
                </div>
                <div class="form-group">
                    {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<textarea rows="3" placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5"></textarea>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Expired Date</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" name="RECEIVE_DATE" id="RECEIVE_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 date-picker" />
                    </div>
                </div>
            </div>
        </div>





    <!-- <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('union.active_status') }}</b></label>
                <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="active_status">
                    <option value="">Select One</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </span>
                </div>
            </div> -->
        <div class="row" style="margin-top: 20px; width: 92.9%">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <div class="tabbable resultTab">
                        <div class="tab-content">
                            <span id="printButton"></span>
                            <div class="row tblReport" style="padding-left: 10px;padding-right: 10px;">

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="clearfix" style="margin-left: 150px;">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn test">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'unions' }}">--}}
                <button type="submit" class="btn btn-primary">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>


@include('masterGlobal.chosenSelect')
@include('masterGlobal.datePicker')

{{--@include('masterGlobal.formValidation')--}}
<script>
    var Privileges = jQuery('#privileges');
    var select = this.value;
    Privileges.change(function () {
        if ($(this).val() == 1001) {
            $('.resources').show();
        }
        else $('.resources').hide();
    });

    $(document).ready(function () {
        $.validator.addMethod(
            "regex",
            function(value, element, regexp)
            {
                if (regexp.constructor != RegExp)
                    regexp = new RegExp(regexp);
                else if (regexp.global)
                    regexp.lastIndex = 0;
                return this.optional(element) || regexp.test(value);
            },
            "Please check your input."
        );

        $('#myform').validate({ // initialize the plugin
            errorClass: "my-error-class",
            //validClass: "my-valid-class",
            rules: {

                PHONE:{
                    required: true,
                    maxlength:11,
                    minlength:11,
                    regex:/^(?:\+?88)?01[15-9]\d{8}$/,
                },
                RCV_QTY:{
                    required: true,
                }
            }
        });

    });

</script>



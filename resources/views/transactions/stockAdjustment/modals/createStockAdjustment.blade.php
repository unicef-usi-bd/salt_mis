<div class="col-md-12">
    <style>
        .my-error-class {
            color:red;
        }
        .my-valid-class {
            color:green;
        }
    </style>
    {{--<div id="success" class="alert alert-block alert-success" style="display: none;">--}}
    {{--<span id="successMessage"></span>--}}
    {{--<button type="button" class="close" data-dismiss="alert">--}}
    {{--<i class="ace-icon fa fa-times"></i>--}}
    {{--</button>--}}
    {{--</div>--}}

    {{--<div id="error" class="alert alert-block alert-danger" style="display: none;">--}}
    {{--<span id="errorMessage"></span>--}}
    {{--</div>--}}

    {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
    <form id="myform" action="{{ url('/stock-adjustment') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        {{--<div class="col-md-12">--}}
        @csrf
        <div class="row">
            <div class="col-md-12" style="margin-top: 15px; margin-left: 50px;">
                {{--<h4  style="color: #1B6AAA; margin-left: 350px;">Test Result</h4>--}}
                <div class="col-md-6">
                    <h4 style="margin-left: 150px;">System Stock</h4>
                </div>
                <div class="col-md-6">
                    <h4>Stock</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>W & C Salt</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-6">
                            <input type="text" name="" id="" placeholder=""  value="{{ $washingStock }}" class="form-control col-xs-5 col-sm-5" readonly />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Iodize Salt</b><span style="color: red;"> </span> </label>
                        <div class="col-sm-6">
                            <input type="text" name="" id="" placeholder=""  value="{{ $iodizeStock }}" class="form-control col-xs-5 col-sm-5" readonly />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="text" name="wc_stock" id="wc_stock" placeholder=""  value="" class="form-control col-xs-5 col-sm-5"  />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="text" name="iodize_stock" id="iodize_stock" placeholder=""  value="" class="form-control col-xs-5 col-sm-5" />
                        </div>
                        <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" class="">KG</i>
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

        <div class="clearfix" style="margin-left: -185px;">
            <div class="col-md-offset-3 col-md-9" style="margin-left: 510px;">
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

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
<script>
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
                SODIUM_CHLORIDE:{
                    required: true,
                },
                MOISTURIZER:{
                    required: true,
                },
                IODINE_CONTENT:{
                    required: true,
                },
                PH:{
                    required: true,
                },
                QUALITY_CONTROL_IMAGE:{
                    required: true,
                    extension: "xlsx|csv"
                }
            },
            messages: {
                QUALITY_CONTROL_IMAGE: {
                    //required: "Please upload file.",
                    extension: "Please upload file in these format only ( XLSX,CSV )."
                },
            }
        });

    });

</script>


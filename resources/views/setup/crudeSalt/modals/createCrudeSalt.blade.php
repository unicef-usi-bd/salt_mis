<style>
    .percentageSize {
        font-size: 22px;
    }
</style>
<div class="col-md-12">
    <form action="{{ url('/crude-salt-details') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>Crude Salt Type</b><span style="color: red;">* </span></label>
            <div class="col-sm-6">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess" class="form-control crudSaltType" name="CRUDSALT_TYPE_ID">
                    <option value="">-Select-</option>
                    @foreach($crudSaltTypes as $crudSaltType)
                        <option value="{{ $crudSaltType->ITEM_NO }}">{{ $crudSaltType->ITEM_NAME  }}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>Invoice No.</b><span style="color: red;">* </span></label>
            <div class="col-sm-6">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess" class="form-control invoice" name="RECEIVEMST_ID">

                </select>
            </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Chloride content (as NaCl), %m/m</b><span style="color: red;"> </span> </label>
            <span class="col-sm-6">
                <input autocomplete="off" type="text" id="inputSuccess user_define_sl" placeholder="Example:- Chloride content (as NaCl), %m/m Here" name="SODIUM_CHLORIDE" class="form-control col-xs-10 col-sm-5" value=""/>
            </span>
            <span class="col-sm-1">
                <span class="group-addon percentageSize">
                    <i class="ace-icon fa fa-percent"></i>
                </span>
            </span>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Moisture, %m/m</b><span style="color: red;"> </span> </label>
            <span class="col-sm-6">
                <input autocomplete="off" type="text" id="inputSuccess user_define_sl" placeholder="Example:- Moisture, %m/m Here" name="MOISTURIZER" class="form-control col-xs-10 col-sm-5" value=""/>
            </span>
            <span class="col-sm-1">
                <span class="group-addon percentageSize">
                    <i class="ace-icon fa fa-percent"></i>
                </span>
            </span>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Iodine content, mg/kg</b><span style="color: red;"> </span> </label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" id="inputSuccess user_define_sl" placeholder="Example:- Iodine content, mg/kg Here" name="PPM" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>pH Value</b><span style="color: red;"> </span> </label>
            <div class="col-sm-6">
                <input autocomplete="off" type="text" id="inputSuccess user_define_sl" placeholder="Example:- pH Value Here" name="PH" class="form-control col-xs-10 col-sm-5" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('lookupGroupIndex.active_status') }} </b></label>
            <div class="col-sm-6">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess active_status" class="form-control" name="ACTIVE_FLG">
                    <option value="">-Select-</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
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
    </form>
</div>
<script>
    $(document).on("change",".crudSaltType",function () {
        var crudSaltType = $(this).val();
        var option = '<option value="">Select Invoice No</option>';
        $.ajax({
            type : 'GET',
            url : 'crude-salt-invoice-list',
            data : {'crudSaltType':crudSaltType},
            success: function (data) {
                console.log(data);
//                var data = JSON.parse(data);
                for (var i = 0; i < data.length; i++){
                    option = option + '<option value="'+ data[i].RECEIVEMST_ID +'">'+ data[i].INVOICE_NO+'</option>';
                }

                $('.invoice').html(option);
                $('.invoice').trigger("chosen:updated");
            }
        })
    });
</script>

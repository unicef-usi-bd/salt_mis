<div class="col-md-12">
    <form action="{{ url('/crude-salt-procurement') }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Crude Salt Type</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess RECEIVE_NO" class="chosen-select form-control" name="RECEIVE_NO" data-placeholder="Select Crude Salt Type">
                               <option value=""></option>
                                @foreach($crudeSaltTypes as $chemical)
                                    <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Trading Name</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess SUPP_ID_AUTO" class="chosen-select form-control" name="SUPP_ID_AUTO" data-placeholder="Select Trading Name">
                               <option value=""></option>
                                @foreach($crudeSaltSuppliers as $crudeSaltSupplier)
                                    <option value="{{$crudeSaltSupplier->SUPP_ID_AUTO}}"> {{$crudeSaltSupplier->TRADING_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Source from</b><span style="color: red;"> </span></label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<span class="block input-icon input-icon-right">--}}
                            {{--<select id="form-field-select-3 inputSuccess ITEM_NO" class="chosen-select form-control" name="ITEM_NO" data-placeholder="Select or search data">--}}
                               {{--<option value=""></option>--}}
                                {{--@foreach($crudeSaltSources as $crudeSaltSource)--}}
                                    {{--<option value="{{$crudeSaltSource->LOOKUPCHD_ID}}"> {{$crudeSaltSource->LOOKUPCHD_NAME}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess RCV_QTY" placeholder="Example: Amount here in KG" name="RCV_QTY" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                    <i style="margin-top: 10px; font-weight:bolder;font-size: larger;" >KG</i>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Invoice No</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="Example: Invoice No here" name="INVOICE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Source from</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="privileges" onclick="craateUserJsObject.ShowPrivileges();" class="chosen-select form-control" name="SOURCE_ID" data-placeholder="Select Source">
                               <option value=""></option>
                                @foreach($crudeSaltSources as $crudeSaltSource)
                                    <option value="{{$crudeSaltSource->LOOKUPCHD_ID}}"> {{$crudeSaltSource->LOOKUPCHD_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group resources"  style=" display: none;">
                    <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Country Name</b><span style="color: red;"> </span></label>
                    <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess COUNTRY_ID" class="form-control" name="COUNTRY_ID" data-placeholder="Select or search data">
                               <option value="">Select Country Name</option>
                                @foreach($importedCrudeSaltCountry as $country)
                                    <option value="{{$country->COUNTRY_ID}}"> {{$country->COUNTRY_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <textarea rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5"></textarea>
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

<script>
    var Privileges = jQuery('#privileges');
    var select = this.value;
    Privileges.change(function () {
        if ($(this).val() == 44) {
            $('.resources').show();
        }
        else $('.resources').hide();
    });

</script>





<div class="col-md-12">
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
    <form action="{{ url('/iodized') }}" method="post" class="form-horizontal" role="form">
        <div class="col-md-12">
            @csrf
            {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Batch Number</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess BATCH_NO" placeholder="Example: Auto Generate" name="BATCH_NO" class="form-control col-xs-10 col-sm-5" value="{{ $batchNo }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Amount of Salt</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess REQ_QTY" placeholder="Example: Amount here" name="REQ_QTY" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Date</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" name="BATCH_DATE" id="BATCH_DATE" readonly value="{{date('m/d/Y')}}" class="width-100 date-picker" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Stock</b><span> {{ $totalSalt }} </span></label>
            </div>


        </div>
            {{--<div class="col-md-6">--}}
                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<textarea    rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5" /></textarea>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="col-md-12" style="margin-top: 15px;">
            <h4  style="color: #1B6AAA;">Chemical Dozing</h4>
            <hr>
            <table class="table table-bordered fundAllocation">
                <thead>
                <tr>
                    <th style="width: 255px;">Chemical Type<span style="color:red;"> </span></th>
                    <th style="width: 255px;">Amount<span style="color:red;"> </span></th>
                    <th style="width: 255px;">Stock</th>

                    <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                </tr>
                </thead>
                <tbody class="newRow">
                <tr class="rowFirst">
                    <td>
                                <span class="block input-icon input-icon-right">
                                    <select id="form-field-select-3 inputSuccess PRODUCT_ID" class="chosen-select form-control" name="PRODUCT_ID" data-placeholder="Select or search data">
                                        <option value=""></option>
                                            @foreach($chemicleType as $chemical)
                                                <option value="{{$chemical->ITEM_NO}}"> {{$chemical->ITEM_NAME}}</option>
                                            @endforeach
                                    </select>
                                </span>
                    </td>
                    <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="inputSuccess SELLER_ID" placeholder="Example: Auto Generate" name="SELLER_ID" class="form-control col-xs-10 col-sm-5" value=""/>
                                </span>
                    </td>
                    <td>
                        <span class="block input-icon input-icon-right">
                        <input type="text" id="inputSuccess SELLER_ID" placeholder="Example: Auto Generate" name="SELLER_ID" class="form-control col-xs-10 col-sm-5" value=""/>
                    </span>
                    </td>

                    <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Wastage</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess WASTAGE" placeholder="Example: Auto Generate" name="WASTAGE" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <textarea    rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-5 col-sm-5" /></textarea>
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
    $(document).ready(function(){
        $('.rowAdd').click(function(){
            var getTr = $('tr.rowFirst:first');
            //alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            var defaultRow = $('tr.removableRow:last');

            $('.chosen-select').chosen(0);
        });
    });
    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        $(this).closest("tr.removableRow").remove();
    });
</script>



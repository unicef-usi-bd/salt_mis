<div class="col-md-12">
    <div id="success" class="alert alert-block alert-success" style="display: none;">
        <span id="successMessage"></span>
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
    </div>

    {{--<div id="error" class="alert alert-block alert-danger" style="display: none;">--}}
    {{--<span id="errorMessage"></span>--}}
    {{--</div>--}}

    {{--<form class="form-horizontal frmContent" name="formData" method="POST">--}}
    <form action="{{ url('/seller-distributor-profile') }}" method="post" class="form-horizontal" role="form">
      <div class="col-md-12">
        @csrf
        {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Seller Type</b><span style="color: red;"> </span></label>
                <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess " class="chosen-select form-control" name="" data-placeholder="Select or search data">
                   <option value=""></option>
                    {{--@foreach($upazillas as $upazilla)--}}
                    {{--<option value="{{$upazilla->cost_center_id}}"> {{$upazilla->cost_center_name}}</option>--}}
                    {{--@endforeach--}}
                </select>
            </span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Trading Name</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess union_name" placeholder="Example: Trading Name here" name="union_name" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Trade Lience no</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess union_name" placeholder="Example: Amount per KG here" name="union_name" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Trader Name</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess union_name" placeholder="Example: Auto Generate" name="union_name" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Seller Name</b><span style="color: red;"> </span> </label>
                <div class="col-sm-8">
                    <input type="text" id="inputSuccess union_name" placeholder="Example: Amount per KG here" name="union_name" class="form-control col-xs-10 col-sm-5" value=""/>
                </div>
            </div>
        </div>
      </div>

      {{--<div class="col-md-12" style="margin-top: -30px;">--}}
          {{--<h2 class="left" style="margin-top: 30px;margin-bottom: 30px;">Address</h2>--}}
          {{--<hr style="margin-top: -25px;">--}}
          <div class="col-md-6">
              <div class="form-group">
                  <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b><span style="color: red;"> </span></label>
                  <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess " class="chosen-select form-control" name="" data-placeholder="Select or search data">
                   <option value=""></option>
                    {{--@foreach($upazillas as $upazilla)--}}
                    {{--<option value="{{$upazilla->cost_center_id}}"> {{$upazilla->cost_center_name}}</option>--}}
                    {{--@endforeach--}}
                </select>
            </span>
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b><span style="color: red;"> </span></label>
                  <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess " class="chosen-select form-control" name="" data-placeholder="Select or search data">
                   <option value=""></option>
                    {{--@foreach($upazillas as $upazilla)--}}
                    {{--<option value="{{$upazilla->cost_center_id}}"> {{$upazilla->cost_center_name}}</option>--}}
                    {{--@endforeach--}}
                </select>
            </span>
                  </div>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Upazila/Thana</b><span style="color: red;"> </span></label>
                  <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess " class="chosen-select form-control" name="" data-placeholder="Select or search data">
                   <option value=""></option>
                    {{--@foreach($upazillas as $upazilla)--}}
                    {{--<option value="{{$upazilla->cost_center_id}}"> {{$upazilla->cost_center_name}}</option>--}}
                    {{--@endforeach--}}
                </select>
            </span>
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Union</b><span style="color: red;"> </span></label>
                  <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="form-field-select-3 inputSuccess " class="chosen-select form-control" name="" data-placeholder="Select or search data">
                   <option value=""></option>
                    {{--@foreach($upazillas as $upazilla)--}}
                    {{--<option value="{{$upazilla->cost_center_id}}"> {{$upazilla->cost_center_name}}</option>--}}
                    {{--@endforeach--}}
                </select>
            </span>
                  </div>
              </div>
          </div>
      {{--</div>--}}

        {{--<div class="col-md-12">--}}
            {{--<hr>--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Bazar</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess union_name" placeholder="Example: Amount per KG here" name="union_name" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Phone Number</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess union_name" placeholder="Example: Amount per KG here" name="union_name" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Email</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-8">
                        <input type="text" id="inputSuccess union_name" placeholder="Example: Amount per KG here" name="union_name" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
            </div>
        {{--</div>--}}

        <div class="col-md-12" style="margin-top: 15px;">
            <h4  style="color: #1B6AAA;">Coverage Area</h4>
            <hr>
            <table class="table table-bordered fundAllocation">
                <thead>
                <tr>
                    <th style="width: 180px;">Division<span style="color:red;"> </span></th>
                    <th style="width: 200px;">District<span style="color:red;"> </span></th>
                    <th style="width: 200px;">Upazila/Thana</th>
                    {{--<th style="width: 150px;">Problem</th>--}}

                    <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                </tr>
                </thead>
                <tbody class="newRow">
                <tr class="rowFirst">
                    <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select economic_code_id" id="economic_code_id" name="economic_code_id[]" required >
                                        <option value="">Select</option>
                                        {{--@foreach($economicCodes as $economicCode)--}}
                                            {{--<option value="{{ $economicCode->economic_code_id }}"> {{ $economicCode->economic_code_desc }} ( {{ $economicCode->economic_code }} )  </option>--}}
                                        {{--@endforeach--}}
                                    </select>
                                </span>
                    </td>
                    <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select activity_id" id="activity_id" name="activity_id[]" required >
                                        <option value="">Select</option>
                                        {{--@foreach($activities as $activity)--}}
                                            {{--<option value="{{ $activity->lookup_group_data_id }}"> {{ $activity->group_data_name }}  </option>--}}
                                        {{--@endforeach--}}
                                    </select>
                                </span>
                    </td>
                    <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select technology_id" id="technology_id" name="technology_id[]" required >
                                        <option value=""> Select </option>
                                    </select>
                                    <input type="hidden" class="tech_disabled" disabled="disabled" name="technology_id[]" value="">
                                </span>
                    </td>
                    {{--<td>--}}
                    {{--<span class="block input-icon input-icon-right">--}}
                    {{--<select class="form-control chosen-select" id="problem_id" name="problem_id[]" required >--}}
                    {{--<option value="">Select</option>--}}
                    {{--@foreach($problems as $problem)--}}
                    {{--<option value="{{ $problem->crops_problem_id }}"> {{ $problem->problem_title }} </option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--</span>--}}
                    {{--</td>--}}

                    <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                </tr>
                </tbody>
            </table>
        </div>
      <div class="col-md-12">
          <div class="form-group">
              <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
              <div class="col-sm-8">
                  <textarea  id="inputSuccess union_name" rows="10" placeholder="Example: Remarks here" name="union_name" class="form-control col-xs-10 col-sm-5" value=""/></textarea>
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
{{--@include('masterGlobal.formValidation')--}}
<script>
    //    Add For Multiple Row Dynamically
    $(document).ready(function(){
        $('.rowAdd').click(function(){
            var getTr = $('tr.rowFirst:first');
//            alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            var defaultRow = $('tr.removableRow:last');
            defaultRow.find(' input.batch_no').attr('disabled', false);
            defaultRow.find('select.season_id').prop('disabled', false);
            defaultRow.find('select.technology_id').prop('disabled', false);
//            For Ignore array Conflict
            defaultRow.find('input.tech_disabled').attr('disabled', true);
            defaultRow.find('input.season_disabled').attr('disabled', true);
            defaultRow.find('input.batch_disabled').attr('disabled', true);
            defaultRow.find('span.budget_against_code').text('');
            defaultRow.find('span.errorMsg').text('');
            $('.chosen-select').chosen(0);
        });
    });
    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        $(this).closest("tr.removableRow").remove();
    });


    $(document).on("keyup", ".batch_no", function() {
        var batchNo = $(this).val();
        var thisRow=$(this).parents("tr:first");
        var sourceTypeId = thisRow.find('.sourceTypeId').val();
        if(sourceTypeId===""){
            $(this).val("");
            $('.alert').html('<strong>Warning!</strong> Source Type Must be Required !').fadeIn();
        } else {
            var totalBudget = thisRow.find('.budget_against_code').text();
            var totalAmount = thisRow.find(".unit_cost").val() * batchNo;
            var availBalance = parseInt($('.availBalance').text());
            if (availBalance < parseInt(totalAmount)) {
                $(this).val("");
                $('.alert').html('<strong>Warning !</strong>There is not Enough Fund ! Fund available ' + availBalance + '.00').fadeIn();
            } else if (parseInt(totalAmount) > parseInt(totalBudget)) {
                thisRow.find(".total_amount").val("");
                thisRow.find(".batch_no").val("");
                $('.alert').html('<strong>Warning !</strong> This Amount must be Less or equal ' + totalBudget + '.00').fadeIn();
            }else if(parseInt(totalBudget) === 0){
                thisRow.find(".total_amount").val("");
                $('.alert').html('<strong>Warning!</strong> Budget is not Available ').fadeIn();
            } else {
                thisRow.find(".total_amount").val(totalAmount);
                $('.alert').fadeOut(1000);
            }
        }
    });
</script>
{{--<script>--}}
{{--$(document).ready(function () {--}}
{{--$('#success').hide();--}}
{{--$('#error').hide();--}}
{{--$('.createAjax').on('submit', function(e)  {--}}
{{--e.preventDefault();--}}

{{--$.ajax({--}}
{{--url: "{{ route('unions.store') }}",--}}
{{--type: 'POST',--}}
{{--data: $(".createAjax").serialize(),--}}
{{--success: function (data) {--}}

{{--if(data.success){--}}
{{--$('#successMessage').html('<span>'+data.success+'</span>');--}}
{{--$('input[type=text]').val("");--}}
{{--$('#success').delay(1000).show().fadeOut('slow');--}}
{{--}else{--}}
{{--var errorText = data.errors;--}}

{{--errorText.map(function(error) {--}}
{{--$('#errorMessage').html(error);--}}
{{--$('input[type=text]').val("");--}}
{{--$('#error').delay(1000).show().fadeOut('slow');--}}
{{--//$('#error').show();--}}
{{--});--}}

{{--}--}}
{{--}--}}
{{--});--}}
{{--});--}}
{{--});--}}



{{--</script>--}}


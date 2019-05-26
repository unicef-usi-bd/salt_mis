<style>
    .my-error-class {
        color:red;
    }
</style>
<div id="entrepreneur_tab" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info entrepreneur_msg"></div>


            <form id="entrepreneurId"  class="form-horizontal myform" role="form">

                @csrf
                @if(isset($millerInfoId))
                    <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                @endif
                {{--<div class="col-md-6">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Registration Type</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select id="REG_TYPE_ID" class="chosen-select chosen-container" name="REG_TYPE_ID" data-placeholder="Select or search data">--}}
                                   {{--<option value=""></option>--}}
                                    {{--@foreach($registrationType as $row)--}}
                                       {{--<option value="{{ $row->LOOKUPCHD_ID }}" @if($editEntrepData->REG_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                   {{--@endforeach--}}

                               {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}

                {{--<div class="col-md-6">--}}

                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Owner</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="OWNER_TYPE_ID" name="OWNER_TYPE_ID" class="chosen-select chosen-container" data-placeholder="Select or search data">--}}
                                    {{--<option value=""></option>--}}
                                    {{--@foreach($ownerType as $row)--}}
                                        {{--<option value="{{ $row->LOOKUPCHD_ID }}" @if($editEntrepData->OWNER_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                    {{--@endforeach--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}


                <div class="table-width" style="overflow-x: scroll;height: 280px;">
                    <table class="table table-bordered fundAllocation" style="margin-top: 64px;">
                        <thead>
                        <tr>
                            <th style="width:200px;">Owner Name <span style="color:red;"> *</span></th>
                            <th style="width:200px;">Division<span style="color:red;"> </span></th>
                            <th style="width:200px!important;">District</th>
                            <th style="width:200px;">Upazila</th>
                            <th style="width:200px;">Union</th>
                            <th style="width:200px;">NID<span style="color:red;"> </span></th>
                            <th style="width:200px;">Mobile 1<span style="color:red;"> *</span></th>
                            <th style="width:200px;">Mobile 2</th>
                            <th style="width:200px;">Email <span style="color:red;"> *</span></th>
                            <th style="width:200px;">Remarks</th>
                            <th style="width:30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                        </tr>
                        </thead>
                        <tbody class="newRowEntp">
                        @foreach($getEntrepreneurRowData as $editEntrepData)
                            <tr class="rowFirstEntp">
                                <td>
                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax class="width-100"--> </span>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" name="OWNER_NAME[]"  value="{{ $editEntrepData->OWNER_NAME }}" class="OWNER_NAME required" required  />
                                        <span style="color:red;display:none;" class="error">This field is required</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        {{--<select class="width-100 form-control chosen-select DIVISION_ID" id="ENT_DIVISION_ID" name="DIVISION_ID[]"  >--}}
                                        <select class="form-control DIVISION_ID chosen-select" id="ENT_DIVISION_ID" name="DIVISION_ID[]"  >
                                            <option value="">Select Division</option>
                                            @foreach($getDivision as $row)
                                                <option value="{{$row->DIVISION_ID}}" @if($editEntrepData->DIVISION_ID==$row->DIVISION_ID) selected @endif> {{$row->DIVISION_NAME}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <select class="form-control  ent_district chosen-select" id="ENT_DISTRICT_ID" name="DISTRICT_ID[]"  >
                                            <option value="{{ $editEntrepData->DISTRICT_ID }}">{{ $editEntrepData->DISTRICT_NAME }}</option>
                                         </select>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <select class="form-control ent_upazila chosen-select" id="ENT_UPAZILA_ID" name="UPAZILA_ID[]"  >
                                            <option value="{{ $editEntrepData->DISTRICT_ID }}">{{ $editEntrepData->DISTRICT_NAME }}</option>
                                        </select>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <select class="form-control ent_union chosen-select" id="UNION_ID" name="UNION_ID[]"  >
                                            <option value="{{ $editEntrepData->DISTRICT_ID }}">{{ $editEntrepData->DISTRICT_NAME }}</option>
                                        </select>
                                    </span>
                                </td>
                                <td>
                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" name="NID[]" id="inputSuccess total_amount" value="{{ $editEntrepData->NID }}" class="NID"  />
                                    </span>
                                </td>
                                <td>
                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" name="MOBILE_1[]" minlength="11" maxlength="11" value="{{ $editEntrepData->MOBILE_1 }}" class="MOBILE_1 required numbersOnly"   />
                                        <span style="color:red;display:none;" class="error">This field is required</span>
                                        <span style="color:red;" class="errorMobile"></span>
                                    </span>
                                </td>
                                <td>
                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                    <span class="block input-icon input-icon-right">
                                        <input type="number" name="MOBILE_2[]" minlength="11" maxlength="11" value="{{ $editEntrepData->MOBILE_2 }}" class="MOBILE_2 " numbersOnly />
                                        <span style="color:red;" class="errorMobile2"></span>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" name="EMAIL[]" id="inputSuccess batch_no" value="{{ $editEntrepData->EMAIL }}" class="EMAIL required"  />
                                        {{--<input type="hidden" class="batch_disabled" disabled="disabled" name="batch_no[]" value="">--}}
                                        <span style="color:red;display:none;" class="error">This field is required</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="budget_against_code "><!-- Drop Total Budget here By Ajax --></span>
                                    <span class="block input-icon input-icon-right">
{{--                                        <input type="text" name="REMARKS[]" id="inputSuccess total_amount" value="{{ $editEntrepData->REMARKS }}" class="REMARKS"  />--}}
                                        <textarea name="REMARKS[]" class="REMARKS" id="" cols="25" rows="1">{{ $editEntrepData->REMARKS }}</textarea>
                                    </span>
                                </td>
                                <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 35%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-success btnUpdateEntrepreneur" onclick="entrepreneurTab()" id="submitbutton">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Update & Next
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        $('.entrepreneur_msg').hide();
        $(document).on('click','.btnUpdateEntrepreneur',function () {
            $.ajax({
                type : 'POST',
                url : 'edit-entrepreneur-info',
                data : $('#entrepreneurId').serialize(),
                success: function (data) {
                    console.log(data);
                    $('.entrepreneur_msg').html('<span>'+ data +'</span>').show();

                    setTimeout(function() { $(".entrepreneur_msg").hide(); }, 3000);

                }
            })
        });

        // Check Validation
        // input type text and number validation enable disable button
        $(document).ready(function() {
            $('input[type="text"]').keyup(function () {
                checkValidation($(this))
            });

            $('input[type="number"]').keyup(function () {
                checkValidation($(this))
            });
        });

        function checkValidation(selector) {
            var thisInput = selector.closest('.block');
            var mobile = $('.MOBILE_1').val();
            var mobile2 = $('.MOBILE_2').val();
            var status = true;
            $('input.required').each(function () {
                if ($(this).val() === "") {
                    status = false;
                }
            });

            if(checkMobileDigit(mobile)!==true ){
                status = false;
            }
            console.log(mobile);
            if(checkMobileDigit(mobile2)!==true ){
                status = false;
            }
            console.log(mobile2);

            if (status === true) {
                $('input[type="button"]').prop('disabled', false);
            } else {
                $('input[type="button"]').prop('disabled', true);
            }
            if(thisInput.find('.required').val()===""){
                thisInput.find('span.error').show();
            } else{
                thisInput.find('span.error').hide();
            }
        }
        // mobilee only number
        $(document).on('keyup', '.numbersOnly', function() {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2) {
                    val = val.replace(/\.+$/, "");
                }
            }
            $(this).val(val);
        });
        // show error msg for mobile
        $(document).on('keyup', '.MOBILE_1', function () {
            var mobile =$(this).val();
            var status = checkMobileDigit(mobile);
            if(status!==true){
                $('.errorMobile').text('11 digits only');
            } else{
                $('.errorMobile').text('');
            }
        });
        // allow only 11 digit
        $(document).on('keyup', '.MOBILE_2', function () {
            var mobile2 =$(this).val();
            var status = checkMobileDigit(mobile2);
            if(status!==true){
                $('.errorMobile2').text('11 digits only');
            } else{
                $('.errorMobile2').text('');
            }
        });

        function checkMobileDigit(number) {
            var status = true;
            if(number.length<11 && number!==""){
                status = false;
            }
            return status;
        }



    </script>

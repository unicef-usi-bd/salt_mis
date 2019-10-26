<style>
    .input-icon.input-icon-right>input,select.form-control {
        padding-left: 3px;
        padding-right: 0px;
        font-size: small;
    }
</style>
<div id="entrepreneur" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            {{--<div class="alert alert-info entrepreneur_msg"></div>--}}


            <form id="entrepreneurId"  class="form-horizontal" role="form" action="{{ url('edit-entrepreneur-info') }}" >
                @csrf
                @if(isset($millerInfoId))
                    <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                @endif

                <div class="table-width" style="overflow-x: scroll;height: 280px;">
                    <table class="table table-bordered fundAllocation" style="margin-top: 64px;">
                        <thead>
                        <tr>
                            <th style="width:200px;">Owner Name <span style="color:red;"> *</span></th>
                            <th style="width:200px;">Division<span style="color:red;"> </span></th>
                            <th style="width:200px!important;">District</th>
                            <th style="width:200px;">Upazila</th>
                            {{--<th style="width:200px;">Union</th>--}}
                            <th style="width:200px;">NID<span style="color:red;"> </span></th>
                            <th style="width:200px;">Mobile 1<span style="color:red;"> *</span></th>
                            <th style="width:200px;">Mobile 2</th>
                            <th style="width:200px;">Email <span style="color:red;"> *</span></th>
                            <th style="width:200px;">Remarks</th>
                            <th style="width:30px;" class="addButton"><span class="btn btn-primary btn-sm pull-right rowAdd3"><i class="fa fa-plus"></i></span></th>
                        </tr>
                        </thead>
                        <tbody class="newRow">
                        @foreach($getEntrepreneurRowData as $editEntrepData)
                            <tr class="rowFirst">
                                <td>
                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" name="OWNER_NAME[]" id="inputSuccess " value="{{ $editEntrepData->OWNER_NAME }}" class="OWNER_NAME required"  />
                                        <span style="color:red;display:none;" class="error">This field is required</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <select class="form-control chosen-select DIVISION_ID" id="ENT_DIVISION_ID" name="DIVISION_ID[]" url="{{ url('supplier-profile/get-district') }}" >
                                            <option value="">Select</option>
                                            @foreach($getDivision as $row)
                                                <option value="{{$row->DIVISION_ID}}" @if($editEntrepData->DIVISION_ID==$row->DIVISION_ID) selected @endif> {{$row->DIVISION_NAME}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <select class="form-control chosen-select ent_district" id="ENT_DISTRICT_ID" name="DISTRICT_ID[]" url="{{ url('supplier-profile/get-upazila') }}" >
                                            <option value="{{ $editEntrepData->DISTRICT_ID }}">{{ $editEntrepData->DISTRICT_NAME }}</option>
                                         </select>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <select class="form-control chosen-select ent_upazila" id="ENT_UPAZILA_ID" name="UPAZILA_ID[]" url="{{ url('supplier-profile/get-union') }}" >
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
                                        <input type="text" name="MOBILE_1[]" id="inputSuccess total_amount" value="{{ $editEntrepData->MOBILE_1 }}" class="MOBILE_1 required"  />
                                        <span style="color:red;display:none;" class="error">This field is required</span>
                                        <span style="color:red;" class="errorMobile"></span>
                                    </span>
                                </td>
                                <td>
                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" name="MOBILE_2[]" id="inputSuccess total_amount" value="{{ $editEntrepData->MOBILE_2 }}" class="MOBILE_2"  />
                                        <span style="color:red;" class="errorMobile2"></span>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" name="EMAIL[]" id="inputSuccess batch_no" value="{{ $editEntrepData->EMAIL }}" class="EMAIL required"  />
                                        <span style="color:red;display:none;" class="error">This field is required</span>

                                    </span>
                                </td>
                                <td>
                                    <span class="budget_against_code "><!-- Drop Total Budget here By Ajax --></span>
                                    <span class="block input-icon input-icon-right">

                                        <textarea name="REMARKS[]" class="REMARKS" id="" cols="25" rows="1">{{ $editEntrepData->REMARKS }}</textarea>
                                    </span>
                                </td>
                                <td class="removeButton"><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 44%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary btnUpdateEntrepInfo" onclick="entrepreneurTab()">
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
    $(document).ready(function(){
        $('.rowAdd3').click(function(){
            var getTr = $('tr.rowFirst:first');
//            alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            var defaultRow = $('tr.removableRow:last');
            defaultRow.find(' input.OWNER_NAME').val('');
            defaultRow.find('select.DIVISION_ID').val('');
            defaultRow.find('select.ent_district').val('');
            defaultRow.find('select.ent_upazila').val('');
//            For Ignore array Conflict
            defaultRow.find('input.NID').val('');
            defaultRow.find('input.MOBILE_1').val('');
            defaultRow.find('input.MOBILE_2').val('');
            defaultRow.find('input.EMAIL').val('');
            defaultRow.find('input.REMARKS').val('');
            defaultRow.find('span.budget_against_code').text('');
            defaultRow.find('span.errorMsg').text('');
            $('.chosen-select').chosen(0);
        });

        // Fore Remove Row By Click
        $(document).on("click", "span.rowRemove ", function () {
            $(this).closest("tr.removableRow").remove();
        });

        $(document).on('change','.DIVISION_ID',function () {
            var divisionId = $(this).val(); //alert(divisionId); //exit();
            var option = '<option value="">Select District</option>';
            var url  = $(this).attr('url');
            var url = url+'/'+divisionId;
            $.ajax({
                type : "get",
                url  : url,
                data : {'divisionId': divisionId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                    }
                    $('.ent_district').html(option);
                    $('.ent_district').trigger("chosen:updated");
                }
            });
        });


        $(document).on('change','.ent_district',function(){
            var districtId = $(this).val(); //alert(districtId); exit();
            var option = '<option value="">Select Upazila</option>';
            var url = $(this).attr('url');
            var url = url+'/'+districtId;
            $.ajax({
                type : "get",
                url  : url,
                data : {'districtId': districtId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                    }
                    $('.ent_upazila').html(option);
                    $('.ent_upazila').trigger("chosen:updated");
                }
            });
        });

    });

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
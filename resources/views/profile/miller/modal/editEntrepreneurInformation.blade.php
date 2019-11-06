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

                <?php

                $milltype =  DB::select(DB::raw("select OWNER_TYPE_ID, MILL_ID
                                                    from ssm_mill_info
                                                    where MILL_ID = $millerInfoId"));

                ?>


                <div class="table-width" style="overflow-x: scroll;height: 280px;">
                    <table id="enterprenurInfoTableID" class="table table-bordered fundAllocation" style="margin-top: 64px;">
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
                            <th style="width:30px;" class="addButton @if($editMillData->OWNER_TYPE_ID == 12) hidden @endif"><span class="btn btn-primary btn-sm pull-right rowAddNew"><i class="fa fa-plus"></i></span></th>

                        </tr>
                        </thead>
                        <tbody class="newRowNew">
                        @foreach($getEntrepreneurRowData as $editEntrepData)
                            <tr class="removableRow">
                                <td>
                                    <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax class="width-100"--> </span>
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" name="OWNER_NAME[]"  value="{{ $editEntrepData->OWNER_NAME }}" class="OWNER_NAME required" required  />
                                        <span style="color:red;display:none;" class="error">This field is required</span>
                                    </span>
                                    <input type="hidden" value="{{ $editEntrepData->ENTREPRENEUR_ID }}" name="ENTREPRENEUR_ID">
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <select class="form-control DIVISION_ID chosen-select" id="ENT_DIVISION_ID" name="DIVISION_ID[]" url="{{ url('supplier-profile/get-district') }}" >
                                            <option value="">Select Division</option>
                                            @foreach($getDivision as $row)
                                                <option value="{{$row->DIVISION_ID}}" @if($editEntrepData->DIVISION_ID==$row->DIVISION_ID) selected @endif> {{$row->DIVISION_NAME}}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </td>
                                <td>
                                    <span class="block input-icon input-icon-right">
                                        <select class="form-control  ent_district chosen-select" id="ENT_DISTRICT_ID" name="DISTRICT_ID[]" url="{{ url('supplier-profile/get-upazila') }}"  >
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

                                <td class="removeButton @if($editMillData->OWNER_TYPE_ID == 12) hidden @endif"><span class="btn btn-danger btn-sm pull-right EntrowRemove"><i class="fa fa-remove"></i></span></td>

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
                        @if(isset($associationId))
                            {{--<button type="button" class="btn btn-success btnUpdateApprove" onclick="entrepreneurTab()" id="submitbutton">--}}
                                {{--<i class="ace-icon fa fa-check bigger-110"></i>--}}
                                {{--Approve--}}
                            {{--</button>--}}
                            <button type="button" class="btn btn-success btnUpdateEntrepreneur" onclick="entrepreneurTab()" id="submitbutton">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Update & Next
                            </button>
                        @else
                            @if($editEntrepData->approval_status == 0)
                                <button type="button" class="btn btn-success btnUpdateTemEntrepreneur" onclick="entrepreneurTab()" id="submitbutton">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Update & Next
                                </button>
                            @else
                                <span style="color: red;font-size: 18px;margin-left: 5px;">Waiting for Association update your previous request</span>
                            @endif
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    //$(document).on('click','.rowAddNew',function () {
    $(document).ready(function() {
        $('.rowAddNew').click(function () {
            var getTr = $('tr.removableRow:first');
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRowNew').append("<tr class='removableRow'>" + getTr.html() + "</tr>");
            var defaultRow = $('tr.removableRow:last');
            defaultRow.find(' input.OWNER_NAME').val('');
            defaultRow.find('select.DIVISION_ID').val('');
            defaultRow.find('select.ent_district').val('').trigger("chosen:updated");
            defaultRow.find('select.ent_upazila ').val('').trigger("chosen:updated");
            defaultRow.find('select.UNION_ID').val('');
//            For Ignore array Conflict
            defaultRow.find('input.NID').val('');
            defaultRow.find('input.MOBILE_1').val('');
            defaultRow.find('input.MOBILE_2').val('');
            defaultRow.find('input.EMAIL').val('');
            defaultRow.find('input.REMARKS').val('');
            defaultRow.find('span.budget_against_code').val('');
            defaultRow.find('span.errorMsg').val('');
            $('.chosen-select').chosen(0);
        });


        // Fore Remove Row By Click
        $(document).on("click", "span.EntrowRemove ", function () {
            var count = $('#enterprenurInfoTableID tr').length - 1;
            if(count > 1) {
                $(this).closest("tr.removableRow").remove();
            }
        });

        $(document).on('change','.DIVISION_ID',function () {
            var thisRow = $(this).closest('tr');
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
                    thisRow.find('.ent_district').html(option);
                    thisRow.find('.ent_district').trigger("chosen:updated");
                }
            });
        });


        $(document).on('change','.ent_district',function(){
            var thisRow = $(this).closest('tr');
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
                    thisRow.find('.ent_upazila').html(option);
                    thisRow.find('.ent_upazila').trigger("chosen:updated");
                }
            });
        });
    });


    // validation check
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
                "OWNER_NAME[]": {
                    required: true
                },
                "MOBILE_1[]":{
                    required: true,
                    regex:/^(?:\+?88)?01[15-9]\d{8}$/,
                },
                // "MOBILE_2[]":{
                //     maxlength:11,
                //     regex:/^(?:\+?88)?01[15-9]\d{8}$/,
                //
                // },
                "EMAIL[]":{
                    required: true,
                    email: true
                },
                "NID[]":{
                    required: true,
                }

            }
        });

    });
</script>

<script>
    //        $('.entrepreneur_msg').hide();
    //        $(document).on('click','.btnUpdateEntrepreneur',function () {
    //            $.ajax({
    //                type : 'POST',
    //                url : 'edit-entrepreneur-info',
    //                data : $('#entrepreneurId').serialize(),
    //                success: function (data) {
    //                    console.log(data);
    //                    $('.entrepreneur_msg').html('<span>'+ data +'</span>').show();
    //
    ////                    setTimeout(function() { $(".entrepreneur_msg").hide(); }, 3000);
    //
    //                }
    //            })
    //        });

    $('.entrepreneur_msg').hide();
    $(document).on('click','.btnUpdateEntrepreneur',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-entrepreneur-info-update',
            data : $('#entrepreneurId').serialize(),
            success: function (data) {
                console.log(data);
                $('.entrepreneur_msg').html('<span>'+ data +'</span>').show();

                setTimeout(function() { $(".entrepreneur_msg").hide(); }, 3000);

            }
        })
    });

    $('.entrepreneur_msg').hide();
    $(document).on('click','.btnUpdateTemEntrepreneur',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-entrepreneur-info-tem',
            data : $('#entrepreneurId').serialize(),
            success: function (data) {
                console.log(data);
                $('.entrepreneur_msg').html('<span>'+ data +'</span>').show();

                setTimeout(function() { $(".entrepreneur_msg").hide(); }, 3000);

            }
        })
    });
    //      $(document).ready(function () {
    //          $("#entrepreneur_tab").load(location.href + " #entrepreneur_tab");
    //      });
    $('.millmsg').hide();
    $(document).on('click','.btnUpdateApprove',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-mill-info-approve',
            data : $('#millId').serialize(),
            success: function (data) {
                console.log(data);
                $('.millmsg').html('<span>'+ data +'</span>').show();
                setTimeout(function() { $(".millmsg").hide(); }, 3000);

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

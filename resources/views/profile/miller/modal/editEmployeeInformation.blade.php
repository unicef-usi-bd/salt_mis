<div id="employee_tab" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info empmsg"></div>

            {{--<form action="{{ url('/employee-info') }}" method="post" class="form-horizontal" role="form" >--}}
            <form id="employeeId"  class="form-horizontal" role="form" >
                @csrf
                @if(isset($millerInfoId))
                    <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                @endif
                <div class="col-md-6">
                    <b style="font-size: 14px;">Total Number of Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTMALE_EMP" value="{{ $editEmployeeData->TOTMALE_EMP }}" class="chosen-container totalMaleEmp empValidation" placeholder="Male">
                            </span>
                            <input type="hidden" value="{{ $editEmployeeData->MILLEMP_ID}}" name="MILLEMP_ID">
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTFEM_EMP" value="{{ $editEmployeeData->TOTFEM_EMP }}" class="chosen-container totalFemaleEmp empValidation" placeholder="Female">
                            </span>
                        </div>
                    </div>

                    <b style="font-size: 14px;">Part Time Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="PARTTIMEMALE_EMP" value="{{ $editEmployeeData->PARTTIMEMALE_EMP }}" class="chosen-container partTimeMaleEmp empValidation" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="PARTTIMEFEM_EMP" value="{{ $editEmployeeData->PARTTIMEFEM_EMP }}" class="chosen-container partTimeFemaleEmp empValidation" placeholder="Female">
                            </span>
                        </div>
                        <br>

                    </div>
                    <span style="color:red;display: none" class="error">Total number of Employee must be equal to Part time and Full time employee.</span>
                    <br><b style="font-size: 14px;">Remarks</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
{{--                               <input type="text" name="REMARKS" value="{{ $editEmployeeData->REMARKS }}" class="chosen-container" placeholder="Male">--}}
                                <textarea name="REMARKS" id="" cols="131" rows="3">{{ $editEmployeeData->REMARKS }}</textarea>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <b style="font-size: 14px;">Full Time Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="FULLTIMEMALE_EMP" value="{{ $editEmployeeData->FULLTIMEMALE_EMP }}" class="chosen-container fullTimeMaleEmp empValidation" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="FULLTIMEFEM_EMP" value="{{ $editEmployeeData->FULLTIMEFEM_EMP }}" class="chosen-container fullTimeFemaleEmp empValidation" placeholder="Female">
                            </span>
                        </div>
                    </div>
                    <b style="font-size: 14px;">Total Number of Technical Person </b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTMALETECH_PER" value="{{ $editEmployeeData->TOTMALETECH_PER }}" class="chosen-container" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTFEMTECH_PER" value="{{ $editEmployeeData->TOTFEMTECH_PER }}" class="chosen-container" placeholder="Female">
                            </span>
                        </div>
                    </div>


                </div>

                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 35%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        @if(isset($associationId))
                            {{--<button type="button" class="btn btn-success btnUpdateApprove" onclick="employeeTab()">--}}
                                {{--<i class="ace-icon fa fa-check bigger-110"></i>--}}
                                {{--Approve--}}
                            {{--</button>--}}
                            <button type="button" class="btn btn-success btnUpdateEmp" onclick="employeeTab()">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Update & Next
                            </button>
                        @else
                            @if($editMillData->approval_status == 0)
                                <button type="button" class="btn btn-success btnUpdateEmpTem" onclick="employeeTab()">
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
    $('.empmsg').hide();
    $(document).on('click','.btnUpdateEmp',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-employee-info',
            data : $('#employeeId').serialize(),
            success: function (data) {
                console.log(data);
                $('.empmsg').html('<span>'+ data +'</span>').show();
                setTimeout(function() { $(".empmsg").hide(); }, 3000);

            }
        })
    });

    $('.empmsg').hide();
    $(document).on('click','.btnUpdateEmpTem',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-employee-info-tem',
            data : $('#employeeId').serialize(),
            success: function (data) {
                console.log(data);
                $('.empmsg').html('<span>'+ data +'</span>').show();
                setTimeout(function() { $(".empmsg").hide(); }, 3000);

            }
        })
    });

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
    // validation for full time employee
    // $(document).on("change",".partTimeFemaleEmp", function () {
    //
    //     var  totalMaleEmp = $('.totalMaleEmp').val();
    //     var  totalFemaleEmp = $('.totalFemaleEmp').val();
    //     var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
    //     var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
    //     var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
    //     var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
    //     var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
    //     var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
    //     var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
    //     var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
    //     if(total!=totalPartFullEmp){
    //         //alert('Total number of Employee must be equal to Part time and Full time employee');
    //         $('.btnUpdateEmp').prop('disabled', true);
    //         $('span.error').show();
    //     }else{
    //         $('.btnUpdateEmp').prop('disabled', false);
    //         $('span.error').hide();
    //     }
    //
    // });
</script>
{{--@include('profile.miller.totalEmployeeValidation')--}}
<script>

    $(document).ready(function () {
        $('.finalSubmit').prop('disabled', true);
    });

    $(document).on('keyup','.partTimeMaleEmp',function () {
        var partTimeMale = $(this).val();

        if(partTimeMale > 0){
            $('.fullTimeMaleEmp').removeAttr('required');
        }
    });

    $(document).on('keyup','.partTimeFemaleEmp',function () {
        var partTimeFemale = $(this).val();

        if(partTimeFemale > 0){
            $('.fullTimeFemaleEmp').removeAttr('required');
        }
    });

    $(document).on('keyup','.fullTimeMaleEmp',function () {
        var fullTimeMale = $(this).val();

        if(fullTimeMale > 0){
            $('.partTimeMaleEmp').removeAttr('required');
        }
    });

    $(document).on('keyup','.partTimeFemaleEmp',function () {
        var partTimeFemale = $(this).val();

        if(partTimeFemale > 0){
            $('.fullTimeFemaleEmp').removeAttr('required');
        }
    });

    $(document).on("keyup  change",".empValidation",function(){
        var thisvalue= $(this).val();
        if(!thisvalue){
            $(this).val(0).select();
        }
        var  totalMaleEmp = $('.totalMaleEmp').val();
        var  totalFemaleEmp = $('.totalFemaleEmp').val();
        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
        var total  = parseInt(totalMaleEmp == '' ? 0 : totalMaleEmp)+parseInt(totalFemaleEmp == '' ? 0 :totalFemaleEmp);
        var totalPartFullMaleEmp  = parseInt(partTimeMaleEmp == '' ? 0 :partTimeMaleEmp)+parseInt(fullTimeMaleEmp == '' ? 0 :fullTimeMaleEmp);
        var totalPartFullFemaleEmp  = parseInt(partTimeFemaleEmp == '' ? 0 :partTimeFemaleEmp)+parseInt(fullTimeFemaleEmp == '' ? 0 :fullTimeFemaleEmp);
        var totalPartFullEmp = parseInt(partTimeMaleEmp == '' ? 0 :partTimeMaleEmp)+parseInt(partTimeFemaleEmp == '' ? 0 :partTimeFemaleEmp)+parseInt(fullTimeMaleEmp == '' ? 0 :fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp == '' ? 0 :fullTimeFemaleEmp);

        if(totalPartFullEmp <= 0){
            $('.finalSubmit').prop('disabled', true);
            $('span.error').show();
        }else{
            if(total == totalPartFullEmp && totalMaleEmp == totalPartFullMaleEmp && totalFemaleEmp == totalPartFullFemaleEmp){
                $('.btnUpdateEmp').prop('disabled', false);
                $('span.error').hide();
            }else{
                $('.btnUpdateEmp').prop('disabled', true);
                $('span.error').show();
            }
        }
    });


    // validation for full time employee
    //    $(document).on("keyup",".partTimeMaleEmp", function () {
    //
    //        var  totalMaleEmp = $('.totalMaleEmp').val();
    //        var  totalFemaleEmp = $('.totalFemaleEmp').val();
    //        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
    //        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
    //        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
    //        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
    //        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
    //        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
    //        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
    //        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
    //        if(total!=totalPartFullEmp){
    //
    //            $('.finalSubmit').prop('disabled', true);
    //            $('span.error').show();
    //        }else{
    //            $('.finalSubmit').prop('disabled', false);
    //            $('span.error').hide();
    //        }
    //
    //    });
    //    $(document).on("keyup",".partTimeFemaleEmp", function () {
    //
    //        var  totalMaleEmp = $('.totalMaleEmp').val();
    //        var  totalFemaleEmp = $('.totalFemaleEmp').val();
    //        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
    //        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
    //        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
    //        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
    //        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
    //        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
    //        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
    //        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
    //        if(total!=totalPartFullEmp){
    //
    //            $('.finalSubmit').prop('disabled', true);
    //            $('span.error').show();
    //        }else{
    //            $('.finalSubmit').prop('disabled', false);
    //            $('span.error').hide();
    //        }
    //
    //    });
    //    $(document).on("keyup",".fullTimeMaleEmp", function () {
    //
    //        var  totalMaleEmp = $('.totalMaleEmp').val();
    //        var  totalFemaleEmp = $('.totalFemaleEmp').val();
    //        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
    //        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
    //        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
    //        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
    //        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
    //        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
    //        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
    //        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
    //        if(total!=totalPartFullEmp){
    //
    //            $('.finalSubmit').prop('disabled', true);
    //            $('span.error').show();
    //        }else{
    //            $('.finalSubmit').prop('disabled', false);
    //            $('span.error').hide();
    //        }
    //
    //    });
    //    $(document).on("keyup blur change",".fullTimeFemaleEmp", function () {
    //
    //        var  totalMaleEmp = $('.totalMaleEmp').val();
    //        var  totalFemaleEmp = $('.totalFemaleEmp').val();
    //        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
    //        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
    //        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
    //        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
    //        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
    //        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
    //        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
    //        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
    //        if(total!=totalPartFullEmp){
    //
    //            $('.finalSubmit').prop('disabled', true);
    //            $('span.error').show();
    //        }else{
    //            $('.finalSubmit').prop('disabled', false);
    //            $('span.error').hide();
    //        }
    //
    //    });
    //    $(document).on("keyup",".totalMaleEmp", function () {
    //
    //        var  totalMaleEmp = $('.totalMaleEmp').val();
    //        var  totalFemaleEmp = $('.totalFemaleEmp').val();
    //        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
    //        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
    //        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
    //        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
    //        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
    //        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
    //        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
    //        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
    //        if(total!=totalPartFullEmp){
    //
    //            $('.finalSubmit').prop('disabled', true);
    //            $('span.error').show();
    //        }else{
    //            $('.finalSubmit').prop('disabled', false);
    //            $('span.error').hide();
    //        }
    //
    //    });
    //
    //    $(document).on("keyup",".totalFemaleEmp", function () {
    //
    //        var  totalMaleEmp = $('.totalMaleEmp').val();
    //        var  totalFemaleEmp = $('.totalFemaleEmp').val();
    //        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
    //        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
    //        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
    //        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
    //        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
    //        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
    //        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
    //        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
    //        if(total!=totalPartFullEmp){
    //
    //            $('.finalSubmit').prop('disabled', true);
    //            $('span.error').show();
    //        }else{
    //            $('.finalSubmit').prop('disabled', false);
    //            $('span.error').hide();
    //        }
    //
    //    });



</script>
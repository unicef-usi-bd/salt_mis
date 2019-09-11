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
                               <input type="text" name="TOTMALE_EMP" value="{{ $editEmployeeData->TOTMALE_EMP }}" class="chosen-container totalMaleEmp" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTFEM_EMP" value="{{ $editEmployeeData->TOTFEM_EMP }}" class="chosen-container totalFemaleEmp" placeholder="Female">
                            </span>
                        </div>
                    </div>

                    <b style="font-size: 14px;">Part Time Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="PARTTIMEMALE_EMP" value="{{ $editEmployeeData->PARTTIMEMALE_EMP }}" class="chosen-container partTimeMaleEmp" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="PARTTIMEFEM_EMP" value="{{ $editEmployeeData->PARTTIMEFEM_EMP }}" class="chosen-container partTimeFemaleEmp" placeholder="Female">
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
                               <input type="text" name="FULLTIMEMALE_EMP" value="{{ $editEmployeeData->FULLTIMEMALE_EMP }}" class="chosen-container fullTimeMaleEmp" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="FULLTIMEFEM_EMP" value="{{ $editEmployeeData->FULLTIMEFEM_EMP }}" class="chosen-container fullTimeFemaleEmp" placeholder="Female">
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
                            <button type="button" class="btn btn-success btnUpdateEmp" onclick="employeeTab()">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Approve
                            </button>
                        @else
                            <button type="button" class="btn btn-success btnUpdateEmp" onclick="employeeTab()">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Update & Next
                            </button>
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
    })
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
@include('profile.miller.totalEmployeeValidation')
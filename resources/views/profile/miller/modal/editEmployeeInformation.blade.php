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
                                                       <input type="text" name="TOTMALE_EMP" value="{{ $editEmployeeData->TOTMALE_EMP }}" class="chosen-container" placeholder="Male">
                                                    </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTFEM_EMP" value="{{ $editEmployeeData->TOTFEM_EMP }}" class="chosen-container" placeholder="Female">
                            </span>
                        </div>
                    </div>

                    <b style="font-size: 14px;">Part Time Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="PARTTIMEMALE_EMP" value="{{ $editEmployeeData->PARTTIMEMALE_EMP }}" class="chosen-container" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="PARTTIMEFEM_EMP" value="{{ $editEmployeeData->PARTTIMEFEM_EMP }}" class="chosen-container" placeholder="Female">
                            </span>
                        </div>
                    </div>
                    <b style="font-size: 14px;">Remarks</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="REMARKS" value="{{ $editEmployeeData->REMARKS }}" class="chosen-container" placeholder="Male">
                            </span>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <b style="font-size: 14px;">Full Time Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="FULLTIMEMALE_EMP" value="{{ $editEmployeeData->FULLTIMEMALE_EMP }}" class="chosen-container" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="FULLTIMEFEM_EMP" value="{{ $editEmployeeData->FULLTIMEFEM_EMP }}" class="chosen-container" placeholder="Female">
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
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 44%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary btnUpdateEmp">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Submit
                        </button>
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

            }
        })
    })
</script>
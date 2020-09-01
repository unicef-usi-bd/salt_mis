<div id="employee" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/employee-info/'.$millerInfo->MILL_ID) }}" data-clear="false" method="post" class="form-horizontal" role="form" >
                @csrf
                @method('PUT')
                <input type="hidden" name="MILLEMP_ID" value="@if(!empty($employeeInfo)){{ $employeeInfo->MILLEMP_ID }}@endif" />
                <div class="col-md-6">
                    <b style="font-size: 14px;">Full Time Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Male</label>
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="FULLTIMEMALE_EMP" value="@if(!empty($employeeInfo)){{ $employeeInfo->FULLTIMEMALE_EMP }}@endif" class="chosen-container FULLTIMEMALE_EMP" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <label>Female</label>
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="FULLTIMEFEM_EMP" value="@if(!empty($employeeInfo)){{ $employeeInfo->FULLTIMEFEM_EMP }}@endif" class="chosen-container FULLTIMEFEM_EMP" placeholder="Female">
                            </span>
                        </div>
                    </div>

                    <b style="font-size: 14px;">Part Time Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Male</label>
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="PARTTIMEMALE_EMP" onkeypress="return numbersOnly(this, event)" value="@if(!empty($employeeInfo)){{ $employeeInfo->PARTTIMEMALE_EMP }}@endif" class="chosen-container PARTTIMEMALE_EMP" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <label>Female</label>
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="PARTTIMEFEM_EMP" onkeypress="return numbersOnly(this, event)" value="@if(!empty($employeeInfo)){{ $employeeInfo->PARTTIMEFEM_EMP }}@endif" class="chosen-container PARTTIMEFEM_EMP" placeholder="Female">
                            </span>
                        </div>
                    </div>
                    <b style="font-size: 14px;">Remarks</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="REMARKS" value="@if(!empty($employeeInfo)){{ $employeeInfo->REMARKS }}@endif" class="chosen-container" placeholder="Remarks">
                            </span>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <b style="font-size: 14px;">Total Number of Technical Person </b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Male</label>
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="TOTMALETECH_PER" value="@if(!empty($employeeInfo)){{ $employeeInfo->TOTMALETECH_PER }}@endif" class="chosen-container TOTMALETECH_PER" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <label>Female</label>
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="TOTFEMTECH_PER" value="@if(!empty($employeeInfo)){{ $employeeInfo->TOTFEMTECH_PER }}@endif" class="chosen-container TOTFEMTECH_PER" placeholder="Female">
                            </span>
                        </div>
                    </div>

                    <b style="font-size: 14px;">Total Number of Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Male</label>
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="TOTMALE_EMP" onkeypress="return numbersOnly(this, event)" value="@if(!empty($employeeInfo)){{ $employeeInfo->TOTMALE_EMP }}@endif" class="chosen-container TOTMALE_EMP" readonly placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <label>Female</label>
                            <span class="block input-icon input-icon-right">
                               <input autocomplete="off" type="text" name="TOTFEM_EMP" onkeypress="return numbersOnly(this, event)" value="@if(!empty($employeeInfo)){{ $employeeInfo->TOTFEM_EMP }}@endif" class="chosen-container TOTFEM_EMP" readonly placeholder="Female">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="clearfix">
                    <div class="col-md-12 center">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{--{{ trans('dashboard.submit') }}--}}
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // For Employee Calculations Start
        $(document).on('keyup', '.FULLTIMEMALE_EMP, .FULLTIMEFEM_EMP, .TOTMALETECH_PER, .TOTFEMTECH_PER, .PARTTIMEMALE_EMP, .PARTTIMEFEM_EMP', function () {
            employeeCalculation();
        });
        function employeeCalculation() {
            let fullTimeMale = parseInt($('.FULLTIMEMALE_EMP').val() || 0);
            let fullTimeFemale = parseInt($('.FULLTIMEFEM_EMP').val() || 0);

            let techMale = parseInt($('.TOTMALETECH_PER').val() || 0);
            let techFemale = parseInt($('.TOTFEMTECH_PER').val() || 0);

            let partMale = parseInt($('.PARTTIMEMALE_EMP').val() || 0);
            let partFemale = parseInt($('.PARTTIMEFEM_EMP').val() || 0);

            let totalMale = fullTimeMale + techMale + partMale;
            let totalFemale = fullTimeFemale + techFemale + partFemale;
            // console.log(totalMale, totalFemale);

            $('.TOTMALE_EMP').val(totalMale)
            $('.TOTFEM_EMP').val(totalFemale)
        }
        // For Employee Calculations End
    });
</script>

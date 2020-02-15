<div id="employee" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/employee-info') }}" data-clear="false" method="post" class="form-horizontal" role="form" >
                @csrf
                <input type="hidden" class="insertIdContainer" value="" name="MILL_ID">
                <div class="col-md-6">
                    <b style="font-size: 14px;">Total Number of Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTMALE_EMP" class="chosen-container" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTFEM_EMP" class="chosen-container" placeholder="Female">
                            </span>
                        </div>
                    </div>

                    <b style="font-size: 14px;">Part Time Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="PARTTIMEMALE_EMP" class="chosen-container" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="PARTTIMEFEM_EMP" class="chosen-container" placeholder="Female">
                            </span>
                        </div>
                    </div>
                    <b style="font-size: 14px;">Remarks</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="REMARKS" class="chosen-container" placeholder="Male">
                            </span>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <b style="font-size: 14px;">Full Time Employee</b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="FULLTIMEMALE_EMP" class="chosen-container" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="FULLTIMEFEM_EMP" class="chosen-container" placeholder="Female">
                            </span>
                        </div>
                    </div>
                    <b style="font-size: 14px;">Total Number of Technical Person </b> <br><br>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTMALETECH_PER" class="chosen-container" placeholder="Male">
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="TOTFEMTECH_PER" class="chosen-container" placeholder="Female">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 30%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{ trans('dashboard.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
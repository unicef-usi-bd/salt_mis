<div class="col-md-12">
    <form action="{{ url('/monitoring') }}" method="post" class="form-horizontal" role="form">
        @csrf
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Agency Name</b><span style="color: red;">* </span></label>
            <div class="col-sm-8">
            <span class="block input-icon input-icon-right">
                <select id="inputSuccess" class="form-control" name="AGENCY_ID">
                    <option>-Select-</option>
                    @foreach($agencyList as $agency)
                        <option value="{{ $agency->LOOKUPCHD_ID }}">{{ $agency->LOOKUPCHD_NAME }}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right"><b>Monitoring Date</b><span style="color: red;"> *</span> </label>
            <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <input type="date" name="MOMITOR_DATE"  class="form-control" value=""/>
                    </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b></label>
            <div class="col-sm-8">
                {{--<textarea class="form-control" rows="5" style="height:50%;" id="inputSuccess DESCRIPTION form-field-8" name="REMARKS" placeholder="Description"></textarea>--}}
                <input type="text" name="REMARKS" class="form-control" value="" placeholder="Example:- Remarks Here"/>
            </div>
        </div>

        <hr>
        <div class="clearfix">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    {{ trans('dashboard.reset') }}
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    {{ trans('dashboard.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>

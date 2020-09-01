<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>

<div class="row">
    <form action="{{ url('/extended-date-update') }}" method="post" class="form-horizontal" role="form">
     @csrf
        <div class="col-md-12">
            <input type="hidden" name="MILL_ID" class="extendMillerId" value="{{$millInfo->MILL_ID}}">
            <div class="col-md-12">
                <div class="col-md-7 form-group text-right">
                    <label  class="col-sm-6 control-label no-padding-right" for="form-field-1-1"> <b>Extended Date</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-4">
                        <input autocomplete="off" type="text" readonly name="renewing_date"  class="expireDate date-picker" value="{{ date('m/d/Y') }}"/>
                    </div>
                </div>
                <div class="col-md-4 form-group">
                    <button type="button" class="btn btn-primary" onclick="formSubmit(this.form)">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        {{ trans('dashboard.submit') }}
                    </button>
                </div>

            </div>

        </div>
    </form>
</div>
<hr>

@include('masterGlobal.datePicker')
@include('masterGlobal.ajaxFormSubmit')


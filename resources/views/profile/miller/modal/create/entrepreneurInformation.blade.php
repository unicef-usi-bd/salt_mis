<style>
    th, td{
        min-width: 120px;
    }
</style>
<div id="entrepreneur" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/entrepreneur-info') }}" data-clear="false" method="post" class="form-horizontal" role="form">
                @csrf
                <input type="hidden" class="insertIdContainer" value="" name="MILL_ID">
                <div class="scroll-div">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Owner Name<span style="color:red;"> *</span></th>
                            <th>Division<span style="color:red;"> </span></th>
                            <th>District</th>
                            <th>Upazila</th>
                            {{--<th style="width: 130px100px;">Union</th>--}}
                            <th >NID</th>
                            <th>Mobile 1</th>
                            <th >Mobile 2</th>
                            <th >Email</th>
                            <th >Remarks</th>
                            <th class="addButton"><span class="btn btn-primary btn-sm center rowAdd"><i class="fa fa-plus"></i></span></th>
                        </tr>
                        </thead>
                        <tbody class="newRow">
                        <tr class="rowFirst">
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="OWNER_NAME[]" value="" class="width-100 OWNER_NAME"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select division" name="DIVISION_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($getDivision as $row)
                                            <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select district" name="DISTRICT_ID[]"  >
                                        <option value="">Select</option>
                                     </select>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select upazila" name="UPAZILA_ID[]"  >
                                        <option value="">Select</option>
                                    </select>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="NID[]" onkeypress="return numbersOnly(this, event)" value="" class="width-100 NID"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_1[]" onkeypress="return numbersOnly(this, event)" value="" class="width-100 MOBILE_1"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_2[]" onkeypress="return numbersOnly(this, event)" value="" class="width-100 MOBILE_2"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="EMAIL[]" value="" class="width-100 EMAIL"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" value="" class="width-100 REMARKS"  />
                                </span>
                            </td>
                            <th class="removeButton"><span class="btn btn-danger btn-sm center rowRemove"><i class="fa fa-remove"></i></span></th>
                        </tr>
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
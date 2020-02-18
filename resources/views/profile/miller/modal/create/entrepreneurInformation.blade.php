<div id="entrepreneur" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/entrepreneur-info') }}" data-clear="false" method="post" class="form-horizontal" role="form">
                @csrf
                <input type="hidden" class="insertIdContainer" value="" name="MILL_ID">

                <table class="table table-bordered" style="margin-top: 64px;">
                    <thead>
                        <tr>
                            <th style="width:130px ;">Owner Name<span style="color:red;"> *</span></th>
                            <th style="width:130px ;">Division<span style="color:red;"> </span></th>
                            <th style="width: 130px;">District</th>
                            <th style="width: 130px;">Upazila</th>
                            {{--<th style="width: 130px100px;">Union</th>--}}
                            <th style="width: 130px;" >NID</th>
                            <th style="width: 130px;">Mobile 1</th>
                            <th  style="width: 130px;">Mobile 2</th>
                            <th  style="width: 130px;">Email</th>
                            <th  style="width: 130px;">Remarks</th>
                            <th style="width: 130px;" class="addButton"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
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
                                    <input type="text" name="NID[]" value="" class="width-100 NID"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_1[]" value="" class="width-100 MOBILE_1"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_2[]" value="" class="width-100 MOBILE_2"  />
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
                            <td class="removeButton"><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                        </tr>
                    </tbody>
                </table>
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
<div id="entrepreneur" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/entrepreneur-info/'.$millerInfo->MILL_ID) }}" method="post" class="form-horizontal" role="form">
                @csrf
                @method('PUT')

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
                        @if(sizeof($entrepreneurs)>0)
                            @foreach($entrepreneurs as $entrepreneur)
                                <tr class="rowFirst">
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="OWNER_NAME[]" id="inputSuccess " value="{{ $entrepreneur->OWNER_NAME }}" class="width-100 OWNER_NAME" />
                                        </span>
                                        <input type="hidden" value="{{ $entrepreneur->ENTREPRENEUR_ID }}" name="ENTREPRENEUR_ID">
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <select class="form-control chosen-select DIVISION_ID" name="DIVISION_ID[]">
                                                <option value="">Select</option>
                                                @foreach($divisions as $row)
                                                    <option value="{{ $row->DIVISION_ID }}" @if($entrepreneur->DIVISION_ID==$row->DIVISION_ID) selected @endif >{{ $row->DIVISION_NAME }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <select class="form-control chosen-select ent_district" id="ENT_DISTRICT_ID" name="DISTRICT_ID[]"  >
                                                <option value="">Select</option>
                                                @foreach($districts as $row)
                                                    <option value="{{ $row->DISTRICT_ID }}" @if($entrepreneur->DISTRICT_ID == $row->DISTRICT_ID) selected @endif>{{ $row->DISTRICT_NAME }}</option>
                                                @endforeach
                                             </select>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <select class="form-control chosen-select ent_upazila" id="ENT_UPAZILA_ID" name="UPAZILA_ID[]"  >
                                                <option value=""> Select </option>
                                                @foreach($upazillas as $row)
                                                    <option value="{{ $row->UPAZILA_ID }}" @if($entrepreneur->UPAZILA_ID == $row->UPAZILA_ID) selected @endif>{{ $row->UPAZILA_NAME }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="NID[]" id="inputSuccess" value="{{ $entrepreneur->NID }}" class="width-100 NID" />
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="MOBILE_1[]" id="inputSuccess" value="{{ $entrepreneur->MOBILE_1 }}" class="width-100 MOBILE_1" />
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="MOBILE_2[]" id="inputSuccess" value="{{ $entrepreneur->MOBILE_2 }}" class="width-100 MOBILE_2" />
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="EMAIL[]" id="inputSuccess batch_no" value="{{ $entrepreneur->EMAIL }}" class="width-100 EMAIL" />
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="REMARKS[]" id="inputSuccess" value="{{ $entrepreneur->REMARKS }}" class="width-100 REMARKS" />
                                        </span>
                                    </td>
                                    <td class="removeButton"><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="OWNER_NAME[]" id="inputSuccess " value="" class="width-100 OWNER_NAME"  />
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select DIVISION_ID" id="ENT_DIVISION_ID" name="DIVISION_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($divisions as $row)
                                            <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select ent_district" id="ENT_DISTRICT_ID" name="DISTRICT_ID[]"  >
                                        <option value="">Select</option>
                                     </select>
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select ent_upazila" id="ENT_UPAZILA_ID" name="UPAZILA_ID[]"  >
                                        <option value=""> Select </option>
                                    </select>
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="NID[]" id="inputSuccess total_amount" value="" class="width-100 NID"  />
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_1[]" id="inputSuccess total_amount" value="" class="width-100 MOBILE_1"  />
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_2[]" id="inputSuccess total_amount" value="" class="width-100 MOBILE_2"  />
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="EMAIL[]" id="inputSuccess batch_no" value="" class="width-100 EMAIL"  />
                                    <input type="hidden" class="batch_disabled" disabled="disabled" name="batch_no[]" value="">
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" id="inputSuccess total_amount" value="" class="width-100 REMARKS"  />
                                </span>
                                </td>
                                <td class="removeButton"><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                            </tr>
                        @endif
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
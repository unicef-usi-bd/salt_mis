<style>
    th, td{
        min-width: 160px;
    }
</style>

<div id="entrepreneur" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/entrepreneur-info/'.$millerInfo->MILL_ID) }}" method="post" class="form-horizontal" role="form">
                @csrf
                @method('PUT')
                <div class=" scroll-div">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="custom-overflow">
                            <th>Owner Name<span style="color:red;"> *</span></th>
                            <th>Division<span style="color:red;"> </span></th>
                            <th>District</th>
                            <th>Upazila</th>
                            {{--<th style="width: 130px100px;">Union</th>--}}
                            <th>NID</th>
                            <th>Mobile 1</th>
                            <th>Mobile 2</th>
                            <th>Email</th>
                            <th>Remarks</th>
                            <th class="addButton"><span class="btn btn-primary btn-sm center rowAddEntrepreneur"><i class="fa fa-plus"></i></span></th>
                        </tr>
                        </thead>
                        <tbody class="newRow">
                        @if(sizeof($entrepreneurs)>0)
                            @foreach($entrepreneurs as $entrepreneur)
                                <tr class="rowFirst">
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="OWNER_NAME[]" value="{{ $entrepreneur->OWNER_NAME }}" class="width-100 OWNER_NAME" />
                                        </span>
                                        <input type="hidden" value="{{ $entrepreneur->ENTREPRENEUR_ID }}" name="ENTREPRENEUR_ID">
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <select class="form-control chosen-select division" name="DIVISION_ID[]">
                                                <option value="">Select</option>
                                                @foreach($divisions as $row)
                                                    <option value="{{ $row->DIVISION_ID }}" @if($entrepreneur->DIVISION_ID==$row->DIVISION_ID) selected @endif >{{ $row->DIVISION_NAME }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <select class="form-control chosen-select district" name="DISTRICT_ID[]"  >
                                                <option value="">Select</option>
                                                @foreach($districts as $row)
                                                    <option value="{{ $row->DISTRICT_ID }}" @if($entrepreneur->DISTRICT_ID == $row->DISTRICT_ID) selected @endif>{{ $row->DISTRICT_NAME }}</option>
                                                @endforeach
                                             </select>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <select class="form-control chosen-select upazila" name="UPAZILA_ID[]" >
                                                <option value=""> Select </option>
                                                @foreach($upazillas as $row)
                                                    <option value="{{ $row->UPAZILA_ID }}" @if($entrepreneur->UPAZILA_ID == $row->UPAZILA_ID) selected @endif>{{ $row->UPAZILA_NAME }}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="NID[]" onkeypress="return numbersOnly(this, event)" value="{{ $entrepreneur->NID }}" class="width-100 NID" />
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="MOBILE_1[]" onkeypress="return numbersOnly(this, event)" value="{{ $entrepreneur->MOBILE_1 }}" class="width-100 MOBILE_1" />
                                        </span>
                                    </td>
                                    <td>
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" name="MOBILE_2[]" id="inputSuccess" onkeypress="return numbersOnly(this, event)" value="{{ $entrepreneur->MOBILE_2 }}" class="width-100 MOBILE_2" />
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
                                    <th class="removeButton"><span class="btn btn-danger btn-sm center rowRemove"><i class="fa fa-remove"></i></span></th>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="OWNER_NAME[]" value="" class="width-100 OWNER_NAME"  />
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select division" name="DIVISION_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($divisions as $row)
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
                                        <option value=""> Select </option>
                                    </select>
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="NID[]" value="" onkeypress="return numbersOnly(this, event)" class="width-100 NID"  />
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_1[]"  onkeypress="return numbersOnly(this, event)" value="" class="width-100 MOBILE_1"  />
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_2[]"  onkeypress="return numbersOnly(this, event)" value="" class="width-100 MOBILE_2"  />
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="EMAIL[]" value="" class="width-100 EMAIL"  />
                                    <input type="hidden" class="batch_disabled" disabled="disabled" name="batch_no[]" value="">
                                </span>
                                </td>
                                <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" value="" class="width-100 REMARKS"  />
                                </span>
                                </td>
                                <th class="removeButton"><span class="btn btn-danger btn-sm center rowRemove"><i class="fa fa-remove"></i></span></th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="clearfix">
                    <div class="col-md-12 center">
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
<script>
    $(document).ready(function(){
        $('.rowAddEntrepreneur').click(function(){
            let getTr = $('tr.rowFirst:first');
//            alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            let defaultRow = $('tr.removableRow:last');
            defaultRow.find(' input.OWNER_NAME').attr('disabled', false);
            defaultRow.find('select.DIVISION_ID').prop('disabled', false);
            defaultRow.find('select.DISTRICT_ID').prop('disabled', false);
            defaultRow.find('select.UPAZILA_ID').prop('disabled', false);
            defaultRow.find('select.UNION_ID').prop('disabled', false);
//            For Ignore array Conflict
            defaultRow.find('input.NID').attr('NID', false);
            defaultRow.find('input.MOBILE_1').attr('MOBILE_1', false);
            defaultRow.find('input.MOBILE_2').attr('disabled', false);
            defaultRow.find('input.EMAIL').attr('disabled', false);
            defaultRow.find('input.REMARKS').attr('disabled', false);
            defaultRow.find('.chosen-select').val('').trigger('chosen:updated');
            defaultRow.find('input').val('');
        });
    });
</script>
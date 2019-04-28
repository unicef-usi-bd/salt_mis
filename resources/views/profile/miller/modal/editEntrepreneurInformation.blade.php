<div id="entrepreneur_tab" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info entrepreneur_msg"></div>


            <form id="entrepreneurId"  class="form-horizontal" role="form" >

                @csrf
                @if(isset($millerInfoId))
                    <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID">
                @endif
                {{--<div class="col-md-6">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Registration Type</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select id="REG_TYPE_ID" class="chosen-select chosen-container" name="REG_TYPE_ID" data-placeholder="Select or search data">--}}
                                   {{--<option value=""></option>--}}
                                    {{--@foreach($registrationType as $row)--}}
                                       {{--<option value="{{ $row->LOOKUPCHD_ID }}" @if($editEntrepData->REG_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                   {{--@endforeach--}}

                               {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}

                {{--<div class="col-md-6">--}}

                    {{--<div class="form-group" >--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Owner</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                                {{--<select id="OWNER_TYPE_ID" name="OWNER_TYPE_ID" class="chosen-select chosen-container" data-placeholder="Select or search data">--}}
                                    {{--<option value=""></option>--}}
                                    {{--@foreach($ownerType as $row)--}}
                                        {{--<option value="{{ $row->LOOKUPCHD_ID }}" @if($editEntrepData->OWNER_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                    {{--@endforeach--}}

                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}


                <table class="table table-bordered fundAllocation" style="margin-top: 64px;">
                    <thead>
                    <tr>
                        <th style="width:130px ;">Owner Name<span style="color:red;"> *</span></th>
                        <th style="width:130px ;">Division<span style="color:red;"> </span></th>
                        <th style="width: ;">District</th>
                        <th style="width: ;">Upazila</th>
                        <th style="width: 100px;">Union</th>
                        <th style="width: ;" >NID</th>
                        <th style="width: ;">Mobile 1</th>
                        <th  style="width: ;">Mobile 2</th>
                        <th  style="width: ;">Email</th>
                        <th  style="width: ;">Remarks</th>
                        <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAddEntp"><i class="fa fa-plus"></i></span></th>
                    </tr>
                    </thead>
                    <tbody class="newRowEntp">
                    @foreach($getEntrepreneurRowData as $editEntrepData)
                        <tr class="rowFirstEntp">
                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="OWNER_NAME[]" id="inputSuccess " value="{{ $editEntrepData->OWNER_NAME }}" class="width-100 OWNER_NAME"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select DIVISION_ID" id="ENT_DIVISION_ID" name="DIVISION_ID[]"  >
                                        <option value="">Select</option>
                                        @foreach($getDivision as $row)
                                            <option value="{{$row->DIVISION_ID}}" @if($editEntrepData->DIVISION_ID==$row->DIVISION_ID) selected @endif> {{$row->DIVISION_NAME}}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select ent_district" id="ENT_DISTRICT_ID" name="DISTRICT_ID[]"  >
                                        <option value="{{ $editEntrepData->DISTRICT_ID }}">{{ $editEntrepData->DISTRICT_NAME }}</option>
                                     </select>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control chosen-select ent_upazila" id="ENT_UPAZILA_ID" name="UPAZILA_ID[]"  >
                                        <option value="{{ $editEntrepData->DISTRICT_ID }}">{{ $editEntrepData->DISTRICT_NAME }}</option>
                                    </select>
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <select class="form-control ent_union" id="UNION_ID" name="UNION_ID[]"  >
                                        <option value="{{ $editEntrepData->DISTRICT_ID }}">{{ $editEntrepData->DISTRICT_NAME }}</option>
                                    </select>
                                </span>
                            </td>
                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="NID[]" id="inputSuccess total_amount" value="{{ $editEntrepData->NID }}" class="width-100 NID"  />
                                </span>
                            </td>
                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_1[]" id="inputSuccess total_amount" value="{{ $editEntrepData->MOBILE_1 }}" class="width-100 MOBILE_1"  />
                                </span>
                            </td>
                            <td>
                                <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="MOBILE_2[]" id="inputSuccess total_amount" value="{{ $editEntrepData->MOBILE_2 }}" class="width-100 MOBILE_2"  />
                                </span>
                            </td>
                            <td>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="EMAIL[]" id="inputSuccess batch_no" value="{{ $editEntrepData->EMAIL }}" class="width-100 EMAIL"  />
                                    {{--<input type="hidden" class="batch_disabled" disabled="disabled" name="batch_no[]" value="">--}}
                                </span>
                            </td>
                            <td>
                                <span class="budget_against_code "><!-- Drop Total Budget here By Ajax --></span>
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="REMARKS[]" id="inputSuccess total_amount" value="{{ $editEntrepData->REMARKS }}" class="width-100 REMARKS"  />
                                </span>
                            </td>
                            <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 44%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="button" class="btn btn-success btnUpdateEntrepreneur" onclick="entrepreneurTab()">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Update & Next
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        $('.entrepreneur_msg').hide();
        $(document).on('click','.btnUpdateEntrepreneur',function () {
            $.ajax({
                type : 'POST',
                url : 'edit-entrepreneur-info',
                data : $('#entrepreneurId').serialize(),
                success: function (data) {
                    console.log(data);
                    $('.entrepreneur_msg').html('<span>'+ data +'</span>').show();

                    setTimeout(function() { $(".entrepreneur_msg").hide(); }, 3000);

                }
            })
        })
    </script>


<script>

</script>

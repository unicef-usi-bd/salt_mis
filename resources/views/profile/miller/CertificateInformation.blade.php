<div id="certificate" class="tab-pane fade">
    <div class="row">
        <div class="col-md-12">

            <form action="{{ url('/certificate-info') }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered fundAllocation" style="margin-top: 64px;">
                    <thead>
                    <tr>
                        <th style="width:175px ;">Type of Certificate<span style="color:red;"> </span></th>
                        <th style="width:130px ;">Issure Name<span style="color:red;"> </span></th>
                        <th style="width:140px ;">Issuing Date</th>
                        <th style="width:150px ;">Certificate Number</th>
                        <th style="width: 260px;">Trade License</th>
                        <th style="width:140px;" >Renewing Date</th>
                        <th  style="width:140px ;">Remarks</th>
                        <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                    </tr>
                    </thead>
                    <tbody class="newRow">
                    <tr class="rowFirst">

                        <td>
                            <span class="block input-icon input-icon-right">
                                <select class="form-control chosen-select DIVISION_ID" id="CERTIFICATE_TYPE_ID" name="CERTIFICATE_TYPE_ID[]"  >
                                    <option value="">Select</option>
                                    @foreach($getDivision as $row)
                                        <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                    @endforeach
                                </select>
                            </span>
                        </td>
                        <td>
                            <span class="block input-icon input-icon-right">
                                <select class="form-control chosen-select ent_district" id="ISSURE_ID" name="ISSURE_ID[]"  >
                                    <option value="">Select</option>
                                    @foreach($getDivision as $row)
                                        <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                    @endforeach
                                 </select>
                            </span>
                        </td>
                        <td>
                            <span class="block input-icon input-icon-right">
                                <input type="date" name="ISSUING_DATE" class="chosen-container">
                            </span>
                        </td>

                        <td>
                            <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                            <span class="block input-icon input-icon-right">
                                <input type="text" name="CERTIFICATE_NO[]" id="inputSuccess total_amount" value="" class="width-100 NID"  />
                            </span>
                        </td>
                        <td>
                            <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                            <span class="block input-icon input-icon-right">
                                <input type="file" name="TRADE_LICENSE" class="chosen-container" multiple>
                            </span>
                        </td>
                        <td>
                            <span class="budget_against_code hidden"><!-- Drop Total Budget here By Ajax --></span>
                            <span class="block input-icon input-icon-right">
                               <input type="date" name="RENEWING_DATE" class="chosen-container">
                            </span>
                        </td>

                        <td>
                            <span class="budget_against_code "><!-- Drop Total Budget here By Ajax --></span>
                            <span class="block input-icon input-icon-right">
                                <input type="text" name="REMARKS[]" id="inputSuccess total_amount" value="" class="width-100 REMARKS"  />
                            </span>
                        </td>
                        <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                    </tr>
                    </tbody>
                </table>
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
    </div>
</div>
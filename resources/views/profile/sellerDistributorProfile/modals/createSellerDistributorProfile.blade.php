<div class="col-md-12">
    <form action="{{ url('/seller-distributor-profile') }}" method="post" class="form-horizontal" role="form">
        @csrf
        {{--@if($costCenterTypeId != Auth::user()->cost_center_type)--}}
    <div class="col-md-6">
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Seller Type</b><span style="color: red;"> </span></label>
            <div class="col-sm-8">
        <span class="block input-icon input-icon-right">
            <select id="form-field-select-3 inputSuccess SELLER_TYPE_ID" class="chosen-select form-control" name="SELLER_TYPE_ID" data-placeholder="Select or search data">
               <option value="">-Select-</option>
                @foreach($sellerType as $seller)
                <option value="{{$seller->LOOKUPCHD_ID}}" @if($seller->LOOKUPCHD_ID == 7) selected @endif> {{$seller->LOOKUPCHD_NAME}}</option>
                @endforeach
            </select>
        </span>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Seller Id</b><span style="color: red;"> </span> </label>
            <div class="col-sm-8">
                <input autocomplete="off" type="text" id="inputSuccess SELLER_ID" placeholder="Example: Auto Generate" name="SELLER_ID" class="insertIdContainer form-control col-xs-10 col-sm-5" value="{{ $sellerId }}" readonly/>
            </div>
        </div>
    </div>
      <div class="row">
          <div class="col-md-12">
              <div class="col-md-3">
                  <label class="col-sm-12"> <b>Trading Name</b><span style="color: red;">*</span> </label>
                  <div class="col-sm-12">
                      <input autocomplete="off" type="text" id="inputSuccess TRADING_NAME" placeholder="Example: Trading Name here" name="TRADING_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                  </div>
              </div>
              <div class="col-md-3">
                  <label class="col-sm-12"> <b>Trader Name</b><span style="color: red;">*</span> </label>
                  <div class="col-sm-12">
                      <input autocomplete="off" type="text" id="inputSuccess TRADER_NAME" placeholder="Example: Trader Name" name="TRADER_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                  </div>
              </div>
              <div class="col-md-3">
                  <label class="col-sm-12" > <b>Trade Licence no</b><span style="color: red;"> </span> </label>
                  <div class="col-sm-12">
                      <input autocomplete="off" type="text" id="inputSuccess LICENCE_NO" placeholder="Example: Trade Licence no here" name="LICENCE_NO" class="form-control col-xs-10 col-sm-5" value=""/>
                  </div>
              </div>
              <div class="col-md-3">
                  <label class="col-sm-12" > <b>Phone Number</b><span style="color: red;"> *</span> </label>
                  <div class="col-sm-12">
                      <input autocomplete="off" type="text" id="inputSuccess PHONE" placeholder="Example: Phone Number here" name="PHONE" class="form-control col-xs-10 col-sm-5" value=""/>
                  </div>
              </div>
          </div>
      </div>


        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="col-md-3">
                    <label class="col-sm-12"><b>Division</b><span style="color: red;"> *</span></label>
                    <div class="col-xs-12">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control chosen-select division" name="DIVISION_ID" data-placeholder="Select or search data">
                            <option value="">-Select-</option>
                            @foreach($getDivision as $row)
                                <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                            @endforeach
                        </select>
                    </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="col-sm-12" ><b>District</b><span style="color: red;"> *</span></label>
                    <div class="col-sm-12">
                    <span class="block input-icon input-icon-right">
                        <select class="chosen-select form-control district" name="DISTRICT_ID" data-placeholder="Select or search data">
                           <option value=""></option>

                        </select>
                    </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <label  class="col-sm-12"  style="margin-left: -2%;"><b>Thana/Upazilla</b><span style="color: red;"> *</span></label>
                    <div class="col-xs-12">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control chosen-select upazila" name="THANA_ID" data-placeholder="Select or search data">
                            <option value="">-Select-</option>
                         </select>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12 col-md-offset-2">
                <div class="col-md-4">
                    <label class="col-sm-12" > <b>Bazar</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-12">
                        <input autocomplete="off" type="text" id="inputSuccess BAZAR_NAME" placeholder="Example: Bazar  here" name="BAZAR_NAME" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="col-sm-12"  style="margin-left: -2%;"> <b>Email</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-12">
                        <input autocomplete="off" type="text" id="inputSuccess EMAIL" placeholder="Example: Email here" name="EMAIL" class="form-control col-xs-10 col-sm-5" value=""/>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12" style="margin-top: 15px;">
            <h4  style="color: #1B6AAA;">Coverage Area</h4>
            <hr>
            <table class="table table-bordered fundAllocation">
                <thead>
                <tr>
                    <th style="width: 255px;">Division<span style="color:red;"> </span></th>
                    <th style="width: 255px;">District<span style="color:red;"> </span></th>
                    <th style="width: 255px;">Thana/Upazilla</th>
                    {{--<th style="width: 150px;">Problem</th>--}}

                    <th style="width: 30px;"><span class="btn btn-primary btn-sm pull-right rowAdd"><i class="fa fa-plus"></i></span></th>
                </tr>
                </thead>
                <tbody class="newRow">
                <tr class="rowFirst">
                    <td>
                        <span class="block input-icon input-icon-right">
                            <select class="form-control chosen-select division" name="COV_DIVISION_ID[]">
                                <option value="">-Select-</option>
                                @foreach($getDivision as $row)
                                    <option value="{{$row->DIVISION_ID}}"> {{$row->DIVISION_NAME}}</option>
                                @endforeach
                            </select>
                        </span>
                    </td>
                    <td>
                        <span class="block input-icon input-icon-right">
                            <select class="chosen-select form-control district" name="COV_DISTRICT_ID[]" data-placeholder="Select or search data">

                            </select>
                        </span>
                    </td>
                    <td>
                        <span class="block input-icon input-icon-right">
                        <select class="form-control chosen-select upazila" name="COV_THANA_ID[]" data-placeholder="Select or search data">
                            <option value="">-Select-</option>
                         </select>
                    </span>
                    </td>

                    <td><span class="btn btn-danger btn-sm pull-right rowRemove"><i class="fa fa-remove"></i></span></td>
                </tr>
                </tbody>
            </table>
        </div>
      <div class="col-md-12">
          <div class="form-group">
              <label class="col-sm-1 control-label no-padding-right" for="form-field-1-1"> <b>Remarks</b><span style="color: red;"> </span> </label>
              <div class="col-sm-8">
                  <textarea style="width: 139%" rows="3"  placeholder="Example: Remarks here" name="REMARKS" class="form-control col-xs-10 col-sm-5"></textarea>
              </div>
          </div>
      </div>

        <div class="clearfix" style="margin-left: 150px;">
            <div class="col-md-offset-3 col-md-9">
                <button type="reset" class="btn test">
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

@include('masterGlobal.chosenSelect')
@include('masterGlobal.locationMapping')
<script>
    //    Add For Multiple Row Dynamically
    $(document).ready(function(){
        $('.rowAdd').click(function(){
            let getTr = $('tr.rowFirst:first');
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            $('tr.removableRow:last');
            $('.chosen-select').chosen(0);
        });
    });
    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        $(this).closest("tr.removableRow").remove();
    });

</script>



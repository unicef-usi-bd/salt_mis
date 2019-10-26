<style>
    .my-error-class {
        color:red;
    }
</style>
@php $districtUrl = url('supplier-profile/get-district/{id}'); @endphp
<div id="mill" class="tab-pane fade ">
    <div class="row">
        <div class="col-md-12">

            <div class="alert alert-info millInfo_msg" style="display: none;"></div>

            {{--<form id="millId"  class="form-horizontal" role="form" action="{{ url('edit-mill-info') }}" >--}}
            <form id="millId"  class="form-horizontal myform" role="form" enctype="multipart/form-data">
                {{--<form id="millId"  class="form-horizontal" role="form" action="{{ url('update-mill-information') }}" >--}}
                <input type="hidden" value="{{ $millerInfoId }}" name="MILL_ID" class="millerInfoId" >
                @csrf

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Name of Mill</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="MILL_NAME" class="chosen-container mill required" value="{{ $editMillData->MILL_NAME }}" required="required">
                                <span style="color:red;display:none;" class="error1">This field is required</span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Process Type</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="REG_TYPE_ID" class="required chosen-container" name="PROCESS_TYPE_ID" data-placeholder="Select" required>
                                   <option value="">Select</option>
                                    @foreach($processType as $row)
                                       <option value="{{ $row->LOOKUPCHD_ID }}" @if($editMillData->PROCESS_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach
                               </select>
                                <span style="color:red;display:none;" class="error">This field is required</span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Mill</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select disabled="true" id="MILL_TYPE_IDD" class="required chosen-container" name="MILL_TYPE_ID" data-placeholder="Select" required>
                                   <option value=""></option>
                                    @foreach($millType as $row)
                                       <option  value="{{ $row->UD_ID }}" @if($editMillData->MILL_TYPE_ID==$row->UD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach

                               </select>
                            </span>
                        </div>
                    </div>
                    {{--to update type of mill  remove disabled="true" --}}
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Capacity</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" name="CAPACITY_ID" class="chosen-container CAPACITY_ID" value="{{ $editMillData->CAPACITY_ID }}">
                                    <span style="color:red;display:none;" class="error">This field is required</span>
                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Zone</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                                <span class="block input-icon input-icon-right">
                                   <select disabled="true" id="ZONE_IDD" class="chosen-container" name="ZONE_ID" data-placeholder="Select" required>
                                       <option value=""></option>
                                        @foreach($getZone as $row)
                                           <option value="{{ $row->ZONE_CODE }}" @if($editMillData->ZONE_ID==$row->ZONE_CODE) selected @endif>{{ $row->ZONE_NAME }}</option>
                                       @endforeach

                                   </select>
                                </span>
                        </div>
                    </div>
                    {{--to update  zone  code remove disabled="true" --}}
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Millers ID</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input readonly type="text" name="MILLERS_ID" class="chosen-container millersIdd" value="{{ $editMillData->MILLERS_ID }}">
                            </span>
                        </div>
                    </div>



                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Miller Logo</b></label>
                        <div class="col-sm-8">
                            <input type="file" id="mill_logo" name="mill_logo" class="form-control col-xs-10 col-sm-5 user_image" value=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b> Type Of Owner</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select name="OWNER_TYPE_ID" class="chosen-select chosen-container OWNER_TYPE_ID" data-placeholder="Select or search data">
                                <option value=""></option>
                                   @foreach($ownerType as $row)
                                       <option value="{{ $row->LOOKUPCHD_ID }}" @if($editMillData->OWNER_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach

                            </select>
                            </span>
                        </div>
                    </div>

                    <div class="form-group" >
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Division</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                                <select id="DIVISION_ID_MILL" name="DIVISION_ID" class="chosen-select chosen-container division" url="{{ url('supplier-profile/get-district') }}" data-placeholder="Select">
                                    <option value=""></option>
                                    @foreach($getDivision as $row)
                                        <option value="{{ $row->DIVISION_ID }}" @if($editMillData->DIVISION_ID==$row->DIVISION_ID) selected @endif>{{ $row->DIVISION_NAME }}</option>
                                    @endforeach

                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>District</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="DISTRICT_ID_MILL" class="chosen-select chosen-container district_mill" name="DISTRICT_ID" url="{{ url('supplier-profile/get-upazila') }}" data-placeholder="Select">
{{--                                   <option value="{{ $editMillData->DISTRICT_ID }}">{{ $editMillData->DISTRICT_NAME }}</option>--}}
                                   @foreach($getDistrict as $row)
                                       <option value="{{ $row->DISTRICT_ID }}" @if($editMillData->DISTRICT_ID ==$row->DISTRICT_ID) selected @endif>{{ $row->DISTRICT_NAME }}</option>
                                   @endforeach

                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Upazila</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="UPAZILA_ID_MILL" class="chosen-select chosen-container upazila_mill" name="UPAZILA_ID" url="{{ url('supplier-profile/get-union') }}" data-placeholder="Select">
{{--                                   <option value="{{ $editMillData->UPAZILA_ID }}">{{ $editMillData->UPAZILA_NAME }}</option>--}}
                                   @foreach($getUpazilla as $row)
                                       <option value="{{ $row->UPAZILA_ID }}" @if($editMillData->UPAZILA_ID ==$row->UPAZILA_ID) selected @endif>{{ $row->UPAZILA_NAME }}</option>
                                   @endforeach

                               </select>
                            </span>
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Union</b></label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<span class="block input-icon input-icon-right">--}}
                               {{--<select id="UNION_ID_MILL" class="chosen-select chosen-container union_mill" name="UNION_ID" data-placeholder="Select">--}}
                                   {{--<option value="{{ $editMillData->UNION_ID }}">{{ $editMillData->UNION_NAME }}</option>--}}
                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status</b><span style="color: red">*</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="ACTIVE_FLG" class="chosen-select chosen-container" name="ACTIVE_FLG" data-placeholder="Select">
                                       @if(isset($editMillData))
                                       <option value="1" @if($editMillData->ACTIVE_FLG=='1') selected  @endif >Active</option>
                                       <option value="0" @if($editMillData->ACTIVE_FLG=='0') selected  @endif >Inactive</option>
                                   @else
                                       <option value="1">Active</option>
                                       <option value="0">Inactive</option>
                                   @endif
                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Remarks</b></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">

                               <input type="text" name="REMARKS" value="{{ $editMillData->REMARKS }}" class="chosen-container">
                            </span>
                        </div>
                    </div>

                </div>

                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 44%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="submit" class="btn btn-primary btnUpdateMillInfo" onclick="millTab()">
                        {{--<button type="submit" class="btn btn-primary btnUpdateMillInfo" onclick="millTab()">--}}
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Update & Next
                        </button>
                    </div>
                </div>
            </form>
        </div> {{--col-md-12--}}
    </div>
</div>

{{--for Mill on change division --}}
<script>
    $(document).ready(function () {
        $('select#DIVISION_ID_MILL').on('change',function(){
            var divisionId = $(this).val(); //alert(divisionId);//exit();
            var option = '<option value="">Select District</option>';
            var url = $(this).attr('url');
            var url = url+'/'+divisionId;

            $.ajax({
                type : "GET",
                url  : url,
                data : {'divisionId': divisionId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                    }
                    $('.district_mill').html(option);
                    $('.district_mill').trigger("chosen:updated");
                }
            });
        });
    });

    $(document).ready(function () {
        $('select#DISTRICT_ID_MILL').on('change',function(){
            var districtId = $(this).val(); //alert(districtId); exit();
            var option = '<option value="">Select Upazila</option>';
            var url = $(this).attr('url');
            $.ajax({
                type : "GET",
                url  : url+'/'+districtId,
                data : {'districtId': districtId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                    }
                    $('.upazila_mill').html(option);
                    $('.upazila_mill').trigger("chosen:updated");
                }
            });
        });
    });

    $(document).ready(function () {
        $('#UPAZILA_ID_MILL').on('change',function(){
            var upazilaId = $(this).val(); //alert(upazilaId);exit();
            var option = '<option value="">Select Union</option>';
            var url = $(this).attr('url');
            $.ajax({
                type : "get",
                url  : url+'/'+upazilaId,
                data : {'upazilaId': upazilaId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UNION_ID +'">'+ data[i].UNION_NAME+'</option>';
                    }
                    $('.union_mill').html(option);
                    $('.union_mill').trigger("chosen:updated");
                }
            });
        });
    });


    //   validation
    $(document).ready(function() {
        $('input[type="text"]').keyup(function() {
            if($(this).val() != '') {
                $(':input[type="button"]').prop('disabled', false);
                $('span.error1').hide();
            }else {
                $(':input[type="button"]').prop('disabled', true);
                $('span.error1').show();
            }
        });

        $('select.required').on('change', function () {
            var thisInput = $(this).closest('.block');
            var status = true;
            $('select.required').each(function () {
                if($(this).val()===""){
                    status = false;
                }
            });
            if(status===true){
                $(':input[type="button"]').prop('disabled', false);
            } else{
                $(':input[type="button"]').prop('disabled', true);
            }

            if(thisInput.find('.required').val()===""){
                thisInput.find('span.error').show();
            } else{
                thisInput.find('span.error').hide();
            }
        });

    });

    $('.OWNER_TYPE_ID').change(function() {
        //alert($('#textInput1').html());
        if( $(this).val() == 12 ) {
            //$('#textInput').prop( "disabled", true );
            $('.removeButton').addClass( 'hidden' );
            $('.addButton').addClass( 'hidden' );
        } else {
            //$('#textInput').prop( "disabled", false );
            $('.removeButton').removeClass( 'hidden' );
            $('.addButton').removeClass( 'hidden' );
        }
    });

    $(document).ready(function () {
        $('#millId').on('submit', function (e) {
            console.log(new FormData(this));
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ url('edit-mill-info') }}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (msg) {
                    $('.millInfo_msg').html(msg).show();
                }

            })
        });
    });
</script>

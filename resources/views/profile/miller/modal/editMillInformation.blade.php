<style>
    .my-error-class {
        color:red;
    }
    /*.my-valid-class {*/
    /*color:green;*/
    /*}*/
</style>
<div id="mill_tab" class="tab-pane fade in active">
    <div class="row">
        <div class="col-md-12">

            <div class="alert alert-info millmsg"></div>

            @if(request()->session()->get('MILL_ID'))
            <form id="millIdTemp"  class="form-horizontal myform" role="form" enctype="multipart/form-data">
            @else
            <form id="millId"  class="form-horizontal myform" role="form" enctype="multipart/form-data">

             @endif
               <input type="hidden" id="MILL_ID" value="{{ $millerInfoId }}" name="MILL_ID">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Name of Mill</b><span style="color:red;"> *</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <input type="text" name="MILL_NAME" class="chosen-container"  value="{{ $editMillData->MILL_NAME }}" required>
                                <span style="color:red;display:none;" class="error1">This field is required</span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Process Type</b><span style="color:red;"> *</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select id="PROCESS_TYPE_ID" class="chosen-select chosen-container required" name="PROCESS_TYPE_ID" data-placeholder="Select" required>
                                   <option value=""></option>
                                    @foreach($processType as $row)
                                       {{--<option value="{{ $row->LOOKUPCHD_ID }}">{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                       <option value="{{ $row->LOOKUPCHD_ID }}" @if($editMillData->PROCESS_TYPE_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach

                               </select>
                                <span style="color:red;display:none;" class="error">This field is required</span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Type of Mill</b><span style="color:red;"> *</span></label>
                       <input type="hidden" name="MILL_TYPE_ID" value="{{ $editMillData->MILL_TYPE_ID }}">
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               <select disabled="true" id="MILL_TYPE_IDD" class="chosen-select chosen-container" name="MILL_TYPE_ID" data-placeholder="Select">
                                   <option value=""></option>
                                    @foreach($millType as $row)
                                       <option value="{{ $row->UD_ID }}" @if($editMillData->MILL_TYPE_ID==$row->UD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>
                                   @endforeach

                               </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Capacity</b><span style="color:red;"> *</span></label>
                        <div class="col-sm-8">
                            <span class="block input-icon input-icon-right">
                               {{--<select id="REG_TYPE_ID" class="chosen-select chosen-container required" name="CAPACITY_ID" data-placeholder="Select">--}}
                                   {{--<option value=""></option>--}}
                                    {{--@foreach($capacity as $row)--}}
                                       {{--<option value="{{ $row->LOOKUPCHD_ID }}" @if($editMillData->CAPACITY_ID==$row->LOOKUPCHD_ID) selected @endif>{{ $row->LOOKUPCHD_NAME }}</option>--}}
                                   {{--@endforeach--}}

                               {{--</select>--}}
                                <input type="text" name="CAPACITY_ID" class="chosen-container CAPACITY_ID" value="{{ $editMillData->CAPACITY_ID }}">
                                <span style="color:red;display:none;" class="error">This field is required</span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Zone</b><span style="color:red;"> *</span></label>
                        <input type="hidden" name="ZONE_ID" value="{{ $editMillData->ZONE_ID }}">
                        <div class="col-sm-8">
                                <span class="block input-icon input-icon-right">
                                   <select disabled="true" id="ZONE_IDD" class="chosen-select chosen-container" name="ZONE_ID" data-placeholder="Select">
                                       <option value=""></option>
                                        @foreach($getZone as $row)
                                           <option value="{{ $row->ZONE_CODE }}" @if($editMillData->ZONE_ID==$row->ZONE_CODE) selected @endif>{{ $row->ZONE_NAME }}</option>
                                       @endforeach

                                   </select>
                                </span>
                        </div>
                    </div>
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
                            <input type="file" id="mill_logo" name="mill_logo" class="form-control col-xs-10 col-sm-5 user_image" value="" onchange="loadFile(event)"/>
                        </div>
                        <div style="margin-top: 40px; margin-left: 120px;">
                            <img id="output"  style="width: 50px;height: 50px;" src="{{ asset('/'.$editMillData->mill_logo) }}" />
                        </div>
                        <input type="hidden" name="mill_logo" value="{{ $editMillData->mill_logo }}">
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
                                <select id="DIVISION_IDD" name="DIVISION_ID" class="chosen-select chosen-container division" data-placeholder="Select">
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
                               <select id="DISTRICT_IDD" class="chosen-select chosen-container districtt" name="DISTRICT_ID" data-placeholder="Select">
                                   {{--<option value="{{ $editMillData->DISTRICT_ID }}">{{ $editMillData->DISTRICT_NAME }}</option>--}}
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
                               <select id="UPAZILA_IDD" class="chosen-select chosen-container upazilaa" name="UPAZILA_ID" data-placeholder="Select">
                                   {{--<option value="{{ $editMillData->UPAZILA_ID }}">{{ $editMillData->UPAZILA_NAME }}</option>--}}
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
                               {{--<select id="UNION_IDD" class="chosen-select chosen-container unionn" name="UNION_ID" data-placeholder="Select">--}}
                                   {{--<option value="{{ $editMillData->UNION_ID }}">{{ $editMillData->UNION_NAME }}</option>--}}
                                {{--</select>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status</b><span style="color:red;"> *</span></label>
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
                               {{--<input type="text" name="REMARKS" value="{{ $editMillData->REMARKS }}" class="chosen-container">--}}
                                <textarea rows="3" class="form-control col-sm-8" name="REMARKS">{{ $editMillData->REMARKS }}</textarea>
                            </span>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9" style="margin-left: 40%!important;">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        @if(isset($associationId))
                            {{--<button type="button" class="btn btn-success btnUpdateApprove" onclick="millTab()">--}}
                                {{--<i class="ace-icon fa fa-check bigger-110"></i>--}}
                                {{--Approve--}}
                            {{--</button>--}}
                            <button type="submit" class="btn btn-success btnUpdateMill" onclick="millTab()">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Update & Next
                            </button>
                        @else
                            @if($editMillData->approval_status == 0)
                                <button type="submit" class="btn btn-success btnUpdatetemMill" onclick="millTab()">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Update & Next
                                </button>
                            @else
                                <span style="color: red;font-size: 18px;margin-left: 5px;">Waiting for Association update your previous request</span>
                            @endif
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
//    $('.millmsg').hide();
//    $(document).on('click','.btnUpdateMill',function () {
//
//        $.ajax({
//            type : 'POST',
//            url : 'edit-mill-info',
//            data : $('#millId').serialize(),
//            success: function (data) {
//                console.log(data);
//                $('.millmsg').html('<span>'+ data +'</span>').show();
//                setTimeout(function() { $(".millmsg").hide(); }, 3000);
//
//            }
//        })
//    });

        $(document).ready(function () {
            $("#millId").on('submit',function (e) {

                //alert('hi');
                e.preventDefault();
                $.ajax({
                    type:'POST',
                    url:"edit-mill-info",
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success: function(msg) {
                    }
                })
            });


            $("#millIdTemp").on('submit',function (e) {

//                alert('hi');
                e.preventDefault();
                $.ajax({
                    type:'POST',
                    url:"edit-mill-info-temp",
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success: function(msg) {
                    }
                })
            })
        });

    $('.millmsg').hide();
//    $(document).on('click','.btnUpdatetemMill',function () {
    $("#millId").on('submit',function (e) {
//        alert('hi');
        e.preventDefault();
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            type : 'POST',
            url : 'edit-mill-info-tem',
            data : $('#millId').serialize(),
            success: function (data) {
                console.log(data);
                $('.millmsg').html('<span>'+ data +'</span>').show();
                setTimeout(function() { $(".millmsg").hide(); }, 3000);

            }
        })
    });



    $('.millmsg').hide();
    $(document).on('click','.btnUpdateApprove',function () {
        $.ajax({
            type : 'POST',
            url : 'edit-mill-info-approve',
           data : $('#millId').serialize(),
            success: function (data) {
                console.log(data);
                $('.millmsg').html('<span>'+ data +'</span>').show();
                setTimeout(function() { $(".millmsg").hide(); }, 3000);

            }
        })
    });



    $(document).ready(function () {

        $('form.myform').validate({ // initialize the plugin
            errorClass: "my-error-class",
            //validClass: "my-valid-class",
            rules: {
                MILL_NAME: {
                    required: true,

                },
                PROCESS_TYPE_ID: {
                    required: true,

                },
                CAPACITY_ID:{
                    required: true,

                },
                ACTIVE_FLG:{
                    required: true,
                }
            }
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
                $('input[type="button"]').prop('disabled', false);
            } else{
                $('input[type="button"]').prop('disabled', true);
            }

            if(thisInput.find('.required').val()===""){
                thisInput.find('span.error').show();
            } else{
                thisInput.find('span.error').hide();
            }
        });

    });

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };

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

</script>


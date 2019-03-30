@extends('master')

@section('mainContent')
    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                BSTI Test Standard
            </small>
        </h1>
    </div><!-- /.p -->

    <div class="col-md-12" style="margin-top: 50px;">
        <form action="{{ url('/bsti-test-standard') }}" method="post" class="form-horizontal" role="form" id="myform">
            @csrf
         <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Sodium Chloride</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input type="text" id="inputSuccess " placeholder="Example:- Sodium Chloride Percentage here" name="" class="form-control col-xs-10 col-sm-5" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>Moisturizer</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input type="number" id="inputSuccess" placeholder="Example:- Moisturizer Percentage here" name="" class="form-control col-xs-10 col-sm-5" />
                </div>
            </div>
         </div>
         <div class="col-md-6" style="margin-left: -125px;">
            <div class="form-group">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Iodine Content(PPM)</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input type="number" id="inputSuccess" placeholder="Example:- Iodine Content(PPM) here" name="" class="form-control col-xs-10 col-sm-5" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>PH</b><span style="color: red;"> *</span> </label>
                <div class="col-sm-7">
                    <input type="number" id="inputSuccess" placeholder="Example:- PH here" name="" class="form-control col-xs-10 col-sm-5" />
                </div>
            </div>
         </div>
            {{--<div class="form-group">--}}
                {{--<label for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Active Status </b></label>--}}
                {{--<div class="col-sm-8">--}}
            {{--<span class="block input-icon input-icon-right">--}}
                {{--<select id="inputSuccess ACTIVE_FLG" class="form-control" name="ACTIVE_FLG">--}}
                    {{--<option value="">Select One</option>--}}
                    {{--<option value="1" selected>Active</option>--}}
                    {{--<option value="0">Inactive</option>--}}
                {{--</select>--}}
            {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="clearfix" style="margin-left: 120px;">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success">
                        <i class="ace-icon fa fa-eye bigger-110"></i>
                        View
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="ace-icon fa fa-pencil bigger-110"></i>
                        Edit
                    </button>
                    {{--<button type="button" class="btn btn-success ajaxFormSubmit" data-action ="{{ 'lookup-groups-data' }}">--}}
                    <button type="submit" class="btn btn-primary submitBtn">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        {{ trans('dashboard.submit') }}
                    </button>
                </div>
            </div>
        </form>

        {{--<script>--}}
            {{--$(function(){--}}
                {{--$(".submitBtn").click(function () {--}}
                    {{--$(".submitBtn").attr("disabled", true);--}}
                    {{--$('#myform').submit();--}}
                {{--});--}}
            {{--});--}}
        {{--</script>--}}


    </div>



    <!--Sweet Alert Global Script Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.ajaxFormSubmit')
    <!-- Sweet Alert Global Script End -->


    <script type="text/javascript">


        //jquery accordion
        $( "#accordion" ).accordion({
            active: false,
            collapsible: true ,
            heightStyle: "content",
            animate: 250,
            header: ".accordion-header"
        }).sortable({
            axis: "y",
            handle: ".accordion-header",
            stop: function( event, ui ) {
                // IE doesn't register the blur when sorting
                // so trigger focusout handlers to remove .ui-state-focus
                ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
            }
        });

    </script>

@endsection

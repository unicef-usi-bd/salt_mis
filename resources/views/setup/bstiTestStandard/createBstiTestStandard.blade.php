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
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>Iodine Content(PPM)</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-7">
                        <input type="number" id="inputSuccess" placeholder="Example:- Iodine Content(PPM) here" name="" class="form-control col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-1-1"> <b>PH</b><span style="color: red;"> </span> </label>
                    <div class="col-sm-7">
                        <input type="number" id="inputSuccess" placeholder="Example:- PH here" name="" class="form-control col-xs-10 col-sm-5" />
                    </div>
                </div>
             </div>
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
                    <button type="submit" class="btn btn-primary submitBtn">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        {{ trans('dashboard.submit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!--Sweet Alert Global Script Start-->
    @include('masterGlobal.deleteScript')
    <!-- Sweet Alert Global Script End -->

@endsection

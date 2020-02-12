<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard - SALT ADMIN</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" />

    {{--For Jquery--}}
    <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>
    <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    {{--For Form--}}
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />

    {{--Bootstrap Date Picker--}}
    <script src="{{ asset('assets/datePicker/js/gijgo.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('assets/datePicker/css/gijgo.min.css') }}" rel="stylesheet" type="text/css" />
    {{--Jquery Validation Link--}}
    <script src="{{ asset('assets/validation/js/formValidation.js') }}"></script>

    {{--Sweet Alert--}}
    <link rel="stylesheet" href="{{ asset('assets/sweetAlert/sweetalert.min.css') }}">
    <script src="{{ asset('assets/sweetAlert/sweetalert.min.js') }}"></script>

    {{--Ajax Data Table Links start--}}
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.3/dt-1.10.12/datatables.min.css"/>--}}

    {{--<style>--}}
        {{--.fixedWidth{--}}
            {{--width: 100px;--}}
            {{--text-align: center;--}}
        {{--}--}}
        {{--.modal-bg{--}}
            {{--width: 90%;--}}
        {{--}--}}

    {{--</style>--}}
    {{--Ajax Data Table Links End--}}

    {{--General Data Table Links start--}}
    <link rel="stylesheet" href="{{asset('assets/dataTable/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dataTable/buttons.bootstrap.min.css')}}">

    {{-- Flag icon --}}
    {{--<link href="{{ asset('assets/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet"/>--}}

    <style>
        .dataTables_wrapper .dt-buttons {
            position: absolute;
            left: 40%;
        }
        .dataTables_length{
            float: left;
        }
        #DataTables_Table_0_filter{
            float:right;
        }
        .dataTables_info{
            float:left;
        }
        .dataTables_paginate{
            float:right;
        }
        .fixedWidth{
            width: 60px;
            text-align: center;
        }
        .modal-bg{
            width: 90%;
        }
    </style>
    {{--General Data Table End--}}
</head>

<body class="no-skin">

@include('includes.navBar')

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

@include('includes.sidebar')

    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="col-xs-12">
                    <div class="col-xs-11" style="padding-left: 0px;">
                        @include('masterGlobal.success')
                        @include('masterGlobal.errors')
                    </div>
                </div>
                <div class="ace-settings-container" id="ace-settings-container" style="margin-right: 20px;">
                    @if(isset($heading['action']))
                        <?php $routeUrl = $heading['action']; ?>
                        <h4 class="pink">
                            <button id="{{ $routeUrl }}" data-target=".modal" role="button" data-permission="{{ $heading['createPermissionLevel'] }}" modal-size="{{ $heading['modalSize'] }}" class="btn btn-primary btn-xs showModalGlobal checkPermission" data-toggle="modal" title="{{ $heading['title'] }}"> {{ trans('dashboard.add_new') }} </button>
                        </h4>
                    @endif
                </div><!-- /.ace-settings-container -->
                {{--Custom Alert for Ajax form submit--}}
                <div class="col-md-12 alertHandlerOutModal">
                    {{--Custom Alert Here--}}
                </div>
                @yield('mainContent')
                {{--@include('sweet::alert')--}}
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

    @include('masterGlobal.generalDataTablesScripts')

@include('includes.footer')
</div><!-- /.main-container -->
<!-- <![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
</script>
<!-- page specific plugin scripts -->
<script src="{{ asset('assets/js/excanvas.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.sparkline.index.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.flot.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.flot.pie.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.flot.resize.min.js') }}"></script>
<!-- ace scripts -->
<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('assets/js/ace.min.js') }}"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    //jquery accordion
</script>

</body>

</html>

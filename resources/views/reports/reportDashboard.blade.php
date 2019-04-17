@extends('master')

@section('mainContent')
    {{--@include('masterGlobal.datePicker')--}}
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <style>
        .table th{
            text-align: center;
        }

        .chosen-container { width: 100% !important; }

        .select2{
            width:100% !important;
        }
        .disabledTab{
            pointer-events: none;

        }
        li .disabledTab:hover{
            cursor:not-allowed
        }

        /*.nav-tabs>li.active>a{*/
        /*background-color: #1CABE2;*/
        /*}*/

    </style>

    <div class="page-header">
        <h1>
            Report
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                 Report Dashboard
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-md-12" style="width: 1040px;">
            <div class="col-sm-12">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">

                        <li class="active"> <a data-toggle="tab" href="#admin"> Admin </a> </li>
                        <li class=""> <a data-toggle="tab" href="#unicef"> UNICEF  </a> </li>
                        <li class=""> <a data-toggle="tab" href="#bsti"> BSTI </a> </li>
                        <li class=""> <a data-toggle="tab" href="#bscic"> BSCIC </a> </li>
                        <li class=""> <a data-toggle="tab" href="#association"> Association </a> </li>
                        <li class=""> <a data-toggle="tab" href="#millers"> Millers </a> </li>
                    </ul>

                    <div class="tab-content">
                        {{--admin Report--}}
                        @include('reports.adminReport')
                        {{--/-admin Report--}}
                        {{--unicef Report--}}
                        @include('reports.unicefReport')
                        {{--/-unicef Report--}}

                        {{--Bsti Report--}}
                        @include('reports.bstiReport')
                        {{--/-Bsti Report--}}

                        {{--Bscic Report--}}
                        @include('reports.bscicReport')
                        {{--/- Bscic Report--}}

                        {{--Association Report--}}
                        @include('reports.associationReport')
                        {{--/- Association Report--}}

                        {{--Millers Report--}}
                        @include('reports.millersReport')
                        {{--/- Millers Report--}}


                    </div>
                </div>



            </div><!-- /.col -->

            <div class="space"></div>
        </div>
    </div><!-- /.row -->



    @include('masterGlobal.chosenSelect')
    @include('masterGlobal.getDistrict')
    @include('masterGlobal.getUpazila')
    @include('masterGlobal.getUnion')
    @include('masterGlobal.getMillersId')
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    {{--<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>--}}

    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>




    </script>



    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.getDistrictUpazilaUnion')
    @include('masterGlobal.ajaxFormSubmit')

@endsection

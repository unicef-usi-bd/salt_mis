@extends('master')

@section('mainContent')
    {{--@include('masterGlobal.datePicker')--}}
    {{--<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />--}}
    {{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />--}}

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
    <div class="row" style="margin-top: 20px; width: 92%">
        <div class="col-sm-12">
            <div class="col-sm-12">
                <div class="tabbable resultTab">
                    <div class="tab-content">
                        <span id="printButton"></span>
                        <div class="row tblReport" style="padding-left: 10px;padding-right: 10px;">

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    {{--<br>--}}
    {{--<div class="row " style="width: 92%">--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="col-sm-12">--}}
                {{--<div class="tabbable">--}}
                    {{--<div class="tab-content">--}}
                        {{--<span class="btnPrint pull-right"></span>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<div class="row" style="text-align: center;"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<p class="center">--}}

                                    {{--<br>--}}
                                    {{--<span class="currentMonth"></span>--}}
                                {{--</p>--}}

                                {{--<div class="clearfix"></div>--}}

                            {{--</div><!-- /.col -->--}}
                        {{--</div><!-- /.row -->--}}
                        {{--<div class="clearfix"></div>--}}
                        {{--<table id="" class="table table-striped table-bordered table-hover" style="font-size: 9px">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody id="w">--}}

                            {{--</tbody>--}}
                        {{--</table>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<p></p>--}}
                                    {{--<p></p>--}}
                                    {{--<ol>--}}
                                    {{--<li></li>--}}
                                    {{--<li></li>--}}
                                    {{--</ol>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="pull-right center" style="margin-top: 18%;">--}}
                                        {{--<span></span><br>--}}
                                        {{--<span></span><br>--}}
                                        {{--<span></span><br>--}}
                                        {{--<span></span>--}}
                                    {{--</div>--}}

                                    {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}


    {{--</div>--}}



    {{--@include('masterGlobal.chosenSelect')--}}
    @include('masterGlobal.getDistrict')
    @include('masterGlobal.getUpazila')
    @include('masterGlobal.getUnion')
    @include('masterGlobal.getMillersId')
    {{--<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>--}}
    {{--<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>--}}
    {{--<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>--}}

    {{--<script src="{{ asset('assets/js/select2.min.js') }}"></script>--}}
    {{--<script>--}}




    {{--</script>--}}

    <script type="text/javascript">
        $('.resultTab').hide();
        $(document).on('click','.btnReport',function(){
            var cost_center_type=$(this).attr('cost-center-type');
           // var url = $('.reportType').val();
           // alert(url);

            if(cost_center_type == 'admin'){
                var url = $('.reportType').val();
                //var centerId = $('.center').val();
                var activStatus = $('.status').val();
                $.ajax({
                    type : "get",
                    url  : url,
                    data : {'activStatus':activStatus},
                    success:function (data) {
//                    console.log(data);
                        $('.soeRowDiv').hide();
                        $('.resultTab').show();
                        $('.tblReport').html(data.html);

                    }
                });
            }else if(cost_center_type == 'unicef'){
                var url = $('.reportType2').val();
                //var centerId = $('.center').val();
                var activStatus = $('.status1').val();
                $.ajax({
                    type : "get",
                    url  : url,
                    data : {'activStatus':activStatus},
                    success:function (data) {
//                    console.log(data);
                        $('.soeRowDiv').hide();
                        $('.resultTab').show();
                        $('.tblReport').html(data.html);

                    }
                });
            }else if(cost_center_type == 'bsti'){
                var url = $('.reportType3').val();
                //var centerId = $('.center').val();
                var activStatus = $('.status2').val();
                $.ajax({
                    type : "get",
                    url  : url,
                    data : {'activStatus':activStatus},
                    success:function (data) {
//                    console.log(data);
                        $('.soeRowDiv').hide();
                        $('.resultTab').show();
                        $('.tblReport').html(data.html);

                    }
                });
            }else if(cost_center_type == 'basic'){
                var url = $('.reportType4').val();
                //var centerId = $('.center').val();
                var activStatus = $('.status3').val();
                $.ajax({
                    type : "get",
                    url  : url,
                    data : {'activStatus':activStatus},
                    success:function (data) {
//                    console.log(data);
                        $('.soeRowDiv').hide();
                        $('.resultTab').show();
                        $('.tblReport').html(data.html);

                    }
                });
            }

        });
    </script>



    <!--Add New Group Modal Start-->
    @include('masterGlobal.deleteScript')
    @include('masterGlobal.getDistrictUpazilaUnion')
    @include('masterGlobal.ajaxFormSubmit')

@endsection

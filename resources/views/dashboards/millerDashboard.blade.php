@extends('master')
@section('mainContent')
    <style type="text/css">
        .flot-base{
            width: 330px !important;
        }
        .flot-overlay{
            width: 330px !important;
        }
    </style>
    <div class="page-header">
        <h1>
            Miller Dashboard
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Overview
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <marquee   direction="left"   height="23px" width="95%">
        <div>
            @foreach($renewalMessageCertificate as $row)

                    @if($row->RENEW_DAY <=30)
                    <span class="alert alert-danger" style="font-weight: bolder;">If don’t  renewal {{ $row->CERTIFICATE_NAME }} then account is deactivate.&nbsp;</span>
                    @elseif($row->RENEW_DAY <=60)
                    <span class="alert alert-warning" style="font-weight: bolder;">If don’t  renewal {{ $row->CERTIFICATE_NAME }} then account is deactivate.&nbsp;</span>
                    @elseif($row->RENEW_DAY <=90)
                    <span class="alert alert-success" style="font-weight: bolder;">If don’t  renewal {{ $row->CERTIFICATE_NAME }} then account is deactivate.</span>
                    @endif
            @endforeach
        </div>
        </marquee>
        <hr style="margin-top: 2px;">
    </div>

    <div class="row">

        <div class="space-6"></div>

        <div class="col-sm-7 infobox-container">

            <div class="infobox infobox-blue infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-product-hunt"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">PRODUCTION</div>
                    <div class="infobox-content">{{ sprintf('%0.2f',$totalProductons) }} KG</div>
                </div>
            </div>

            <div class="infobox infobox-black infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-product-hunt"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">INDUSTRIAL SALT PRODUCTION</div>
                    <div class="infobox-content">{{sprintf('%0.2f',$totalWashcrashProduction)}} KG</div>
                </div>
            </div>



            <div class="infobox infobox-orange2 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-product-hunt"></i>
                </div>


                <div class="infobox-data">
                    <div class="infobox-content">IODIZED SALT PRODUCTION</div>
                    <div class="infobox-content">{{ sprintf('%0.2f',$totalIodizeProduction) }} KG</div>
                </div>
            </div>

            <div class="infobox infobox-orange infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-shopping-cart"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">SALES</div>
                    <div class="infobox-content">{{ $totalProductSales }} KG</div>
                </div>
            </div>

            <div class="infobox infobox-blue3 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-shopping-cart"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">
                        INDUSTRIAL SALT
                        SALES</div>
                    <div class="infobox-content">{{ $totalWashCrashSale }} KG</div>
                </div>
            </div>

            <div class="infobox infobox-green2 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-shopping-cart"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">IODIZED SALT SALES</div>
                    <div class="infobox-content">{{ abs($totalIodizeSale) }} KG</div>
                </div>
            </div>

            <div class="space-6"></div>
        </div>

        <div class="vspace-12-sm"></div>

        <div class="col-sm-5">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        Production stock(W&C + iodized) & sales stock(W&C + iodized)
                    </h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        {{--<div id="piechart-placeholder"></div>--}}
                        <canvas id="myChart3"></canvas>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div><!-- /.col -->
    </div>

    <div class="hr hr32 hr-dotted"></div>

    <div class="row">
        <div class="col-sm-6">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title lighter">
                        <i class="ace-icon fa fa-star orange"></i>
                        Procurement List
                    </h4>

                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding" style="height:280px; overflow:auto;">
                        <table class="table table-bordered table-striped">
                            <thead class="thin-border-bottom">
                            <tr>
                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Date
                                </th>

                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Item name
                                </th>

                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Amount
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                           @foreach($procurementList as $row)
                            <tr>
                                <td>
                                    <b class="blue">{{ date('d-m-Y', strtotime($row->ENTRY_TIMESTAMP))  }}</b>
                                </td>
                                <td>{{ $row->ITEM_NAME }}</td>
                                <td>{{ $row->QTY }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div><!-- /.col -->
        <div class="col-sm-6">
            <canvas id="myChart" height="200"></canvas>
        </div><!-- /.col -->
        {{--@if($renewalMessageCertificate as $row)--}}
            {{--<p>your licence expaire between 30 days</p>--}}
        {{--@else--}}
            {{--<p>ok</p>--}}
        {{--@endif--}}

        {{--{{ $renewalMessageCertificate[0]->message }}--}}
    </div><!-- /.row -->

    <div class="hr hr32 hr-dotted"></div>

    <div class="row">
        <div class="col-sm-6">
            <canvas id="myChart1" height="200"></canvas>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title lighter">
                        <i class="ace-icon fa fa-star orange"></i>
                        Last 30 days production
                    </h4>

                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding" style="width:550px; height:250px; overflow:auto;">
                        <table class="table table-bordered table-striped">
                            <thead class="thin-border-bottom">
                            <tr>
                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Date
                                </th>
                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Production Type
                                </th>

                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Production Amount
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($totalproduction as $row)
                                <tr>
                                    <td>
                                        <b class="blue">{{ date('d-M-Y', strtotime($row->ENTRY_TIMESTAMP))  }}</b>
                                    </td>
                                    <td>
                                        @if($row->TRAN_TYPE == 'W')
                                            Wash And Crush Salt
                                        @else
                                            Iodize
                                        @endif
                                    </td>
                                    <td>{{ $row->QTY }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><b class="red">Total</b> </td>
                                <td><b class="red">{{ $totalWcIoDashboard }}</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

    <div class="hr hr32 hr-dotted"></div>

    <div class="row">

        <div class="col-sm-6">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title lighter">
                        <i class="ace-icon fa fa-star orange"></i>
                        Last 30 days sales
                    </h4>

                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding" style="width:550px; height:200px; overflow:auto;">
                        <table class="table table-bordered table-striped">
                            <thead class="thin-border-bottom">
                            <tr>
                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Date
                                </th>
                                <td>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Sales Type
                                </td>
                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Sale Amount
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($totalSale as $row)
                                <tr>
                                    <td>
                                        <b class="blue">{{ date('d-M-Y', strtotime($row->ENTRY_TIMESTAMP))  }}</b>
                                    </td>
                                    <td>
                                        @if($row->TRAN_TYPE == 'W')
                                            Wash And Crush Salt
                                        @else
                                            Iodize
                                        @endif
                                    </td>
                                    <td>{{ abs($row->QTY) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><b class="red">Total</b> </td>
                                <td><b class="red">{{abs ($totalSaleDashboard) }}</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div><!-- /.col -->
        {{--<div class="col-sm-6">--}}
            {{--<canvas id="myChart2"></canvas>--}}
        {{--</div><!-- /.col -->--}}
        <div class="col-sm-5">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        Last month sales report W&C vs Iodized
                    </h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        {{--<div id="piechart-placeholder">--}}
                        <canvas id="myChart2"></canvas>
                        {{--</div>--}}

                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div><!-- /.col -->
        <div class="col-sm-6">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        KI last 3 month statistics (Procurment + Used + In stock)
                    </h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        {{--<div id="piechart-placeholder">--}}
                        <canvas id="myChart4"></canvas>
                        {{--</div>--}}

                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript">
        var qty = '<?php echo json_encode($totalYearProduction); ?>';
        var yearQty = JSON.parse(qty).qty;

        var ctx = document.getElementById('myChart4').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: [
                    'PROCUREMENT ',
                    'USED',
                    'IN STOCK'
                ],
                datasets: [{
                    backgroundColor: ['#3498DB','#c63939','#1f7a3d'],
                    borderColor: '#ffffff',
                    data: [<?php echo sprintf('%0.2f',$totalProcrument)?>, <?php echo sprintf('%0.2f',abs($kiUsed)) ?>,<?php echo sprintf('%0.2f',$totalStockKi)?>],


                }],

            },

            options: {
                animation:{
                    animateScale:true,
                    animateRotate:true
                }
            }

        });

        var ctx = document.getElementById('myChart1').getContext('2d');
        var datas = '<?php echo json_encode($monthWiseProduction); ?>';
        //console.log(datas);
        datas = JSON.parse(datas);
        //console.log(datas);
        let barDataProduction = [0,0,0,0,0,0,0,0,0,0,0,0];
        datas.forEach(function (data) {
            //barData.push(data.subtotal);
            barDataProduction[data.month-1] = data.subtotal;
        });
        // console.log(barData);

        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'horizontalBar',
            // The data for our dataset
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
                datasets: [{
                    label: 'Month wise current year production chart Total = ' + yearQty,
                    backgroundColor: 'rgb(30, 144, 255)',
                    borderColor: 'rgb(30, 144, 255)',
                    // data: [0, 10, 5, 2, 20, 30, 45]
                    data: barDataProduction
                }]
            },

            // Configuration options go here
            options: {
                scales: {
                    xAxes: [{
                        barPercentage: 0.5,
                        barThickness: 6,
                        maxBarThickness: 8,
                        minBarLength: 2,
                        gridLines: {
                            offsetGridLines: true
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById('myChart2').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: [
                    'Washing and Crushing',
                    'Idonaize'
                ],
                datasets: [{
                    backgroundColor: ['#3498DB','#900C3F'],
                    borderColor: '#ffffff',
                    data: [<?php echo $totalWashCrashSale?>, <?php echo $totalIodizeSale?>],


                }],

            },

            options: {
                animation:{
                    animateScale:true,
                    animateRotate:true
                }
            }

        });

        var ctx = document.getElementById('myChart3').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: [
                    'Stock',
                    'Sales'
                ],
                datasets: [{
                    data: [<?php echo $totalProductons; ?>, <?php echo $totalProductSales; ?>],
                    backgroundColor: ['#3498DB','#900C3F'],
                    borderColor: '#ffffff'


                }],

            },

            options: {
                legend: {
                    position: 'right'
                },
                animation:{
                    animateScale:true,
                    animateRotate:true
                },
            }

        });

//        window.setTimeout(function() {
//            $(".alert-danger").fadeOut(500, 0).slideUp(500, function(){
//                $(this).remove();
//            });
//        }, 5000);
//
//        window.setTimeout(function() {
//            $(".alert-warning").fadeOut(500, 0).slideUp(500, function(){
//                $(this).remove();
//            });
//        }, 5000);
//
//        window.setTimeout(function() {
//            $(".alert-info").fadeOut(500, 0).slideUp(500, function(){
//                $(this).remove();
//            });
//        }, 5000);


    </script>

@endsection




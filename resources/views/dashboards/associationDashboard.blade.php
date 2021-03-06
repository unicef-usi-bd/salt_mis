@extends('master')
@section('mainContent')
    <style type="text/css">
        .flot-base{
            width: 330px !important;
        }
        .flot-overlay{
            width: 330px !important;
        }

        .boxDanger{
            background-color: #F2DEDE;
            width: 37px;
            height: 13px;
        }

        .boxWarning{
            background-color: #FCF8E3;
            width: 37px;
            height: 13px;
        }

        .boxSuccess{
            background-color: #DFF0D8;
            width: 37px;
            height: 13px;
        }

        /*For Scroll*/
        .scroll-Div{
            width:550px;
            height:221px !important;
            overflow:auto;
        }
    </style>
    <div class="page-header">
        <h1>
           Association Dashboard
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Overview
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="space-6"></div>

        <div class="col-sm-7 infobox-container">
            <div class="infobox infobox-green infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-industry"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">MILLS</div>
                    <div class="infobox-content">{{ $totalMiller }}</div>
                </div>
            </div>

            <div class="infobox infobox-blue infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-product-hunt"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">PRODUCTION</div>
                    <div class="infobox-content">
                        {{ number_format($totalassociationproduction, 2) }}
                    </div>
                </div>
            </div>

            <div class="infobox infobox-orange infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-shopping-cart"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">SALES</div>
                    <div class="infobox-content">
                        {{ number_format($totalSales, 2)}}
                    </div>
                </div>
            </div>

            <div class="infobox infobox-blue2 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-check-circle"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">ACTIVE MILLS</div>
                    <div class="infobox-content">{{ $totalActiveMiller }}</div>
                </div>
            </div>

            <div class="infobox infobox-orange2 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-product-hunt"></i>
                </div>


                <div class="infobox-data">
                    <div class="infobox-content">IODIZED SALT PRODUCTION</div>
                    <div class="infobox-content">
                        {{ number_format($associationIodize, 2)}}
                    </div>
                </div>
            </div>

            <div class="infobox infobox-green2 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-shopping-cart"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">IODIZED SALT SALES</div>
                    <div class="infobox-content">
                        {{ number_format($totalAssociationIodizeSale, 2)}}
                    </div>
                </div>
            </div>

            <div class="infobox infobox-red infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-ban"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">INACTIVE MILLS</div>
                    <div class="infobox-content">{{ $totalInactiveMiller }}</div>
                </div>
            </div>

            <div class="infobox infobox-black infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-product-hunt"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">INDUSTRIAL SALT PRODUCTION</div>
                    <div class="infobox-content">
                        {{ number_format($associationWashCrash, 2) }}
                    </div>
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
                    <div class="infobox-content">
                        {{ number_format($totalAssociationWashCrasheSale, 2) }}
                    </div>
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
                        Production (W & C + Iodized) & Sale (W & C + Iodized)
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
            <canvas id="myChart1" height="200"></canvas>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title lighter">
                        <i class="ace-icon fa fa-star orange"></i>
                        Last 30 Days Production
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
                                    <i class="ace-icon fa fa-caret-right blue"></i>Production Amount In KG
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($totlaProductionList as $row)
                                <tr>
                                    <td>
                                        <b class="blue">{{ date('d-M-Y', strtotime($row->ENTRY_TIMESTAMP))  }}</b>
                                    </td>
                                    <td>
                                        @if($row->TRAN_TYPE == 'W')
                                            Wash And Crushing Salt
                                        @else
                                            Iodized Salt
                                        @endif
                                    </td>
                                    <td>{{ number_format(abs($row->QTY), 2) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><b class="red">Total</b> </td>
                                <td><b class="red">{{ number_format($totalWcIoDashboard, 2) }}</b></td>
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
                        Last 30 Days Sales
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
                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Sale Type
                                </th>
                                <th>
                                    <i class="ace-icon fa fa-caret-right blue"></i>Sale Amount In KG
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($totalSaleLists as $row)
                                <tr>
                                    <td>
                                        <b class="blue">{{ date('d-m-Y', strtotime($row->TRAN_DATE))  }}</b>
                                    </td>
                                    <td>
                                        @if($row->TRAN_TYPE == 'W')
                                            Wash And Crushing Salt
                                        @else
                                            Iodized Salt
                                        @endif
                                    </td>
                                    <td>{{ number_format(abs($row->QTY), 2) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><b class="red">Total</b> </td>
                                <td><b class="red">{{ number_format(abs($totalSaleDashboard), 2) }}</b></td>
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
                        Last Month Sales Statistics (W & C vs Iodized)
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
                        Last 3 Months Statistics of KIO3 (Procurement + Used + In stock)
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

        <div class="col-sm-6">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-star orange"></i>
                         Certificate Status of Mills
                    </h5>
                </div>

                <div class="widget-body">
                    <div class="space"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label style="font-weight: bolder;">Expire in 30 Days </label>
                                <div class="boxDanger"></div>
                            </div>
                            <div class="col-md-4">
                                <label style="font-weight: bolder;">Expire in 60 Days </label>
                                <div class="boxWarning"></div>
                            </div>
                            <div class="col-md-4">
                                <label style="font-weight: bolder;">Expire in 90 Days </label>
                                <div class="boxSuccess"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-main scroll-Div">
                        <table class="table table-bordered table-striped">
                            <thead class="thin-border-bottom">
                            <tr>
                                <th>
                                    Mill&nbsp;Logo
                                </th>

                                <th>
                                    Mill&nbsp;Name
                                </th>

                                <th>
                                    Certificate&nbsp;Name
                                </th>

                                <th>
                                    Renewal&nbsp;Date
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($associationMillerCertificate as $row)
                                @if($row->RENEW_DAY<=30)
                                <tr>
                                    <td class="alert alert-danger text-center"><span class="TRADE_LICENSE"><img src="{{ url('/'. $row->mill_logo ) }}" alt="trade license"  width="20px"></span></td>
                                    <td class="alert alert-danger">{{ $row->MILL_NAME }}</td>
                                    <td class="alert alert-danger">{{ $row->CERTIFICATE_NAME }}</td>
                                    <td class="alert alert-danger">{{ date('d-m-Y',strtotime($row->RENEWING_DATE)) }}</td>
                                </tr>
                                @elseif($row->RENEW_DAY<=60)
                                    <tr>
                                        <td class="alert alert-warning text-center"><span class="TRADE_LICENSE"><img src="{{ url('/'. $row->mill_logo ) }}" alt="trade license"  width="20px"></span></td>
                                        <td class="alert alert-warning">{{ $row->MILL_NAME }}</td>
                                        <td class="alert alert-warning">{{ $row->CERTIFICATE_NAME }}</td>
                                        <td class="alert alert-warning">{{ date('d-m-Y',strtotime($row->RENEWING_DATE)) }}</td>
                                    </tr>
                                @elseif($row->RENEW_DAY<=90)
                                    <tr>
                                        <td class="alert alert-success text-center"><span class="TRADE_LICENSE"><img src="{{ url('/'. $row->mill_logo ) }}" alt="trade license"  width="20px"></span></td>
                                        <td class="alert alert-success">{{ $row->MILL_NAME }}</td>
                                        <td class="alert alert-success">{{ $row->CERTIFICATE_NAME }}</td>
                                        <td class="alert alert-success">{{ date('d-m-Y',strtotime($row->RENEWING_DATE)) }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
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
                    data: [<?php echo sprintf('%0.2f',$totalProcrument)?>, <?php echo sprintf('%0.2f',abs($kiUsed)) ?>,<?php echo sprintf('%0.2f',$totalStock)?>],


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
        var datas = '<?php echo json_encode($associationMonthWishProduction); ?>';
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
                    label: 'Month-Wise Current Year Total Production Chart ( KG) = ' + yearQty.toFixed(2),
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
                    data: [
                        <?php echo $associationTotalStockMonthWise;?>,<?php echo $totalSales ;?>],
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

        var ctx = document.getElementById('myChart2').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: [
                    'INDUSTRIAL SALT ',
                    'IDIZED SALT'
                ],
                datasets: [{
                    backgroundColor: ['#3498DB','#900C3F'],
                    borderColor: '#ffffff',
                    data: [<?php echo $totalAssociationWashCrasheSale?>, <?php echo $totalassociationIodizeSaleMonthWise ?>],


                }],

            },

            options: {
                animation:{
                    animateScale:true,
                    animateRotate:true
                }
            }

        });


    </script>


@endsection




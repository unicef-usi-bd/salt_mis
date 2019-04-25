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
            Dashboard unicef
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
                    <div class="infobox-content">Millers</div>
                    <div class="infobox-content">115</div>
                </div>
            </div>

            <div class="infobox infobox-blue infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-product-hunt"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">PRODUCTION</div>
                    <div class="infobox-content">{{ $totalProductons }} KG</div>
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

            <div class="infobox infobox-blue2 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-check-circle"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">Active MILLERS</div>
                    <div class="infobox-content">100</div>
                </div>
            </div>

            <div class="infobox infobox-orange2 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-product-hunt"></i>
                </div>


                <div class="infobox-data">
                    <div class="infobox-content">IODIZED SALT PRODUCTION</div>
                    <div class="infobox-content">{{ $totalIodizeProduction }} KG</div>
                </div>
            </div>

            <div class="infobox infobox-green2 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-shopping-cart"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">IODIZED SALT SALES</div>
                    <div class="infobox-content">{{ $totalIodizeSale }} KG</div>
                </div>
            </div>

            <div class="infobox infobox-red infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-ban"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">Inactive MILLERS</div>
                    <div class="infobox-content">15</div>
                </div>
            </div>

            <div class="infobox infobox-black infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-product-hunt"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">INDUSTRIAL SALT PRODUCTION</div>
                    <div class="infobox-content">{{$totalWashcrashProduction}} KG</div>
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

            <div class="space-6"></div>
        </div>

        <div class="vspace-12-sm"></div>

        <div class="col-sm-5">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        Stock And Sales Report
                    </h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="piechart-placeholder"></div>

                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div><!-- /.col -->
    </div>





    <div class="hr hr32 hr-dotted"></div>

    <div class="row">
        <div class="col-sm-6">
            <canvas id="myChart1"></canvas>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title lighter">
                        <i class="ace-icon fa fa-star orange"></i>
                        Production
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
                                    <i class="ace-icon fa fa-caret-right blue"></i>Production Amount
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($totalproduction as $row)
                                <tr>
                                    <td>
                                        <b class="blue">{{ date('d-m-Y', strtotime($row->ENTRY_TIMESTAMP))  }}</b>
                                    </td>
                                    <td>{{ $row->QTY }}</td>
                                </tr>
                            @endforeach
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
                        Sale
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
                                    <i class="ace-icon fa fa-caret-right blue"></i>Sale Amount
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($totalSale as $row)
                                <tr>
                                    <td>
                                        <b class="blue">{{ date('d-m-Y', strtotime($row->ENTRY_TIMESTAMP))  }}</b>
                                    </td>
                                    <td>{{ abs($row->QTY) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div><!-- /.col -->
        <div class="col-sm-6">
            <canvas id="myChart2"></canvas>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript">

        var ctx = document.getElementById('myChart1').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'horizontalBar',

            // The data for our dataset
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Production Chart',
                    backgroundColor: 'rgb(30, 144, 255)',
                    borderColor: 'rgb(30, 144, 255)',
                    data: [0, 10, 5, 2, 20, 30, 45]
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
                    data: [40, 10],


                }],

            },

            options: {
                animation:{
                    animateScale:true,
                    animateRotate:true
                }
            }

        });


        jQuery(function($) {
            $('.easy-pie-chart.percentage').each(function(){
                var $box = $(this).closest('.infobox');
                var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
                var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
                var size = parseInt($(this).data('size')) || 50;
                $(this).easyPieChart({
                    barColor: barColor,
                    trackColor: trackColor,
                    scaleColor: false,
                    lineCap: 'butt',
                    lineWidth: parseInt(size/10),
                    animate: ace.vars['old_ie'] ? false : 1000,
                    size: size
                });
            })

            $('.sparkline').each(function(){
                var $box = $(this).closest('.infobox');
                var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                $(this).sparkline('html',
                    {
                        tagValuesAttribute:'data-values',
                        type: 'bar',
                        barColor: barColor ,
                        chartRangeMin:$(this).data('min') || 0
                    });
            });


            //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
            //but sometimes it brings up errors with normal resize event handlers
            $.resize.throttleWindow = null;

            var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
            var data = [
                { label: "Stock",  data: 60.7, color: "#68BC31"},
                { label: "Sales",  data: 30.3, color: "#2091CF"}
            ]
            function drawPieChart(placeholder, data, position) {
                $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            tilt:0.8,
                            highlight: {
                                opacity: 0.25
                            },
                            stroke: {
                                color: '#fff',
                                width: 2
                            },
                            startAngle: 2
                        }
                    },
                    legend: {
                        show: true,
                        position: position || "ne",
                        labelBoxBorderColor: null,
                        margin:[-30,15]
                    }
                    ,
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                })
            }
            drawPieChart(placeholder, data);

            /**
             we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
             so that's not needed actually.
             */
            placeholder.data('chart', data);
            placeholder.data('draw', drawPieChart);


            //pie chart tooltip example
            var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
            var previousPoint = null;

            placeholder.on('plothover', function (event, pos, item) {
                if(item) {
                    if (previousPoint != item.seriesIndex) {
                        previousPoint = item.seriesIndex;
                        var tip = item.series['label'] + " : " + item.series['percent']+'%';
                        $tooltip.show().children(0).text(tip);
                    }
                    $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
                } else {
                    $tooltip.hide();
                    previousPoint = null;
                }

            });

            /////////////////////////////////////
            $(document).one('ajaxloadstart.page', function(e) {
                $tooltip.remove();
            });




            var d1 = [];
            for (var i = 0; i < Math.PI * 2; i += 0.5) {
                d1.push([i, Math.sin(i)]);
            }

            var d2 = [];
            for (var i = 0; i < Math.PI * 2; i += 0.5) {
                d2.push([i, Math.cos(i)]);
            }

            var d3 = [];
            for (var i = 0; i < Math.PI * 2; i += 0.2) {
                d3.push([i, Math.tan(i)]);
            }




            $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('.tab-content')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                //var w2 = $source.width();

                if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                return 'left';
            }


            $('.dialogs,.comments').ace_scroll({
                size: 300
            });


            //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
            //so disable dragging when clicking on label
            var agent = navigator.userAgent.toLowerCase();
            if(ace.vars['touch'] && ace.vars['android']) {
                $('#tasks').on('touchstart', function(e){
                    var li = $(e.target).closest('#tasks li');
                    if(li.length == 0)return;
                    var label = li.find('label.inline').get(0);
                    if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
                });
            }

            $('#tasks').sortable({
                    opacity:0.8,
                    revert:true,
                    forceHelperSize:true,
                    placeholder: 'draggable-placeholder',
                    forcePlaceholderSize:true,
                    tolerance:'pointer',
                    stop: function( event, ui ) {
                        //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                        $(ui.item).css('z-index', 'auto');
                    }
                }
            );
            $('#tasks').disableSelection();
            $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
                if(this.checked) $(this).closest('li').addClass('selected');
                else $(this).closest('li').removeClass('selected');
            });


            //show the dropdowns on top or bottom depending on window height and menu position
            $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
                var offset = $(this).offset();

                var $w = $(window)
                if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
                    $(this).addClass('dropup');
                else $(this).removeClass('dropup');
            });

        })
    </script>

@endsection




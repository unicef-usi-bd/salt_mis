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
            Dashboard (Association)
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
                    <div class="infobox-content">300 MT</div>
                </div>
            </div>

            <div class="infobox infobox-orange infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-shopping-cart"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">SALES</div>
                    <div class="infobox-content">200 MT</div>
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
                    <div class="infobox-content">100 MT</div>
                </div>
            </div>

            <div class="infobox infobox-green2 infobox-medium infobox-dark">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-shopping-cart"></i>
                </div>

                <div class="infobox-data">
                    <div class="infobox-content">IODIZED SALT SALES</div>
                    <div class="infobox-content">100 MT</div>
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
                    <div class="infobox-content">100 MT</div>
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
                    <div class="infobox-content">200 MT</div>
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
                        Stock And Sales Report (Association)
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






@endsection




@include('partials._head')

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a class="site_title"><i class="fa fa-heart"></i> <span>IDrugC</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <!-- /menu profile quick info -->

                <br />

                @include('components._guestsidebar')
            </div>
        </div>


    <!-- page content -->
        <div class="right_col" role="main">

            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @include('components._warnings')
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Donation Page</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="product-image">
                                        <img src="{{asset('images/logo.png')}}" alt="..." />
                                    </div>
                                </div>

                                <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                                    <h3 class="prod_title">Donation for Indonesian Drug Campaign</h3>
                                    <br />
                                    <div class="">
                                        <div class="product_price">
                                            <h1 class="price">BCA</h1>
                                            <span class="price-tax">123-456-789</span>
                                            <br>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="">
                                        <div class="product_price">
                                            <h1 class="price">Mandiri</h1>
                                            <span class="price-tax">123-456-789</span>
                                            <br>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="">
                                        <div class="product_price">
                                            <h1 class="price">BRI</h1>
                                            <span class="price-tax">123-456-789</span>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
        <!-- /page content -->
@extends('partials._script')
        <script>
            CKEDITOR.replace( 'reasons' );
        </script>

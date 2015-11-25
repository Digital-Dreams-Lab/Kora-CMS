<!DOCTYPE html>
<html lang="en">

    <head>
    
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
    
        <title>Grayscale - Start Bootstrap Theme</title>
    
    	<?php $base = Uri::base(false).'/themes/grey-scale/'; ?>
        <!-- Bootstrap Core CSS -->
        <link href="<?=$base?>css/bootstrap.min.css" rel="stylesheet" />
    
        <!-- Custom CSS -->
        <link href="<?=$base?>css/grayscale.css" rel="stylesheet" />
        <link href="<?=$base?>css/paraxify.css" rel="stylesheet" />
    
        <!-- Custom Fonts -->
        <link href="<?=$base?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,500' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
    
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <img id="brand-image" src="<?=$base?>/img/koracms_white_navbar.png">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#download">Download</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro paraxify">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                        
                            <div class="item active">
                    
                                <div class="col-md-8 col-md-offset-2">
                                    <h1 class="brand-heading"><img class="img-responsive center-block" src="<?=$base?>/img/koracms_white.png"></h1>
                                    <p class="intro-text">Simple, flexible, free.<br />Conjured by Digital Dreams Labs.</p>
                                    <a href="#about" class="btn btn-circle page-scroll">
                                        <i class="fa fa-angle-double-down animated"></i>
                                    </a>
                                </div>

                            </div>
                            
                            <div class="item">
                    
                                <div class="col-md-8 col-md-offset-2">
                                    <h1 class="brand-heading"><img class="img-responsive center-block" src="<?=$base?>/img/flame-bg.png"></h1>
                                    <a href="#about" class="btn btn-circle page-scroll">
                                        <i class="fa fa-angle-double-down animated"></i>
                                    </a>
                                </div>
                                
                            </div>
                            
                            <div class="item">
                    
                                <div class="col-md-8 col-md-offset-2">
                                    <h1 class="brand-heading"><img class="img-responsive center-block" src="<?=$base?>/img/flame-bg-2.png"></h1>
                                    <p class="intro-text">FuelPHP &amp; Kor@ CMS = Flaming love</p>
                                    <a href="#about" class="btn btn-circle page-scroll">
                                        <i class="fa fa-angle-double-down animated"></i>
                                    </a>
                                </div>
                                
                            </div>
                            <p></p>
                        </div>
                        
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="paraxify container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About Kor@ CMS</h2>
                <p>Kora - A Maori word meaning spark, fire or fuel, is web software you can use to create a beautiful website or app.</p>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="download" class="paraxify content-section text-center">
        <div class="download-section paraxify">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Download Grayscale</h2>
                    <p>You can download Grayscale for free on the preview page at Start Bootstrap.</p>
                    <a href="http://startbootstrap.com/template-overviews/grayscale/" class="btn btn-default btn-lg">Visit Download Page</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact Start Bootstrap</h2>
                <p>Feel free to email us to provide some feedback on our templates, give us suggestions for new templates and themes, or to just say hello!</p>
                <p><a href="mailto:feedback@startbootstrap.com">feedback@startbootstrap.com</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div class="contact-section"></div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Your Website 2014</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?=$base?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$base?>js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?=$base?>js/jquery.easing.min.js"></script>
    
    <!-- Plugin Praxify -->
    <script src="<?=$base?>js/paraxify.js"></script>
    
    <script>myParaxify = paraxify('.paraxify');</script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=$base?>js/grayscale.js"></script>

	</body>

</html>